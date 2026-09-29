<script setup lang="ts">
import type { Experience } from '@/types/portfolio'

defineProps<{ experiences: Experience[] }>()

function formatPeriod(experience: Experience): string {
  const start = new Date(experience.startDate).toLocaleDateString('pt-BR', {
    month: 'short',
    year: 'numeric',
    timeZone: 'UTC',
  })
  const end = experience.isCurrent
    ? 'Atual'
    : experience.endDate
      ? new Date(experience.endDate).toLocaleDateString('pt-BR', {
          month: 'short',
          year: 'numeric',
          timeZone: 'UTC',
        })
      : ''
  return `${start} — ${end}`
}
</script>

<template>
  <section id="experiencia" class="mx-auto max-w-4xl px-6 py-24">
    <p class="section-eyebrow mb-3">Trajetória</p>
    <h2 class="section-heading mb-12">Experiência profissional</h2>

    <ol class="relative space-y-10 border-l border-white/10 pl-8">
      <li v-for="experience in experiences" :key="experience.id" class="relative">
        <span
          class="absolute -left-[calc(2rem+5px)] top-1.5 h-3 w-3 rounded-full border-2 border-slate-950 bg-brand-400"
        ></span>

        <div class="flex flex-wrap items-baseline justify-between gap-2">
          <h3 class="text-xl font-bold text-white">{{ experience.role }}</h3>
          <span class="text-sm font-medium text-brand-300">{{ formatPeriod(experience) }}</span>
        </div>
        <p class="mt-1 font-medium text-slate-400">{{ experience.company }}</p>

        <ul class="mt-4 space-y-2 text-slate-300">
          <li v-for="(highlight, index) in experience.highlights" :key="index" class="flex gap-2">
            <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-brand-500"></span>
            <span>{{ highlight }}</span>
          </li>
        </ul>
      </li>
    </ol>
  </section>
</template>
