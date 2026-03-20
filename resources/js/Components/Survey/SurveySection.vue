<template>
  <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="bg-gradient-to-r from-primary-600 to-primary-500 px-5 py-3.5">
      <h3 class="text-white font-semibold text-sm">{{ title }}</h3>
    </div>
    <div class="px-5 py-2">
      <slot />
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: { type: String, required: true },
});
</script>
