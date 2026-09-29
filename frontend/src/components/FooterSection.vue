<script setup lang="ts">
import type { Profile } from '@/types/portfolio'

defineProps<{ profile: Profile | null }>()

const currentYear = new Date().getFullYear()
</script>

<template>
  <footer class="border-t border-white/10 py-8 text-center text-sm text-slate-500">
    <p>© {{ currentYear }} {{ profile?.name ?? 'Bruno Gomes da Silva' }}. Todos os direitos reservados.</p>
  </footer>
</template>
