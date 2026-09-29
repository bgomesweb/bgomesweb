<script setup lang="ts">
import { computed } from 'vue'
import type { Profile } from '@/types/portfolio'

const props = defineProps<{ profile: Profile | null }>()

const whatsappUrl = computed(() => {
  if (!props.profile) return '#'
  const message = encodeURIComponent(
    `Olá Bruno! Vi seu portfólio e gostaria de conversar sobre uma oportunidade.`,
  )
  return `https://wa.me/${props.profile.whatsapp}?text=${message}`
})
</script>

<template>
  <section
    id="topo"
    class="relative flex min-h-screen items-center overflow-hidden pt-24"
  >
    <div
      class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(38,87,245,0.25),transparent_45%),radial-gradient(circle_at_80%_0%,rgba(56,189,248,0.15),transparent_40%)]"
    ></div>

    <div class="relative mx-auto grid max-w-6xl gap-12 px-6 py-16 md:grid-cols-[2fr_1fr] md:items-center">
      <div>
        <p class="section-eyebrow mb-4">Tech Lead & Desenvolvedor Backend PHP</p>
        <h1 class="text-4xl font-extrabold leading-tight text-white sm:text-5xl lg:text-6xl">
          {{ profile?.name ?? 'Bruno Gomes da Silva' }}
        </h1>
        <p class="mt-6 max-w-2xl text-lg text-slate-300">
          {{ profile?.title }}
        </p>
        <p class="mt-4 max-w-2xl text-slate-400">
          {{ profile?.location }} · Mais de 10 anos de experiência com PHP, Adobe Commerce
          (Magento 2), Laravel e Vue.js.
        </p>

        <div class="mt-10 flex flex-wrap gap-4">
          <a
            :href="whatsappUrl"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 rounded-full bg-[#25D366] px-6 py-3 font-semibold text-slate-950 shadow-lg shadow-black/20 transition-transform hover:scale-105"
          >
            Falar no WhatsApp
          </a>
          <a
            v-if="profile?.resumeUrl"
            :href="profile.resumeUrl"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 rounded-full border border-white/20 px-6 py-3 font-semibold text-white transition-colors hover:bg-white/10"
          >
            Baixar currículo
          </a>
          <a
            href="#certificacao"
            class="inline-flex items-center gap-2 rounded-full border border-brand-400/40 px-6 py-3 font-semibold text-brand-300 transition-colors hover:bg-brand-500/10"
          >
            Ver certificação Adobe
          </a>
        </div>

        <div class="mt-10 flex flex-wrap gap-5 text-sm text-slate-400">
          <a v-if="profile?.email" :href="`mailto:${profile.email}`" class="hover:text-white">
            {{ profile.email }}
          </a>
          <a v-if="profile?.phone" :href="`tel:${profile.phone}`" class="hover:text-white">
            {{ profile.phone }}
          </a>
          <a
            v-if="profile?.linkedinUrl"
            :href="profile.linkedinUrl"
            target="_blank"
            rel="noopener noreferrer"
            class="hover:text-white"
          >
            LinkedIn
          </a>
          <a
            v-if="profile?.githubUrl"
            :href="profile.githubUrl"
            target="_blank"
            rel="noopener noreferrer"
            class="hover:text-white"
          >
            GitHub
          </a>
        </div>
      </div>

      <div class="mx-auto flex h-56 w-56 items-center justify-center rounded-full border border-white/10 bg-gradient-to-br from-brand-500/30 to-transparent text-6xl font-black text-brand-300 sm:h-64 sm:w-64">
        BG
      </div>
    </div>
  </section>
</template>
