<script setup lang="ts">
import { computed, ref } from 'vue'

export interface DailyVisit {
  date: string
  total: number
  uniqueVisitors: number
}

const props = defineProps<{ daily: DailyVisit[] }>()

const width = 600
const height = 200
const paddingBottom = 24
const barGap = 2

const maxTotal = computed(() => Math.max(1, ...props.daily.map((d) => d.total)))

const barWidth = computed(() => {
  const slot = width / Math.max(1, props.daily.length)
  return Math.max(4, Math.min(24, slot - barGap))
})

const bars = computed(() =>
  props.daily.map((day, index) => {
    const slot = width / Math.max(1, props.daily.length)
    const barHeight = (day.total / maxTotal.value) * (height - paddingBottom)
    return {
      ...day,
      x: index * slot + (slot - barWidth.value) / 2,
      y: height - paddingBottom - barHeight,
      height: barHeight,
    }
  }),
)

const hovered = ref<(DailyVisit & { x: number; y: number }) | null>(null)

function formatDayLabel(date: string): string {
  const [, month, day] = date.split('-')
  return `${day}/${month}`
}
</script>

<template>
  <div class="relative">
    <svg :viewBox="`0 0 ${width} ${height}`" class="w-full" preserveAspectRatio="none">
      <line
        x1="0"
        :y1="height - paddingBottom"
        :x2="width"
        :y2="height - paddingBottom"
        stroke="rgba(255,255,255,0.15)"
        stroke-width="1"
      />

      <g v-for="bar in bars" :key="bar.date">
        <rect
          :x="bar.x"
          :y="bar.y"
          :width="barWidth"
          :height="Math.max(bar.height, 1)"
          rx="4"
          class="fill-brand-400 transition-opacity"
          :class="hovered?.date === bar.date ? 'opacity-100' : 'opacity-80'"
          @mouseenter="hovered = bar"
          @mouseleave="hovered = null"
        />
        <text
          :x="bar.x + barWidth / 2"
          :y="height - 8"
          text-anchor="middle"
          class="fill-slate-400"
          font-size="9"
        >
          {{ formatDayLabel(bar.date) }}
        </text>
      </g>
    </svg>

    <div
      v-if="hovered"
      class="pointer-events-none absolute -translate-x-1/2 -translate-y-full rounded-lg border border-white/10 bg-slate-900 px-3 py-2 text-xs shadow-lg"
      :style="{ left: `${((hovered.x + barWidth / 2) / width) * 100}%`, top: `${(hovered.y / height) * 100}%` }"
    >
      <p class="font-semibold text-white">{{ formatDayLabel(hovered.date) }}</p>
      <p class="text-slate-300">{{ hovered.total }} visita(s)</p>
      <p class="text-slate-400">{{ hovered.uniqueVisitors }} visitante(s) único(s)</p>
    </div>
  </div>
</template>
