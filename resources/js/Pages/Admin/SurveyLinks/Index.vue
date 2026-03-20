<template>
  <Head title="Survey Links" />
  <AdminLayout>
    <div class="space-y-6">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xl font-bold text-slate-900">Survey Links</h2>
          <p class="text-sm text-slate-500 mt-0.5">Manage all your survey links</p>
        </div>
        <button @click="showCreateModal = true"
          class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl transition shadow-sm shadow-primary-600/20">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Create Link
        </button>
      </div>

      <!-- Profile Selector -->
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4">
        <label class="flex items-center gap-2 text-sm font-medium text-slate-700 mb-2">
          <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
          Hotel Profile
        </label>
        <vSelect
          :modelValue="selectedProfileId"
          @update:modelValue="switchProfile"
          :options="profileOptions"
          :reduce="opt => opt.value"
          :clearable="false"
          placeholder="Select a hotel profile"
        />
      </div>

      <!-- Search -->
      <div class="relative max-w-xs">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input v-model="search" type="text" placeholder="Search links..."
          class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm
                 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
      </div>

      <!-- Table -->
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-slate-100">
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Group Name</th>
                <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Guests</th>
                <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Room</th>
                <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Stay Date</th>
                <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Links</th>
                <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Responses</th>
                <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
              <tr v-for="link in filteredLinks" :key="link.id" class="hover:bg-slate-50/50 transition">
                <td class="px-5 py-3.5 font-medium text-slate-900">{{ link.group_name }}</td>
                <td class="px-5 py-3.5 text-center text-slate-600">{{ link.guest_count }}</td>
                <td class="px-5 py-3.5 text-center text-slate-600">{{ link.room?.name || '-' }}</td>
                <td class="px-5 py-3.5 text-center text-slate-500 text-xs">
                  {{ formatDate(link.staying_from) }}
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center justify-center gap-1.5">
                    <a :href="`/en/${link.slug}`" target="_blank"
                      class="px-2.5 py-1 bg-slate-50 text-slate-600 border border-slate-200 rounded-lg text-xs font-medium hover:bg-slate-100 transition">EN</a>
                    <a :href="`/th/${link.slug}`" target="_blank"
                      class="px-2.5 py-1 bg-slate-50 text-slate-600 border border-slate-200 rounded-lg text-xs font-medium hover:bg-slate-100 transition">TH</a>
                    <CopyButton :text="baseUrl + '/en/' + link.slug" />
                  </div>
                </td>
                <td class="px-5 py-3.5 text-center">
                  <span class="inline-flex items-center px-2.5 py-1 bg-primary-50 text-primary-700 rounded-lg text-xs font-semibold">
                    {{ link.responses_count }}
                  </span>
                </td>
                <td class="px-5 py-3.5 text-center">
                  <button @click="toggleStatus(link)"
                    :class="['relative inline-flex h-6 w-11 rounded-full transition-colors duration-200',
                      link.is_active ? 'bg-emerald-500' : 'bg-slate-200']">
                    <span :class="['inline-block h-5 w-5 rounded-full bg-white shadow-sm transform transition-transform duration-200 mt-0.5',
                      link.is_active ? 'translate-x-5' : 'translate-x-0.5']" />
                  </button>
                </td>
                <td class="px-5 py-3.5 text-center">
                  <button @click="viewResponses(link)"
                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary-50 text-primary-600 border border-primary-200 hover:bg-primary-100 rounded-lg text-xs font-semibold transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    View
                  </button>
                </td>
              </tr>
              <tr v-if="filteredLinks.length === 0">
                <td colspan="8" class="px-5 py-12 text-center text-slate-400">
                  <svg class="w-8 h-8 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                  </svg>
                  No links found
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Create Link Modal -->
      <Modal :show="showCreateModal" title="Create Survey Link" @close="closeCreateModal">
        <template #icon>
          <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
          </svg>
        </template>
        <form @submit.prevent="submitCreate" class="space-y-5">
          <div>
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
              <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              Group Name
            </label>
            <input v-model="createForm.group_name" @blur="v$.group_name.$touch()" type="text"
              :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                v$.group_name.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
              placeholder="e.g. Wedding Reception - Smith">
            <p v-if="v$.group_name.$error" class="text-xs text-red-500 mt-1.5">{{ v$.group_name.$errors[0].$message }}</p>
            <p v-else-if="createForm.errors.group_name" class="text-xs text-red-500 mt-1.5">{{ createForm.errors.group_name }}</p>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Number of Guests
              </label>
              <input v-model="createForm.guest_count" @blur="v$.guest_count.$touch()" type="number" min="1"
                :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                  v$.guest_count.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
                placeholder="e.g. 50">
              <p v-if="v$.guest_count.$error" class="text-xs text-red-500 mt-1.5">{{ v$.guest_count.$errors[0].$message }}</p>
              <p v-else-if="createForm.errors.guest_count" class="text-xs text-red-500 mt-1.5">{{ createForm.errors.guest_count }}</p>
            </div>
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" />
                </svg>
                Room
              </label>
              <vSelect
                v-model="selectedRoom"
                :options="roomOptions"
                :reduce="opt => opt.value"
                placeholder="Select a room"
                :clearable="false"
                append-to-body
                :class="{ 'vs--error': v$.room_id.$error }"
              />
              <p v-if="v$.room_id.$error" class="text-xs text-red-500 mt-1.5">{{ v$.room_id.$errors[0].$message }}</p>
              <p v-else-if="createForm.errors.room_id" class="text-xs text-red-500 mt-1.5">{{ createForm.errors.room_id }}</p>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Stay From
              </label>
              <flat-pickr
                v-model="createForm.staying_from"
                :config="dateConfig"
                :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                  v$.staying_from.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
                placeholder="Select date"
              />
              <p v-if="v$.staying_from.$error" class="text-xs text-red-500 mt-1.5">{{ v$.staying_from.$errors[0].$message }}</p>
              <p v-else-if="createForm.errors.staying_from" class="text-xs text-red-500 mt-1.5">{{ createForm.errors.staying_from }}</p>
            </div>
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Stay To
              </label>
              <flat-pickr
                v-model="createForm.staying_to"
                :config="dateConfig"
                :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                  v$.staying_to.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
                placeholder="Select date"
              />
              <p v-if="v$.staying_to.$error" class="text-xs text-red-500 mt-1.5">{{ v$.staying_to.$errors[0].$message }}</p>
              <p v-else-if="createForm.errors.staying_to" class="text-xs text-red-500 mt-1.5">{{ createForm.errors.staying_to }}</p>
            </div>
          </div>
          <div class="pt-2">
            <button type="submit" :disabled="createForm.processing"
              class="w-full py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl
                     transition shadow-sm shadow-primary-600/20 disabled:opacity-50 inline-flex items-center justify-center gap-2">
              <svg v-if="createForm.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
              </svg>
              <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
              </svg>
              {{ createForm.processing ? 'Creating...' : 'Create Link' }}
            </button>
          </div>
        </form>
      </Modal>

      <!-- Response Modal -->
      <Modal :show="showResponseModal" :title="'Responses: ' + selectedLink?.group_name" size="lg" @close="showResponseModal = false">
        <template #icon>
          <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
          </svg>
        </template>
        <div v-if="modalResponses.length">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-slate-100">
                <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
                <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                <th class="px-4 py-2.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Rating</th>
                <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                <th class="px-4 py-2.5"></th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
              <tr v-for="r in modalResponses" :key="r.id" class="hover:bg-slate-50/50">
                <td class="px-4 py-2.5 text-slate-500">{{ r.response_number }}</td>
                <td class="px-4 py-2.5 font-medium text-slate-900">{{ r.first_name }} {{ r.last_name }}</td>
                <td class="px-4 py-2.5 text-slate-600">{{ r.email || '-' }}</td>
                <td class="px-4 py-2.5 text-center">
                  <span v-if="r.overall_rating" class="text-amber-500 font-semibold">{{ r.overall_rating }}/5</span>
                  <span v-else class="text-slate-300">-</span>
                </td>
                <td class="px-4 py-2.5 text-xs text-slate-500">{{ formatDateTime(r.submitted_at) }}</td>
                <td class="px-4 py-2.5">
                  <a :href="`/en/${selectedLink.slug}/${r.response_number}`" target="_blank"
                    class="inline-flex items-center gap-1 px-2.5 py-1 bg-primary-50 text-primary-600 border border-primary-200 hover:bg-primary-100 rounded-lg text-xs font-semibold transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    View
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-else class="text-center py-8">
          <svg class="w-8 h-8 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          <p class="text-slate-400 text-sm">No responses yet</p>
        </div>
      </Modal>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { useVuelidate } from '@vuelidate/core';
