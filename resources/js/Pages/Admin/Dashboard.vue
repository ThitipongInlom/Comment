<template>
  <Head title="Dashboard" />
  <AdminLayout>
    <div class="space-y-6">
      <div>
        <h2 class="text-xl font-bold text-slate-900">Dashboard</h2>
        <p class="text-sm text-slate-500 mt-0.5">Overview of your survey system</p>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
          <div class="flex items-center gap-4">
            <div class="w-11 h-11 bg-primary-50 rounded-xl flex items-center justify-center">
              <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
              </svg>
            </div>
            <div>
              <p class="text-2xl font-bold text-slate-900">{{ stats.total_links }}</p>
              <p class="text-xs text-slate-500 mt-0.5">Survey Links</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
          <div class="flex items-center gap-4">
            <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center">
              <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
              </svg>
            </div>
            <div>
              <p class="text-2xl font-bold text-slate-900">{{ stats.total_responses }}</p>
              <p class="text-xs text-slate-500 mt-0.5">Total Responses</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
          <div class="flex items-center gap-4">
            <div class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center">
              <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <div>
              <p class="text-2xl font-bold text-slate-900">{{ stats.active_links }}</p>
              <p class="text-xs text-slate-500 mt-0.5">Active Links</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Survey Links -->
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
          <h3 class="font-semibold text-slate-900">Recent Survey Links</h3>
          <a href="/admin/survey-links"
            class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary-50 text-primary-600 border border-primary-200 hover:bg-primary-100 rounded-lg text-xs font-semibold transition">
            View All
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </a>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-slate-100">
                <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Group Name</th>
                <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Room</th>
                <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Guests</th>
                <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Responses</th>
                <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Created</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
              <tr v-for="link in recentLinks" :key="link.id" class="hover:bg-slate-50/50 transition">
                <td class="px-5 py-3 font-medium text-slate-900">{{ link.group_name }}</td>
                <td class="px-5 py-3 text-center text-slate-600">{{ link.room?.name || '-' }}</td>
                <td class="px-5 py-3 text-center text-slate-600">{{ link.guest_count }}</td>
                <td class="px-5 py-3 text-center">
                  <span class="inline-flex items-center px-2.5 py-1 bg-primary-50 text-primary-700 rounded-lg text-xs font-semibold">
                    {{ link.responses_count }}
                  </span>
                </td>
                <td class="px-5 py-3 text-center">
                  <span :class="['px-2.5 py-1 rounded-lg text-xs font-semibold',
                    link.is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500']">
                    {{ link.is_active ? 'Active' : 'Inactive' }}
                  </span>
                </td>
                <td class="px-5 py-3 text-center text-xs text-slate-500">{{ formatDate(link.created_at) }}</td>
              </tr>
              <tr v-if="recentLinks.length === 0">
                <td colspan="6" class="px-5 py-8 text-center text-slate-400 text-sm">No survey links yet</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

defineProps({
  stats: { type: Object, default: () => ({ total_links: 0, total_responses: 0, active_links: 0 }) },
  recentLinks: { type: Array, default: () => [] },
});

function formatDate(d) {
  if (!d) return '-';
  return new Date(d).toLocaleDateString('th-TH', { day: '2-digit', month: '2-digit', year: 'numeric' });
}
</script>
