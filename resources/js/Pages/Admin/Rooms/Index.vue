<template>
  <Head title="Rooms" />
  <AdminLayout>
    <div class="space-y-6">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xl font-bold text-slate-900">Rooms</h2>
          <p class="text-sm text-slate-500 mt-0.5">Manage rooms by hotel profile</p>
        </div>
        <button @click="openCreate" :disabled="!selectedProfileId"
          :class="['inline-flex items-center gap-2 px-4 py-2.5 text-white text-sm font-semibold rounded-xl transition shadow-sm',
            selectedProfileId
              ? 'bg-primary-600 hover:bg-primary-700 shadow-primary-600/20'
              : 'bg-slate-300 cursor-not-allowed']">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Add Room
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

      <!-- Rooms Table -->
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-slate-100">
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
              <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Survey Links</th>
              <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-50">
            <tr v-for="(room, i) in rooms" :key="room.id" class="hover:bg-slate-50/50 transition">
              <td class="px-5 py-3.5 text-slate-400">{{ i + 1 }}</td>
              <td class="px-5 py-3.5 font-medium text-slate-900">{{ room.name }}</td>
              <td class="px-5 py-3.5 text-center">
                <span class="inline-flex items-center px-2.5 py-1 bg-primary-50 text-primary-700 rounded-lg text-xs font-semibold">
                  {{ room.survey_links_count }}
                </span>
              </td>
              <td class="px-5 py-3.5 text-center">
                <div class="inline-flex items-center gap-1.5">
                  <button @click="openEdit(room)"
                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary-50 text-primary-600 border border-primary-200 hover:bg-primary-100 rounded-lg text-xs font-semibold transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                  </button>
                  <button @click="confirmDelete(room)"
                    :disabled="room.survey_links_count > 0"
                    :class="['inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold transition border',
                      room.survey_links_count > 0
                        ? 'bg-slate-50 text-slate-300 border-slate-100 cursor-not-allowed'
                        : 'bg-red-50 text-red-600 border-red-200 hover:bg-red-100']">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete
                  </button>
                </div>
              </td>
            </tr>
            <tr v-if="rooms.length === 0">
              <td colspan="4" class="px-5 py-12 text-center text-slate-400 text-sm">
                {{ selectedProfileId ? 'No rooms yet for this profile' : 'Select a hotel profile to view rooms' }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Add/Edit Modal -->
      <Modal :show="showModal" :title="editingRoom ? 'Edit Room' : 'Add Room'" @close="closeModal">
        <template #icon>
          <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" />
          </svg>
        </template>
        <form @submit.prevent="submitRoom" class="space-y-5">
          <div>
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
              <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" />
              </svg>
              Room Name
            </label>
            <input v-model="form.name" @blur="v$.name.$touch()" type="text"
              :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                v$.name.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
              placeholder="e.g. Fidella">
            <p v-if="v$.name.$error" class="text-xs text-red-500 mt-1.5">{{ v$.name.$errors[0].$message }}</p>
            <p v-else-if="form.errors.name" class="text-xs text-red-500 mt-1.5">{{ form.errors.name }}</p>
          </div>
          <button type="submit" :disabled="form.processing"
            class="w-full py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl
                   transition shadow-sm shadow-primary-600/20 disabled:opacity-50 inline-flex items-center justify-center gap-2">
            <svg v-if="form.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ form.processing ? 'Saving...' : (editingRoom ? 'Update Room' : 'Add Room') }}
          </button>
        </form>
      </Modal>

      <!-- Delete Confirmation Modal -->
      <Modal :show="showDeleteModal" title="Delete Room" size="sm" @close="showDeleteModal = false">
        <template #icon>
          <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </template>
        <p class="text-sm text-slate-600">
          Are you sure you want to delete <span class="font-semibold">{{ deletingRoom?.name }}</span>?
        </p>
        <div class="flex items-center gap-3 mt-5">
          <button @click="showDeleteModal = false"
            class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition inline-flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Cancel
          </button>
          <button @click="deleteRoom" :disabled="deleteForm.processing"
            class="flex-1 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition disabled:opacity-50 inline-flex items-center justify-center gap-1.5">
            <svg v-if="deleteForm.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            {{ deleteForm.processing ? 'Deleting...' : 'Delete' }}
          </button>
        </div>
      </Modal>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { useVuelidate } from '@vuelidate/core';
import { useValidators } from '../../../Utils/validators';

const { required } = useValidators();
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Modal from '../../../Components/UI/Modal.vue';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

const props = defineProps({
  rooms: { type: Array, default: () => [] },
  profiles: { type: Array, default: () => [] },
  selectedProfileId: { type: Number, default: null },
});

const showModal = ref(false);
const showDeleteModal = ref(false);
const editingRoom = ref(null);
const deletingRoom = ref(null);

const profileOptions = computed(() =>
  props.profiles.map(p => ({ label: p.name, value: p.id }))
);

function switchProfile(profileId) {
  router.get('/admin/rooms', { profile_id: profileId }, {
    preserveState: true,
    preserveScroll: true,
  });
}

const form = useForm({ name: '', hotel_profile_id: null });
const deleteForm = useForm({});

const rules = computed(() => ({
  name: { required },
}));

const v$ = useVuelidate(rules, form);

function openCreate() {
  editingRoom.value = null;
  form.reset();
  form.hotel_profile_id = props.selectedProfileId;
  v$.value.$reset();
  showModal.value = true;
}

function openEdit(room) {
  editingRoom.value = room;
  form.name = room.name;
  form.hotel_profile_id = room.hotel_profile_id;
  v$.value.$reset();
  showModal.value = true;
}

function closeModal() {
  showModal.value = false;
  editingRoom.value = null;
  form.reset();
  v$.value.$reset();
}

async function submitRoom() {
  const valid = await v$.value.$validate();
  if (!valid) return;

  if (editingRoom.value) {
    form.put(`/admin/rooms/${editingRoom.value.id}`, {
      onSuccess: () => closeModal(),
    });
  } else {
    form.post('/admin/rooms', {
      onSuccess: () => closeModal(),
    });
  }
}

function confirmDelete(room) {
  deletingRoom.value = room;
  showDeleteModal.value = true;
}

function deleteRoom() {
  deleteForm.delete(`/admin/rooms/${deletingRoom.value.id}`, {
    onSuccess: () => {
      showDeleteModal.value = false;
      deletingRoom.value = null;
    },
  });
}
</script>