import { useValidators } from '../../../Utils/validators';

const { required, integer, minValue } = useValidators();
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Modal from '../../../Components/UI/Modal.vue';
import CopyButton from '../../../Components/UI/CopyButton.vue';
import vSelect from 'vue-select';
import flatPickr from 'vue-flatpickr-component';
import 'vue-select/dist/vue-select.css';
import 'flatpickr/dist/flatpickr.css';

const props = defineProps({
  links: { type: Array, default: () => [] },
  rooms: { type: Array, default: () => [] },
  profiles: { type: Array, default: () => [] },
  selectedProfileId: { type: Number, default: null },
});

const profileOptions = computed(() =>
  props.profiles.map(p => ({ label: p.name, value: p.id }))
);

function switchProfile(profileId) {
  router.get('/admin/survey-links', { profile_id: profileId }, {
    preserveState: true,
    preserveScroll: true,
  });
}

const search = ref('');
const showCreateModal = ref(false);
const showResponseModal = ref(false);
const selectedLink = ref(null);
const modalResponses = ref([]);
const baseUrl = window.location.origin;

// Room select options
const roomOptions = computed(() =>
  props.rooms.map(r => ({ label: r.name, value: r.id }))
);
const selectedRoom = ref('');

// Sync selectedRoom → createForm.room_id
watch(selectedRoom, (val) => {
  createForm.room_id = val || '';
});

