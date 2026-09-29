<script setup lang="ts">
import type { SkillGroup } from '@/types/portfolio'

defineProps<{ skillGroups: SkillGroup[] }>()
</script>

<template>
  <section id="competencias" class="mx-auto max-w-6xl px-6 py-24">
    <p class="section-eyebrow mb-3">Competências técnicas</p>
    <h2 class="section-heading mb-12">Stack e boas práticas</h2>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <div v-for="group in skillGroups" :key="group.category" class="card">
        <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-brand-400">
          {{ group.category }}
        </h3>
        <div class="flex flex-wrap gap-2">
          <span
            v-for="skill in group.skills"
            :key="skill"
            class="rounded-full bg-white/10 px-3 py-1 text-sm text-slate-200"
          >
            {{ skill }}
          </span>
        </div>
      </div>
    </div>
  </section>
</template>
