import { ref } from 'vue'

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL ?? '/api'

export interface AdminUser {
  name: string
  email: string
}

const user = ref<AdminUser | null>(null)
const isReady = ref(false)

function getCookie(name: string): string | null {
  const match = document.cookie.match(new RegExp(`(?:^|; )${name}=([^;]*)`))
  return match ? decodeURIComponent(match[1]) : null
}

async function ensureCsrfCookie(): Promise<void> {
  await fetch(`${API_BASE_URL}/csrf-cookie`, { credentials: 'include' })
}

function apiFetch(path: string, options: RequestInit = {}): Promise<Response> {
  const xsrfToken = getCookie('XSRF-TOKEN')

  return fetch(`${API_BASE_URL}${path}`, {
    ...options,
    credentials: 'include',
    headers: {
      Accept: 'application/json',
      ...(options.body ? { 'Content-Type': 'application/json' } : {}),
      ...(xsrfToken ? { 'X-XSRF-TOKEN': xsrfToken } : {}),
      ...options.headers,
    },
  })
}

export function useAuth() {
  async function login(email: string, password: string): Promise<void> {
    await ensureCsrfCookie()

    const response = await apiFetch('/login', {
      method: 'POST',
      body: JSON.stringify({ email, password }),
    })

    if (!response.ok) {
      throw new Error('E-mail ou senha inválidos.')
    }

    const payload = await response.json()
    user.value = payload.user
  }

  async function logout(): Promise<void> {
    await apiFetch('/logout', { method: 'POST' })
    user.value = null
  }

  async function fetchCurrentUser(): Promise<AdminUser | null> {
    try {
      const response = await apiFetch('/me')

      if (!response.ok) {
        user.value = null
        return null
      }

      const payload = await response.json()
      user.value = payload.user
      return user.value
    } catch {
      user.value = null
      return null
    } finally {
      isReady.value = true
    }
  }

  return { user, isReady, login, logout, fetchCurrentUser, apiFetch }
}
