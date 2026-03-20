<template>
  <Teleport to="body">
    <Transition
      enter-active-class="transition duration-200"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition duration-150"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" @click="$emit('close')" />
        <Transition
          enter-active-class="transition duration-200"
          enter-from-class="scale-95 opacity-0"
          enter-to-class="scale-100 opacity-100"
          leave-active-class="transition duration-150"
          leave-from-class="scale-100 opacity-100"
          leave-to-class="scale-95 opacity-0"
        >
          <div v-if="show" class="relative bg-white rounded-2xl shadow-xl w-full max-h-[90vh] overflow-visible border border-slate-200 flex flex-col"
            :class="sizeClass">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 shrink-0">
              <h3 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                <slot name="icon" />
                {{ title }}
              </h3>
              <button @click="$emit('close')"
                class="p-1 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            <div class="px-6 py-4 overflow-y-auto">
              <slot />
            </div>
            <div v-if="$slots.footer" class="px-6 py-3 border-t border-slate-100 bg-slate-50 rounded-b-2xl shrink-0">
              <slot name="footer" />
            </div>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  show: { type: Boolean, default: false },
  title: { type: String, default: '' },
  size: { type: String, default: 'md' },
});

defineEmits(['close']);

const sizeClass = computed(() => ({
  sm: 'max-w-sm',
  md: 'max-w-lg',
  lg: 'max-w-3xl',
  xl: 'max-w-5xl',
}[props.size] || 'max-w-lg'));
</script>
