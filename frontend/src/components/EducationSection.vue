<script setup lang="ts">
import type { Award, Education } from '@/types/portfolio'

defineProps<{ educations: Education[]; awards: Award[] }>()

function formatPeriod(education: Education): string {
  const start = new Date(education.startDate).toLocaleDateString('pt-BR', {
    month: 'short',
    year: 'numeric',
    timeZone: 'UTC',
  })
  const end = education.endDate
    ? new Date(education.endDate).toLocaleDateString('pt-BR', {
        month: 'short',
        year: 'numeric',
        timeZone: 'UTC',
      })
    : 'Atual'
  return `${start} — ${end}`
}
</script>

<template>
  <section id="formacao" class="mx-auto max-w-4xl px-6 py-24">
    <p class="section-eyebrow mb-3">Formação acadêmica</p>
    <h2 class="section-heading mb-12">Educação e prêmios</h2>

    <div class="grid gap-6 sm:grid-cols-2">
      <div v-for="education in educations" :key="education.id" class="card">
        <div class="flex items-start justify-between gap-3">
          <h3 class="font-bold text-white">{{ education.course }}</h3>
          <span
            class="shrink-0 rounded-full bg-brand-500/15 px-2.5 py-1 text-xs font-medium text-brand-300"
          >
            {{ education.status }}
          </span>
        </div>
        <p class="mt-1 text-sm text-slate-400">{{ education.institution }}</p>
        <p class="mt-1 text-xs text-slate-500">{{ formatPeriod(education) }}</p>
        <p v-if="education.description" class="mt-3 text-sm text-slate-300">
          {{ education.description }}
        </p>
      </div>
    </div>

    <div v-if="awards.length" class="mt-14">
      <h3 class="mb-4 text-sm font-semibold uppercase tracking-widest text-slate-500">
        Premiações
      </h3>
      <ul class="space-y-3">
        <li
          v-for="award in awards"
          :key="award.id"
          class="rounded-xl border border-amber-400/20 bg-amber-400/5 px-4 py-3 text-sm text-amber-200"
        >
          <p class="font-semibold">{{ award.title }}</p>
          <p v-if="award.description" class="mt-1 text-amber-200/80">{{ award.description }}</p>
        </li>
      </ul>
    </div>
  </section>
</template>
