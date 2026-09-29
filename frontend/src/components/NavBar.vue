<script setup lang="ts">
import { ref } from 'vue'
import type { Profile } from '@/types/portfolio'

defineProps<{ profile: Profile | null }>()

const isMenuOpen = ref(false)

const navLinks = [
  { href: '#sobre', label: 'Sobre' },
  { href: '#certificacao', label: 'Certificação' },
  { href: '#experiencia', label: 'Experiência' },
  { href: '#formacao', label: 'Formação' },
  { href: '#projetos', label: 'Projetos' },
  { href: '#contato', label: 'Contato' },
]

function closeMenu(): void {
  isMenuOpen.value = false
}
</script>

<template>
  <header
    class="fixed inset-x-0 top-0 z-40 border-b border-white/10 bg-slate-950/80 backdrop-blur-md"
  >
    <nav class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
      <a href="#topo" class="text-lg font-bold tracking-tight text-white">
        bgomesweb
      </a>

      <ul class="hidden items-center gap-8 text-sm font-medium text-slate-300 md:flex">
        <li v-for="link in navLinks" :key="link.href">
          <a :href="link.href" class="transition-colors hover:text-white">{{ link.label }}</a>
        </li>
      </ul>

      <a
        v-if="profile?.resumeUrl"
        :href="profile.resumeUrl"
        target="_blank"
        rel="noopener noreferrer"
        class="hidden rounded-full bg-brand-500 px-5 py-2 text-sm font-semibold text-white shadow shadow-brand-900/40 transition-colors hover:bg-brand-400 md:inline-flex"
      >
        Baixar currículo
      </a>

      <button
        type="button"
        class="text-slate-200 md:hidden"
        aria-label="Abrir menu"
        @click="isMenuOpen = !isMenuOpen"
      >
        <svg viewBox="0 0 24 24" class="h-7 w-7 fill-none stroke-current stroke-2">
          <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </nav>

    <div v-if="isMenuOpen" class="border-t border-white/10 bg-slate-950 md:hidden">
      <ul class="flex flex-col gap-1 px-6 py-4 text-sm font-medium text-slate-200">
        <li v-for="link in navLinks" :key="link.href">
          <a :href="link.href" class="block py-2" @click="closeMenu">{{ link.label }}</a>
        </li>
        <li v-if="profile?.resumeUrl">
          <a
            :href="profile.resumeUrl"
            target="_blank"
            rel="noopener noreferrer"
            class="mt-2 block rounded-full bg-brand-500 px-5 py-2 text-center font-semibold text-white"
            @click="closeMenu"
          >
            Baixar currículo
          </a>
        </li>
      </ul>
    </div>
  </header>
</template>
