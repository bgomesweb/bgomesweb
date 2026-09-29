<script setup lang="ts">
import { computed } from 'vue'
import type { Certification, ComplementaryCertificate } from '@/types/portfolio'

const props = defineProps<{
  certifications: Certification[]
  complementaryCertificates: ComplementaryCertificate[]
}>()

const featuredCertification = computed(
  () => props.certifications.find((certification) => certification.featured) ?? null,
)

const otherCertifications = computed(() =>
  props.certifications.filter((certification) => !certification.featured),
)

function formatDate(value: string | null): string {
  if (!value) return ''
  return new Date(value).toLocaleDateString('pt-BR', {
    month: 'long',
    year: 'numeric',
    timeZone: 'UTC',
  })
}
</script>

<template>
  <section id="certificacao" class="relative overflow-hidden py-24">
    <div
      class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_50%_0%,rgba(237,28,36,0.12),transparent_55%)]"
    ></div>

    <div class="relative mx-auto max-w-5xl px-6">
      <p class="section-eyebrow mb-3 text-center">Destaque</p>
      <h2 class="section-heading mb-12 text-center">Certificação Adobe</h2>

      <div
        v-if="featuredCertification"
        class="relative mx-auto max-w-3xl overflow-hidden rounded-3xl border border-[#ED1C24]/30 bg-gradient-to-br from-[#ED1C24]/10 via-white/5 to-transparent p-1 shadow-2xl shadow-black/40"
      >
        <div class="rounded-[calc(1.5rem-4px)] bg-slate-950/80 p-8 sm:p-10">
          <div class="flex flex-col items-start gap-6 sm:flex-row sm:items-center">
            <div
              class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-[#ED1C24] text-2xl font-black text-white"
            >
              Ai
            </div>
            <div>
              <span
                class="inline-block rounded-full bg-[#ED1C24]/15 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-[#ff6b6f]"
              >
                Adobe Certified Expert
              </span>
              <h3 class="mt-2 text-2xl font-bold text-white sm:text-3xl">
                {{ featuredCertification.name }}
              </h3>
              <p class="mt-1 text-slate-400">{{ featuredCertification.issuer }}</p>
            </div>
          </div>

          <p v-if="featuredCertification.description" class="mt-6 text-slate-300">
            {{ featuredCertification.description }}
          </p>

          <dl class="mt-8 grid grid-cols-2 gap-4 text-sm sm:grid-cols-3">
            <div>
              <dt class="text-slate-500">Obtida em</dt>
              <dd class="font-semibold text-white">
                {{ formatDate(featuredCertification.issuedAt) }}
              </dd>
            </div>
            <div v-if="featuredCertification.expiresAt">
              <dt class="text-slate-500">Válida até</dt>
              <dd class="font-semibold text-white">
                {{ formatDate(featuredCertification.expiresAt) }}
              </dd>
            </div>
          </dl>

          <div class="mt-8 flex flex-wrap gap-3">
            <a
              v-if="featuredCertification.fileUrl"
              :href="featuredCertification.fileUrl"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center gap-2 rounded-full bg-[#ED1C24] px-5 py-2.5 text-sm font-semibold text-white transition-transform hover:scale-105"
            >
              Ver certificado (PDF)
            </a>
            <a
              v-if="featuredCertification.credentialUrl"
              :href="featuredCertification.credentialUrl"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center gap-2 rounded-full border border-white/20 px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-white/10"
            >
              Validar credencial
            </a>
          </div>
        </div>
      </div>

      <div
        v-if="otherCertifications.length || complementaryCertificates.length"
        class="mx-auto mt-12 max-w-3xl"
      >
        <h3 class="mb-4 text-center text-sm font-semibold uppercase tracking-widest text-slate-500">
          Outros certificados
        </h3>
        <div class="flex flex-wrap justify-center gap-2">
          <span
            v-for="certification in otherCertifications"
            :key="certification.id"
            class="rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs text-slate-300"
          >
            {{ certification.name }} · {{ certification.issuer }}
          </span>
          <span
            v-for="complementary in complementaryCertificates"
            :key="complementary.id"
            class="rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs text-slate-300"
          >
            {{ complementary.name }} · {{ complementary.issuer }}
          </span>
        </div>
      </div>
    </div>
  </section>
</template>
