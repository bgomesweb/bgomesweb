<script setup lang="ts">
import type { Profile } from '@/types/portfolio'

defineProps<{ profile: Profile | null }>()
</script>

<template>
  <section id="sobre" class="mx-auto max-w-4xl px-6 py-24">
    <p class="section-eyebrow mb-3">Sobre mim</p>
    <h2 class="section-heading mb-8">Resumo profissional</h2>
    <p class="text-lg leading-relaxed text-slate-300">
      {{ profile?.summary }}
    </p>
  </section>
</template>
