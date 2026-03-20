<template>
  <Head title="Users" />
  <AdminLayout>
    <div class="space-y-6">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xl font-bold text-slate-900">Users</h2>
          <p class="text-sm text-slate-500 mt-0.5">Manage user accounts</p>
        </div>
        <button @click="showModal = true"
          class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl transition shadow-sm shadow-primary-600/20">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Add User
        </button>
      </div>

      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-slate-100">
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Username</th>
              <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
              <th class="px-5 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Role</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-50">
            <tr v-for="(user, i) in users" :key="user.id" class="hover:bg-slate-50/50 transition">
              <td class="px-5 py-3.5 text-slate-400">{{ i + 1 }}</td>
              <td class="px-5 py-3.5 font-medium text-slate-900">{{ user.name }}</td>
              <td class="px-5 py-3.5 text-slate-600">{{ user.username }}</td>
              <td class="px-5 py-3.5 text-slate-600">{{ user.email }}</td>
              <td class="px-5 py-3.5 text-center">
                <span :class="['px-2.5 py-1 rounded-lg text-xs font-semibold',
                  user.role === 'admin' ? 'bg-violet-50 text-violet-700' : 'bg-slate-100 text-slate-600']">
                  {{ user.role }}
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Add User Modal -->
      <Modal :show="showModal" title="Add User" @close="closeModal">
        <template #icon>
          <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
        </template>
        <form @submit.prevent="submitUser" class="space-y-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Name
              </label>
              <input v-model="form.name" @blur="v$.name.$touch()" type="text" placeholder="e.g. John Doe"
                :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                  v$.name.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']">
              <p v-if="v$.name.$error" class="text-xs text-red-500 mt-1.5">{{ v$.name.$errors[0].$message }}</p>
              <p v-else-if="form.errors.name" class="text-xs text-red-500 mt-1.5">{{ form.errors.name }}</p>
            </div>
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Email
              </label>
              <input v-model="form.email" @blur="v$.email.$touch()" type="email" placeholder="e.g. john@example.com"
                :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                  v$.email.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']">
              <p v-if="v$.email.$error" class="text-xs text-red-500 mt-1.5">{{ v$.email.$errors[0].$message }}</p>
              <p v-else-if="form.errors.email" class="text-xs text-red-500 mt-1.5">{{ form.errors.email }}</p>
            </div>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Username
              </label>
              <input v-model="form.username" @blur="v$.username.$touch()" type="text" placeholder="e.g. johndoe"
                :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                  v$.username.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']">
              <p v-if="v$.username.$error" class="text-xs text-red-500 mt-1.5">{{ v$.username.$errors[0].$message }}</p>
              <p v-else-if="form.errors.username" class="text-xs text-red-500 mt-1.5">{{ form.errors.username }}</p>
            </div>
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Password
              </label>
              <input v-model="form.password" @blur="v$.password.$touch()" type="password" placeholder="Minimum 6 characters"
                :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                  v$.password.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']">
              <p v-if="v$.password.$error" class="text-xs text-red-500 mt-1.5">{{ v$.password.$errors[0].$message }}</p>
              <p v-else-if="form.errors.password" class="text-xs text-red-500 mt-1.5">{{ form.errors.password }}</p>
            </div>
          </div>
          <div>
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
              <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
              Role
            </label>
            <vSelect
              v-model="form.role"
              :options="roleOptions"
              :reduce="opt => opt.value"
              :clearable="false"
              append-to-body
              placeholder="Select role"
            />
          </div>
          <div class="pt-2">
            <button type="submit" :disabled="form.processing"
              class="w-full py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl
                     transition shadow-sm shadow-primary-600/20 disabled:opacity-50 inline-flex items-center justify-center gap-2">
              <svg v-if="form.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
              </svg>
              <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
              </svg>
              {{ form.processing ? 'Adding...' : 'Add User' }}
            </button>
          </div>
        </form>
      </Modal>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useVuelidate } from '@vuelidate/core';
import { useValidators } from '../../../Utils/validators';

const { required, email, minLength } = useValidators();
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Modal from '../../../Components/UI/Modal.vue';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

defineProps({
  users: { type: Array, default: () => [] },
});

const showModal = ref(false);
const roleOptions = [
  { label: 'Staff', value: 'staff' },
  { label: 'Admin', value: 'admin' },
];

const form = useForm({
  name: '',
  email: '',
  username: '',
  password: '',
  role: 'staff',
});

const rules = computed(() => ({
  name: { required },
  email: { required, email },
  username: { required, minLength: minLength(3) },
  password: { required, minLength: minLength(6) },
  role: { required },
}));

const v$ = useVuelidate(rules, form);

async function submitUser() {
  const valid = await v$.value.$validate();
  if (!valid) return;

  form.post('/admin/users', {
    onSuccess: () => {
      showModal.value = false;
      form.reset();
      v$.value.$reset();
    },
  });
}

function closeModal() {
  showModal.value = false;
  form.reset();
  v$.value.$reset();
}
</script>
