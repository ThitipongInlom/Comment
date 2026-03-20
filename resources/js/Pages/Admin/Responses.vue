<template>
  <Head :title="`Responses: ${link.group_name}`" />
  <AdminLayout>
    <div class="space-y-6">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xl font-bold text-slate-900">{{ link.group_name }}</h2>
          <p class="text-sm text-slate-500 mt-0.5">{{ responses.length }} responses</p>
        </div>
        <a href="/admin/dashboard"
          class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back
        </a>
      </div>

      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-slate-100">
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Telephone</th>
              <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Rating</th>
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Submitted</th>
              <th class="px-5 py-3.5"></th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-50">
            <tr v-for="r in responses" :key="r.id" class="hover:bg-slate-50/50 transition">
              <td class="px-5 py-3.5 text-slate-400">{{ r.response_number }}</td>
              <td class="px-5 py-3.5 font-medium text-slate-900">{{ r.first_name }} {{ r.last_name }}</td>
              <td class="px-5 py-3.5 text-slate-600">{{ r.email || '-' }}</td>
              <td class="px-5 py-3.5 text-slate-600">{{ r.telephone || '-' }}</td>
              <td class="px-5 py-3.5 text-center">
                <span v-if="r.overall_rating" class="text-amber-500 font-semibold">{{ r.overall_rating }}/5</span>
                <span v-else class="text-slate-300">-</span>
              </td>
              <td class="px-5 py-3.5 text-xs text-slate-500">{{ formatDate(r.submitted_at) }}</td>
              <td class="px-5 py-3.5">
                <a :href="`/en/${link.slug}/${r.response_number}`" target="_blank"
                  class="text-primary-600 hover:text-primary-700 text-xs font-semibold">View</a>
              </td>
            </tr>
            <tr v-if="responses.length === 0">
              <td colspan="7" class="px-5 py-12 text-center text-slate-400">
                <svg class="w-8 h-8 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                No responses yet
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

defineProps({
  link: Object,
  responses: { type: Array, default: () => [] },
});

function formatDate(d) {
  if (!d) return '-';
  return new Date(d).toLocaleString('th-TH');
}
</script>
