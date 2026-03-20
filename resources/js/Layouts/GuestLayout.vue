<template>
  <div class="min-h-screen" :style="backgroundStyle">
    <!-- Overlay when background image is used -->
    <div v-if="backgroundUrl" class="fixed inset-0 bg-black/30 z-0" />

    <div class="relative z-[1]">
      <header class="bg-white/80 backdrop-blur-sm border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-3xl mx-auto px-4 py-4 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <img v-if="logoUrl" :src="logoUrl" :alt="title" class="w-10 h-10 rounded-xl object-cover shrink-0">
            <h1 class="text-lg font-semibold text-slate-800">{{ title }}</h1>
          </div>
          <slot name="header-actions" />
        </div>
      </header>
      <main class="max-w-3xl mx-auto px-4 py-8">
        <slot />
      </main>
      <footer v-if="footerText" class="max-w-3xl mx-auto px-4 py-8 text-center text-sm"
        :class="backgroundUrl ? 'text-white/70' : 'text-slate-400'">
        {{ footerText }}
      </footer>
    </div>

    <!-- Scroll to Top -->
    <Transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="opacity-0 translate-y-4"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 translate-y-4"
    >
      <button v-show="showScrollTop" @click="scrollToTop"
        class="fixed bottom-6 right-6 z-20 w-11 h-11 bg-primary-600 hover:bg-primary-700 text-white rounded-full
               shadow-lg shadow-primary-600/30 flex items-center justify-center transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
        </svg>
      </button>
    </Transition>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
  title: { type: String, default: '' },
  footerText: { type: String, default: '' },
  logoUrl: { type: String, default: null },
  backgroundUrl: { type: String, default: null },
});

const backgroundStyle = computed(() => {
  if (props.backgroundUrl) {
    return {
      backgroundImage: `url(${props.backgroundUrl})`,
      backgroundSize: 'cover',
      backgroundPosition: 'center',
      backgroundAttachment: 'fixed',
    };
  }
  return {
    background: 'linear-gradient(to bottom, rgb(248 250 252), rgb(241 245 249))',
  };
});

const showScrollTop = ref(false);

function handleScroll() {
  showScrollTop.value = window.scrollY > 300;
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

onMounted(() => window.addEventListener('scroll', handleScroll));
onUnmounted(() => window.removeEventListener('scroll', handleScroll));
</script>