// Flatpickr config
const dateConfig = {
  dateFormat: 'Y-m-d',
  altInput: true,
  altFormat: 'd/m/Y',
  allowInput: true,
};

const filteredLinks = computed(() => {
  if (!search.value) return props.links;
  const q = search.value.toLowerCase();
  return props.links.filter(l =>
    l.group_name.toLowerCase().includes(q) ||
    l.room?.name?.toLowerCase().includes(q)
  );
});

// Create Link
const createForm = useForm({
  group_name: '',
  guest_count: '',
  room_id: '',
  staying_from: '',
  staying_to: '',
});

const createRules = computed(() => ({
  group_name: { required },
  guest_count: { required, integer, minValue: minValue(1) },
  room_id: { required },
  staying_from: { required },
  staying_to: { required },
}));

const v$ = useVuelidate(createRules, createForm);

async function submitCreate() {
  const valid = await v$.value.$validate();
  if (!valid) return;

  createForm.post('/admin/survey-links', {
    onSuccess: () => {
      showCreateModal.value = false;
      createForm.reset();
      selectedRoom.value = '';
      v$.value.$reset();
    },
  });
}

function closeCreateModal() {
  showCreateModal.value = false;
  createForm.reset();
  selectedRoom.value = '';
  v$.value.$reset();
}

function toggleStatus(link) {
  router.post(`/admin/survey-links/${link.id}/toggle`, {}, { preserveScroll: true });
}

async function viewResponses(link) {
  selectedLink.value = link;
  try {
    const res = await fetch(`/admin/survey-links/${link.id}/responses`, {
      headers: { 'Accept': 'application/json' },
    });
    const data = await res.json();
    modalResponses.value = data.responses || [];
  } catch {
    modalResponses.value = [];
  }
  showResponseModal.value = true;
}

function formatDate(d) {
  if (!d) return '-';
  return new Date(d).toLocaleDateString('th-TH', { day: '2-digit', month: '2-digit', year: 'numeric' });
}

function formatDateTime(d) {
  if (!d) return '-';
  return new Date(d).toLocaleString('th-TH');
}
</script>

<style>
/* vue-select custom theme */
.vs__dropdown-toggle {
  padding: 0.5rem 0.75rem;
  background: rgb(248 250 252);
  border: 1px solid rgb(226 232 240);
  border-radius: 0.75rem;
  min-height: 42px;
}
.vs__dropdown-toggle:has(.vs--open) ,
.vs__dropdown-toggle:focus-within {
  border-color: rgb(59 130 246);
  box-shadow: 0 0 0 2px rgb(59 130 246 / 0.2);
  background: white;
}
.vs__search::placeholder {
  color: rgb(148 163 184);
}
.vs__dropdown-menu {
  border: 1px solid rgb(226 232 240);
  border-radius: 0.75rem;
  box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
  margin-top: 4px;
  padding: 4px;
}
.vs__dropdown-option {
  border-radius: 0.5rem;
  padding: 0.5rem 0.75rem;
  font-size: 0.875rem;
}
.vs__dropdown-option--highlight {
  background: rgb(239 246 255);
  color: rgb(29 78 216);
}
.vs__clear, .vs__open-indicator {
  fill: rgb(148 163 184);
}
.vs__selected {
  font-size: 0.875rem;
  margin: 0;
  padding: 0;
}

/* flatpickr custom theme */
.flatpickr-calendar {
  border-radius: 0.75rem;
  box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  border: 1px solid rgb(226 232 240);
}
.flatpickr-day.selected,
.flatpickr-day.startRange,
.flatpickr-day.endRange {
  background: rgb(37 99 235);
  border-color: rgb(37 99 235);
}
.flatpickr-day.today {
  border-color: rgb(37 99 235);
}
.flatpickr-day:hover {
  background: rgb(239 246 255);
  border-color: rgb(239 246 255);
}
.flatpickr-months .flatpickr-month {
  border-radius: 0.75rem 0.75rem 0 0;
}

/* vue-select error state */
.vs--error .vs__dropdown-toggle {
  border-color: rgb(252 165 165);
}
.vs--error .vs__dropdown-toggle:focus-within {
  border-color: rgb(239 68 68);
  box-shadow: 0 0 0 2px rgb(239 68 68 / 0.2);
}
</style>
