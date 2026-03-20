<template>
  <div class="flex rounded-xl overflow-hidden border border-slate-200">
    <a :href="`/en/${slug}`"
      :class="['px-3.5 py-1.5 text-xs font-semibold transition',
        locale === 'en' ? 'bg-primary-600 text-white' : 'bg-white text-slate-500 hover:bg-slate-50']">
      EN
    </a>
    <a :href="`/th/${slug}`"
      :class="['px-3.5 py-1.5 text-xs font-semibold transition border-l border-slate-200',
        locale === 'th' ? 'bg-primary-600 text-white' : 'bg-white text-slate-500 hover:bg-slate-50']">
      TH
    </a>
  </div>
</template>

<script setup>
defineProps({
  locale: { type: String, required: true },
  slug: { type: String, required: true },
});
</script>
