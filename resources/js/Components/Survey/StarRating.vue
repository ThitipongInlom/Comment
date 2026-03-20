<template>
  <div class="flex gap-1">
    <button v-for="star in 5" :key="star" type="button"
      @click="!readonly && $emit('update:modelValue', star)"
      @mouseenter="!readonly && (hovered = star)"
      @mouseleave="!readonly && (hovered = 0)"
      :class="[
        'transition-transform',
        readonly ? 'cursor-default' : 'cursor-pointer hover:scale-110',
        (hovered || modelValue) >= star ? 'text-amber-400' : 'text-slate-200'
      ]">
      <svg class="w-7 h-7" :fill="(hovered || modelValue) >= star ? 'currentColor' : 'none'"
        stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
      </svg>
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
  modelValue: { type: Number, default: 0 },
  readonly: { type: Boolean, default: false },
});

defineEmits(['update:modelValue']);

const hovered = ref(0);
</script>
