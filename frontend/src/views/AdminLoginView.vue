<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuth } from '@/composables/useAuth'

const router = useRouter()
const { login } = useAuth()

const email = ref('')
const password = ref('')
const error = ref<string | null>(null)
const isSubmitting = ref(false)

async function handleSubmit(): Promise<void> {
  error.value = null
  isSubmitting.value = true

  try {
    await login(email.value, password.value)
    await router.push({ name: 'admin-dashboard' })
  } catch {
    error.value = 'E-mail ou senha inválidos.'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<template>
  <div class="flex min-h-screen items-center justify-center px-6">
    <form class="card w-full max-w-sm" @submit.prevent="handleSubmit">
      <p class="section-eyebrow mb-2">Admin</p>
      <h1 class="section-heading mb-6 text-2xl">Entrar</h1>

      <label class="mb-4 block">
        <span class="mb-1 block text-sm text-slate-300">E-mail</span>
        <input
          v-model="email"
          type="email"
          required
          autocomplete="username"
          class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none focus:border-brand-400"
        />
      </label>

      <label class="mb-6 block">
        <span class="mb-1 block text-sm text-slate-300">Senha</span>
        <input
          v-model="password"
          type="password"
          required
          autocomplete="current-password"
          class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none focus:border-brand-400"
        />
      </label>

      <p v-if="error" class="mb-4 text-sm text-red-400">{{ error }}</p>

      <button
        type="submit"
        :disabled="isSubmitting"
        class="w-full rounded-full bg-brand-500 px-6 py-3 font-semibold text-white transition-transform hover:scale-105 disabled:opacity-50"
      >
        {{ isSubmitting ? 'Entrando…' : 'Entrar' }}
      </button>
    </form>
  </div>
</template>
