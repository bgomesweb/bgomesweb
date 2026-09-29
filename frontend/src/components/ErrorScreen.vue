<script setup lang="ts">
defineProps<{ message: string }>()
const emit = defineEmits<{ retry: [] }>()
</script>

<template>
  <div class="flex min-h-screen items-center justify-center px-6">
    <div class="max-w-md text-center">
      <p class="text-lg font-semibold text-white">Não foi possível carregar o conteúdo.</p>
      <p class="mt-2 text-sm text-slate-400">{{ message }}</p>
      <button
        type="button"
        class="mt-6 rounded-full bg-brand-500 px-6 py-2.5 text-sm font-semibold text-white hover:bg-brand-400"
        @click="emit('retry')"
      >
        Tentar novamente
      </button>
    </div>
  </div>
</template>
