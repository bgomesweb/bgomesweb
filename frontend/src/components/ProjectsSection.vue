<script setup lang="ts">
import type { Project } from '@/types/portfolio'

defineProps<{ projects: Project[] }>()
</script>

<template>
  <section id="projetos" class="mx-auto max-w-6xl px-6 py-24">
    <p class="section-eyebrow mb-3">Portfólio</p>
    <h2 class="section-heading mb-12">Projetos</h2>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <article v-for="project in projects" :key="project.id" class="card flex flex-col">
        <h3 class="text-lg font-bold text-white">{{ project.name }}</h3>
        <p class="mt-2 flex-1 text-sm text-slate-300">{{ project.description }}</p>

        <div class="mt-4 flex flex-wrap gap-2">
          <span
            v-for="technology in project.technologies"
            :key="technology"
            class="rounded-full bg-brand-500/10 px-2.5 py-1 text-xs text-brand-300"
          >
            {{ technology }}
          </span>
        </div>

        <div class="mt-5 flex gap-4 text-sm font-medium">
          <a
            v-if="project.url"
            :href="project.url"
            target="_blank"
            rel="noopener noreferrer"
            class="text-brand-300 hover:text-brand-200"
          >
            Ver projeto ↗
          </a>
          <a
            v-if="project.repositoryUrl"
            :href="project.repositoryUrl"
            target="_blank"
            rel="noopener noreferrer"
            class="text-slate-400 hover:text-white"
          >
            Repositório ↗
          </a>
        </div>
      </article>
    </div>
  </section>
</template>
