<template>
  <Head title="404 - Not Found" />
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-slate-50 to-slate-100">
    <div class="text-center">
      <h1 class="text-8xl font-bold text-slate-200">404</h1>
      <p class="text-xl font-semibold text-slate-600 mt-4">Page not found</p>
      <p class="text-slate-400 mt-2 max-w-sm mx-auto">The page you're looking for doesn't exist or the survey link has expired.</p>
      <a href="/"
        class="inline-flex items-center gap-2 mt-8 px-6 py-2.5 bg-primary-600 text-white text-sm font-semibold rounded-xl hover:bg-primary-700 transition shadow-sm shadow-primary-600/20">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Go Home
      </a>
    </div>
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
</script>
