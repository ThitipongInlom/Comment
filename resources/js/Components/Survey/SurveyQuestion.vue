<template>
  <div class="py-4 border-b border-slate-100 last:border-0">
    <div class="flex flex-col sm:flex-row sm:items-start gap-3">
      <p class="flex-1 text-sm text-slate-700">
        <span class="font-semibold text-slate-400 mr-1.5">{{ number }}.</span>
        {{ text }}
      </p>
      <div class="flex items-center gap-2 shrink-0">
        <!-- Yes Button -->
        <button type="button"
          @click="!readonly && $emit('update:answer', 'yes')"
          :disabled="readonly"
          :class="[
            'inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 border',
            answer === 'yes'
              ? 'bg-emerald-50 border-emerald-200 text-emerald-700 shadow-sm shadow-emerald-100'
              : readonly
                ? 'bg-slate-50 border-slate-200 text-slate-400'
                : 'bg-white border-slate-200 text-slate-500 hover:border-emerald-300 hover:text-emerald-600 hover:bg-emerald-50/50'
          ]">
          <svg v-if="answer === 'yes'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
          </svg>
          <span :class="['w-3.5 h-3.5 rounded-full border-2 transition-all', answer === 'yes' ? 'border-emerald-500 bg-emerald-500' : 'border-slate-300']" v-else />
          {{ locale === 'th' ? 'ใช่' : 'Yes' }}
        </button>

        <!-- No Button -->
        <button type="button"
          @click="!readonly && $emit('update:answer', 'no')"
          :disabled="readonly"
          :class="[
            'inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 border',
            answer === 'no'
              ? 'bg-red-50 border-red-200 text-red-700 shadow-sm shadow-red-100'
              : readonly
                ? 'bg-slate-50 border-slate-200 text-slate-400'
                : 'bg-white border-slate-200 text-slate-500 hover:border-red-300 hover:text-red-600 hover:bg-red-50/50'
          ]">
          <svg v-if="answer === 'no'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
          </svg>
          <span :class="['w-3.5 h-3.5 rounded-full border-2 transition-all', answer === 'no' ? 'border-red-500 bg-red-500' : 'border-slate-300']" v-else />
          {{ locale === 'th' ? 'ไม่' : 'No' }}
        </button>
      </div>
    </div>
    <div class="mt-2.5">
      <input v-if="!readonly" type="text" :value="comment"
        @input="$emit('update:comment', $event.target.value)"
        :placeholder="locale === 'th' ? 'ความคิดเห็น (ไม่บังคับ)' : 'Comment (optional)'"
        class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl
               focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 focus:bg-white transition">
      <p v-else-if="comment" class="text-sm text-slate-500 italic mt-1">{{ comment }}</p>
    </div>
  </div>
</template>

<script setup>
defineProps({
  number: { type: Number, required: true },
  text: { type: String, required: true },
  answer: { type: String, default: '' },
  comment: { type: String, default: '' },
  locale: { type: String, default: 'en' },
  readonly: { type: Boolean, default: false },
});

defineEmits(['update:answer', 'update:comment']);
</script>
