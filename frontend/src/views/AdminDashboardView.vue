<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuth } from '@/composables/useAuth'
import VisitsBarChart from '@/components/admin/VisitsBarChart.vue'
import type { VisitStats } from '@/types/visits'

const router = useRouter()
const { user, logout, apiFetch } = useAuth()

const stats = ref<VisitStats | null>(null)
const isLoading = ref(true)
const error = ref<string | null>(null)

async function loadStats(): Promise<void> {
  isLoading.value = true
  error.value = null

  try {
    const response = await apiFetch('/admin/visits/stats')

    if (!response.ok) {
      throw new Error('Falha ao carregar estatísticas.')
    }

    stats.value = await response.json()
  } catch {
    error.value = 'Não foi possível carregar as estatísticas de visitas.'
  } finally {
    isLoading.value = false
  }
}

async function handleLogout(): Promise<void> {
  await logout()
  await router.push({ name: 'admin-login' })
}

onMounted(loadStats)
</script>

<template>
  <div class="mx-auto max-w-5xl px-6 py-16">
    <div class="mb-10 flex items-center justify-between">
      <div>
        <p class="section-eyebrow mb-2">Admin</p>
        <h1 class="section-heading text-2xl">Visitas ao site</h1>
        <p v-if="user" class="mt-1 text-sm text-slate-400">Logado como {{ user.email }}</p>
      </div>
      <button
        type="button"
        class="rounded-full border border-white/20 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-white/10"
        @click="handleLogout"
      >
        Sair
      </button>
    </div>

    <p v-if="isLoading" class="text-slate-400">Carregando…</p>
    <p v-else-if="error" class="text-red-400">{{ error }}</p>

    <template v-else-if="stats">
      <div class="mb-10 grid grid-cols-2 gap-4 sm:grid-cols-4">
        <div class="card">
          <p class="mb-2 text-sm text-slate-400">Total</p>
          <p class="text-3xl font-semibold text-white">{{ stats.total }}</p>
        </div>
        <div class="card">
          <p class="mb-2 text-sm text-slate-400">Hoje</p>
          <p class="text-3xl font-semibold text-white">{{ stats.today }}</p>
        </div>
        <div class="card">
          <p class="mb-2 text-sm text-slate-400">Últimos 7 dias</p>
          <p class="text-3xl font-semibold text-white">{{ stats.last7Days }}</p>
        </div>
        <div class="card">
          <p class="mb-2 text-sm text-slate-400">Últimos 30 dias</p>
          <p class="text-3xl font-semibold text-white">{{ stats.last30Days }}</p>
        </div>
      </div>

      <div class="card">
        <p class="mb-4 text-sm text-slate-400">
          Visitas por dia (últimos 14 dias) · {{ stats.uniqueVisitorsTotal }} visitante(s)
          único(s) no total
        </p>
        <VisitsBarChart :daily="stats.daily" />
      </div>
    </template>
  </div>
</template>
