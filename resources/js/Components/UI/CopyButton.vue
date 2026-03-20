<template>
  <button @click="copy" class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded-lg transition"
    :class="copied ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700'">
    <svg v-if="!copied" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
    </svg>
    <svg v-else class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    {{ copied ? 'Copied!' : 'Copy' }}
  </button>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  text: { type: String, required: true },
});

const copied = ref(false);

async function copy() {
  try {
    await navigator.clipboard.writeText(props.text);
    copied.value = true;
    setTimeout(() => (copied.value = false), 2000);
  } catch {
    const el = document.createElement('textarea');
    el.value = props.text;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    copied.value = true;
    setTimeout(() => (copied.value = false), 2000);
  }
}
</script>
