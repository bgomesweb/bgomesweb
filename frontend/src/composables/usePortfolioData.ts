import { ref, onMounted } from 'vue'
import type { PortfolioData } from '@/types/portfolio'

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL ?? '/api'

export function usePortfolioData() {
  const data = ref<PortfolioData | null>(null)
  const isLoading = ref(true)
  const error = ref<string | null>(null)

  async function fetchPortfolio(): Promise<void> {
    isLoading.value = true
    error.value = null

    try {
      const response = await fetch(`${API_BASE_URL}/portfolio`)

      if (!response.ok) {
        throw new Error(`Falha ao carregar dados do portfólio (HTTP ${response.status})`)
      }

      data.value = (await response.json()) as PortfolioData
    } catch (caughtError) {
      error.value =
        caughtError instanceof Error ? caughtError.message : 'Erro inesperado ao carregar dados'
    } finally {
      isLoading.value = false
    }
  }

  onMounted(fetchPortfolio)

  return { data, isLoading, error, refetch: fetchPortfolio }
}
