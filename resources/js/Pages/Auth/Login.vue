<template>
  <Head title="Login" />
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-slate-50 to-slate-100 p-4">
    <div class="w-full max-w-sm">
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-14 h-14 bg-primary-600 rounded-2xl mb-4">
          <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
          </svg>
        </div>
        <h1 class="text-2xl font-bold text-slate-900">Welcome back</h1>
        <p class="text-sm text-slate-500 mt-1">Sign in to Comment Admin</p>
      </div>

      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <form @submit.prevent="submit" class="space-y-4">
          <div>
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
              <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Username
            </label>
            <input v-model="form.username" @blur="v$.username.$touch()" type="text" autofocus
              :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                v$.username.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
              placeholder="Enter your username">
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
            <input v-model="form.password" @blur="v$.password.$touch()" type="password"
              :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                v$.password.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
              placeholder="Enter your password">
            <p v-if="v$.password.$error" class="text-xs text-red-500 mt-1.5">{{ v$.password.$errors[0].$message }}</p>
          </div>

          <label class="flex items-center gap-2.5 cursor-pointer group">
            <button type="button" @click="form.remember = !form.remember"
              :class="[
                'w-5 h-5 rounded-lg border-2 flex items-center justify-center transition-all duration-200',
                form.remember
                  ? 'bg-primary-600 border-primary-600 shadow-sm shadow-primary-600/30'
                  : 'border-slate-300 group-hover:border-primary-400'
              ]">
              <svg v-if="form.remember" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
              </svg>
            </button>
            <span class="text-sm text-slate-600 select-none">Remember me</span>
          </label>

          <button type="submit" :disabled="form.processing"
            class="w-full py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl
                   transition shadow-sm shadow-primary-600/20 disabled:opacity-50">
            {{ form.processing ? 'Signing in...' : 'Sign In' }}
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { useVuelidate } from '@vuelidate/core';
import { useValidators } from '../../Utils/validators';

const { required, minLength } = useValidators();
import { computed } from 'vue';

const form = useForm({
  username: '',
  password: '',
  remember: false,
});

const rules = computed(() => ({
  username: { required },
  password: { required, minLength: minLength(4) },
}));

const v$ = useVuelidate(rules, form);

async function submit() {
  const valid = await v$.value.$validate();
  if (!valid) return;

  form.post('/admin/login', {
    onFinish: () => form.reset('password'),
  });
}
</script>
