<script setup lang="ts">
import { computed } from 'vue'
import type { Profile } from '@/types/portfolio'

const props = defineProps<{ profile: Profile | null }>()

const whatsappUrl = computed(() => {
  if (!props.profile) return '#'
  const message = encodeURIComponent(
    'Olá Bruno! Vi seu portfólio e gostaria de conversar sobre uma oportunidade.',
  )
  return `https://wa.me/${props.profile.whatsapp}?text=${message}`
})
</script>

<template>
  <section id="contato" class="mx-auto max-w-4xl px-6 py-24 text-center">
    <p class="section-eyebrow mb-3">Vamos conversar?</p>
    <h2 class="section-heading mb-6">Contato</h2>
    <p class="mx-auto mb-10 max-w-xl text-slate-300">
      Estou aberto a novas oportunidades, projetos e parcerias. Entre em contato pelo canal que
      preferir.
    </p>

    <div class="flex flex-wrap justify-center gap-4">
      <a
        :href="whatsappUrl"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center gap-2 rounded-full bg-[#25D366] px-6 py-3 font-semibold text-slate-950 transition-transform hover:scale-105"
      >
        WhatsApp
      </a>
      <a
        v-if="profile?.email"
        :href="`mailto:${profile.email}`"
        class="inline-flex items-center gap-2 rounded-full border border-white/20 px-6 py-3 font-semibold text-white transition-colors hover:bg-white/10"
      >
        {{ profile.email }}
      </a>
      <a
        v-if="profile?.linkedinUrl"
        :href="profile.linkedinUrl"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center gap-2 rounded-full border border-white/20 px-6 py-3 font-semibold text-white transition-colors hover:bg-white/10"
      >
        LinkedIn
      </a>
      <a
        v-if="profile?.githubUrl"
        :href="profile.githubUrl"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center gap-2 rounded-full border border-white/20 px-6 py-3 font-semibold text-white transition-colors hover:bg-white/10"
      >
        GitHub
      </a>
    </div>
  </section>
</template>
