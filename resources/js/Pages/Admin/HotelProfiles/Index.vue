<template>
  <Head title="Hotel Profiles" />
  <AdminLayout>
    <div class="space-y-6">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xl font-bold text-slate-900">Hotel Profiles</h2>
          <p class="text-sm text-slate-500 mt-0.5">Manage hotel profiles for survey pages</p>
        </div>
        <button @click="openCreate"
          class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl transition shadow-sm shadow-primary-600/20">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Add Profile
        </button>
      </div>

      <!-- Profile Cards -->
      <div class="grid grid-cols-1 gap-4">
        <div v-for="profile in profiles" :key="profile.id"
          class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
          <div class="flex items-stretch">
            <!-- Background Preview -->
            <div class="w-48 shrink-0 relative bg-slate-100 hidden sm:block">
              <img v-if="profile.background_url" :src="profile.background_url" class="w-full h-full object-cover absolute inset-0">
              <div v-else class="w-full h-full flex items-center justify-center">
                <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <!-- Logo overlay -->
              <div v-if="profile.logo_url" class="absolute bottom-3 left-3">
                <div class="w-12 h-12 rounded-xl bg-white shadow-md border border-white/50 overflow-hidden">
                  <img :src="profile.logo_url" :alt="profile.name" class="w-full h-full object-cover">
                </div>
              </div>
            </div>

            <!-- Content -->
            <div class="flex-1 p-5 flex flex-col justify-between">
              <div>
                <div class="flex items-start justify-between gap-3">
                  <div class="flex items-center gap-3">
                    <!-- Mobile logo -->
                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center overflow-hidden shrink-0 sm:hidden">
                      <img v-if="profile.logo_url" :src="profile.logo_url" :alt="profile.name" class="w-full h-full object-cover">
                      <svg v-else class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                      </svg>
                    </div>
                    <div>
                      <h3 class="font-semibold text-slate-900">{{ profile.name }}</h3>
                      <p class="text-sm text-slate-500 mt-0.5">{{ profile.title_web_en }}</p>
                    </div>
                  </div>
                  <span :class="['px-2.5 py-1 rounded-lg text-xs font-semibold shrink-0',
                    profile.is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500']">
                    {{ profile.is_active ? 'Active' : 'Inactive' }}
                  </span>
                </div>
                <div class="mt-3 flex flex-wrap gap-x-5 gap-y-1 text-xs text-slate-400">
                  <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ profile.head_form_en || 'No form header' }}
                  </span>
                  <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ profile.background_url ? 'Has background' : 'No background' }}
                  </span>
                </div>
              </div>
              <div class="flex items-center gap-1.5 mt-4 pt-4 border-t border-slate-100">
                <button @click="openEdit(profile)"
                  class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary-50 text-primary-600 border border-primary-200 hover:bg-primary-100 rounded-lg text-xs font-semibold transition">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                  Edit
                </button>
                <button v-if="!profile.is_active" @click="activateProfile(profile)"
                  class="inline-flex items-center gap-1 px-3 py-1.5 bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100 rounded-lg text-xs font-semibold transition">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  Activate
                </button>
                <button @click="confirmDelete(profile)"
                  :disabled="profile.is_active"
                  :class="['inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold transition border',
                    profile.is_active
                      ? 'bg-slate-50 text-slate-300 border-slate-100 cursor-not-allowed'
                      : 'bg-red-50 text-red-600 border-red-200 hover:bg-red-100']">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty state -->
        <div v-if="profiles.length === 0"
          class="bg-white rounded-2xl shadow-sm border border-slate-200 py-16 text-center">
          <svg class="w-12 h-12 text-slate-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
          <p class="text-slate-400 text-sm">No profiles yet</p>
          <button @click="openCreate"
            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-primary-50 text-primary-600 border border-primary-200 hover:bg-primary-100 rounded-xl text-sm font-semibold transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create your first profile
          </button>
        </div>
      </div>

      <!-- Create/Edit Modal -->
      <Modal :show="showModal" :title="editingProfile ? 'Edit Profile' : 'Add Profile'" size="lg" @close="closeModal">
        <template #icon>
          <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
        </template>
        <form @submit.prevent="submitProfile" class="space-y-6">
          <!-- Profile Name -->
          <div>
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
              <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
              </svg>
              Profile Name <span class="text-red-400">*</span>
            </label>
            <input v-model="form.name" @blur="v$.name.$touch()" type="text"
              :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                v$.name.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
              placeholder="e.g. Main Profile">
            <p v-if="v$.name.$error" class="text-xs text-red-500 mt-1.5">{{ v$.name.$errors[0].$message }}</p>
          </div>

          <!-- Hotel Name Section -->
          <div class="bg-slate-50 rounded-xl p-4 space-y-4 border border-slate-100">
            <div class="flex items-center gap-2">
              <div class="w-7 h-7 bg-primary-50 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
              </div>
              <h4 class="text-sm font-semibold text-slate-700">Hotel Name <span class="text-red-400">*</span></h4>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">
                  <span class="inline-flex items-center gap-1.5">
                    English
                    <span class="px-1.5 py-0.5 bg-white text-slate-500 rounded text-[10px] font-medium uppercase border border-slate-200">EN</span>
                  </span>
                </label>
                <input v-model="form.title_web_en" @blur="v$.title_web_en.$touch()" type="text"
                  :class="['w-full px-3.5 py-2.5 bg-white border rounded-xl text-sm focus:ring-2 transition',
                    v$.title_web_en.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
                  placeholder="e.g. The Zign Hotel Pattaya">
                <p v-if="v$.title_web_en.$error" class="text-xs text-red-500 mt-1.5">{{ v$.title_web_en.$errors[0].$message }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">
                  <span class="inline-flex items-center gap-1.5">
                    ภาษาไทย
                    <span class="px-1.5 py-0.5 bg-white text-slate-500 rounded text-[10px] font-medium uppercase border border-slate-200">TH</span>
                  </span>
                </label>
                <input v-model="form.title_web_th" @blur="v$.title_web_th.$touch()" type="text"
                  :class="['w-full px-3.5 py-2.5 bg-white border rounded-xl text-sm focus:ring-2 transition',
                    v$.title_web_th.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
                  placeholder="เช่น โรงแรมเดอะ ซายน์ พัทยา">
                <p v-if="v$.title_web_th.$error" class="text-xs text-red-500 mt-1.5">{{ v$.title_web_th.$errors[0].$message }}</p>
              </div>
            </div>
          </div>

          <!-- Survey Form Header Section -->
          <div class="bg-slate-50 rounded-xl p-4 space-y-4 border border-slate-100">
            <div class="flex items-center gap-2">
              <div class="w-7 h-7 bg-emerald-50 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
              </div>
              <h4 class="text-sm font-semibold text-slate-700">Survey Form Header <span class="text-red-400">*</span></h4>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">
                  <span class="inline-flex items-center gap-1.5">
                    English
                    <span class="px-1.5 py-0.5 bg-white text-slate-500 rounded text-[10px] font-medium uppercase border border-slate-200">EN</span>
                  </span>
                </label>
                <input v-model="form.head_form_en" @blur="v$.head_form_en.$touch()" type="text"
                  :class="['w-full px-3.5 py-2.5 bg-white border rounded-xl text-sm focus:ring-2 transition',
                    v$.head_form_en.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
                  placeholder="e.g. Guest Satisfaction Questionnaire">
                <p v-if="v$.head_form_en.$error" class="text-xs text-red-500 mt-1.5">{{ v$.head_form_en.$errors[0].$message }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">
                  <span class="inline-flex items-center gap-1.5">
                    ภาษาไทย
                    <span class="px-1.5 py-0.5 bg-white text-slate-500 rounded text-[10px] font-medium uppercase border border-slate-200">TH</span>
                  </span>
                </label>
                <input v-model="form.head_form_th" @blur="v$.head_form_th.$touch()" type="text"
                  :class="['w-full px-3.5 py-2.5 bg-white border rounded-xl text-sm focus:ring-2 transition',
                    v$.head_form_th.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
                  placeholder="เช่น แบบสอบถามความพึงพอใจ">
                <p v-if="v$.head_form_th.$error" class="text-xs text-red-500 mt-1.5">{{ v$.head_form_th.$errors[0].$message }}</p>
              </div>
            </div>
          </div>

          <!-- Thank You Message Section -->
          <div class="bg-slate-50 rounded-xl p-4 space-y-4 border border-slate-100">
            <div class="flex items-center gap-2">
              <div class="w-7 h-7 bg-amber-50 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
              </div>
              <h4 class="text-sm font-semibold text-slate-700">Thank You Message</h4>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">
                  <span class="inline-flex items-center gap-1.5">
                    English
                    <span class="px-1.5 py-0.5 bg-white text-slate-500 rounded text-[10px] font-medium uppercase border border-slate-200">EN</span>
                  </span>
                </label>
                <textarea v-model="form.foot_form_en" rows="5"
                  class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm
                         focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition resize-none"
                  placeholder="e.g. Thank you for your valuable feedback"></textarea>
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">
                  <span class="inline-flex items-center gap-1.5">
                    ภาษาไทย
                    <span class="px-1.5 py-0.5 bg-white text-slate-500 rounded text-[10px] font-medium uppercase border border-slate-200">TH</span>
                  </span>
                </label>
                <textarea v-model="form.foot_form_th" rows="5"
                  class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm
                         focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition resize-none"
                  placeholder="เช่น ขอขอบพระคุณสำหรับความคิดเห็นของท่าน"></textarea>
              </div>
            </div>
          </div>

          <!-- Images Section -->
          <div class="bg-slate-50 rounded-xl p-4 space-y-5 border border-slate-100">
            <div class="flex items-center gap-2">
              <div class="w-7 h-7 bg-violet-50 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <h4 class="text-sm font-semibold text-slate-700">Images</h4>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <!-- Logo Upload -->
              <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Logo</label>
                <div class="relative group">
                  <label class="block cursor-pointer">
                    <div :class="['w-full aspect-square rounded-xl border-2 border-dashed flex flex-col items-center justify-center transition overflow-hidden',
                      logoPreview ? 'border-primary-200 bg-white' : 'border-slate-200 bg-white hover:border-primary-300 hover:bg-primary-50/30']">
                      <img v-if="logoPreview" :src="logoPreview" class="w-full h-full object-contain p-2">
                      <template v-else>
                        <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <p class="text-xs text-slate-400 font-medium">Click to upload logo</p>
                        <p class="text-[10px] text-slate-300 mt-0.5">Max 2MB</p>
                      </template>
                    </div>
                    <input type="file" accept="image/*" class="hidden" @change="onLogoChange">
                  </label>
                  <button v-if="logoPreview" type="button" @click="removeLogo"
                    class="absolute top-2 right-2 w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-lg flex items-center justify-center transition shadow-sm opacity-0 group-hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
              </div>

              <!-- Background Upload -->
              <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Background</label>
                <div class="relative group">
                  <label class="block cursor-pointer">
                    <div :class="['w-full aspect-square rounded-xl border-2 border-dashed flex flex-col items-center justify-center transition overflow-hidden',
                      backgroundPreview ? 'border-primary-200 bg-white' : 'border-slate-200 bg-white hover:border-primary-300 hover:bg-primary-50/30']">
                      <img v-if="backgroundPreview" :src="backgroundPreview" class="w-full h-full object-cover">
                      <template v-else>
                        <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <p class="text-xs text-slate-400 font-medium">Click to upload background</p>
                        <p class="text-[10px] text-slate-300 mt-0.5">Max 5MB</p>
                      </template>
                    </div>
                    <input type="file" accept="image/*" class="hidden" @change="onBackgroundChange">
                  </label>
                  <button v-if="backgroundPreview" type="button" @click="removeBackground"
                    class="absolute top-2 right-2 w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-lg flex items-center justify-center transition shadow-sm opacity-0 group-hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

        </form>
        <template #footer>
          <button @click="submitProfile" :disabled="processing"
            class="w-full py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl
                   transition shadow-sm shadow-primary-600/20 disabled:opacity-50 inline-flex items-center justify-center gap-2">
            <svg v-if="processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ processing ? 'Saving...' : (editingProfile ? 'Update Profile' : 'Add Profile') }}
          </button>
        </template>
      </Modal>

      <!-- Delete Confirmation Modal -->
      <Modal :show="showDeleteModal" title="Delete Profile" size="sm" @close="showDeleteModal = false">
        <template #icon>
          <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </template>
        <p class="text-sm text-slate-600">
          Are you sure you want to delete <span class="font-semibold">{{ deletingProfile?.name }}</span>?
        </p>
        <div class="flex items-center gap-3 mt-5">
          <button @click="showDeleteModal = false"
            class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition inline-flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Cancel
          </button>
          <button @click="deleteProfile" :disabled="deleteProcessing"
            class="flex-1 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition disabled:opacity-50 inline-flex items-center justify-center gap-1.5">
            <svg v-if="deleteProcessing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            {{ deleteProcessing ? 'Deleting...' : 'Delete' }}
          </button>
        </div>
      </Modal>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import { useVuelidate } from '@vuelidate/core';
import { useValidators } from '../../../Utils/validators';

const { required } = useValidators();
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Modal from '../../../Components/UI/Modal.vue';

defineProps({
  profiles: { type: Array, default: () => [] },
});

const showModal = ref(false);
const showDeleteModal = ref(false);
const editingProfile = ref(null);
const deletingProfile = ref(null);
const processing = ref(false);
const deleteProcessing = ref(false);

// Form data
const form = ref({
  name: '',
  title_web_en: '',
  title_web_th: '',
  head_form_en: '',
  head_form_th: '',
  foot_form_en: '',
  foot_form_th: '',
});

// File refs
const logoFile = ref(null);
const backgroundFile = ref(null);
const logoPreview = ref(null);
const backgroundPreview = ref(null);
const removedLogo = ref(false);
const removedBackground = ref(false);

const rules = computed(() => ({
  name: { required },
  title_web_en: { required },
  title_web_th: { required },
  head_form_en: { required },
  head_form_th: { required },
}));

const v$ = useVuelidate(rules, form);

function resetForm() {
  form.value = {
    name: '',
    title_web_en: '',
    title_web_th: '',
    head_form_en: '',
    head_form_th: '',
    foot_form_en: '',
    foot_form_th: '',
  };
  logoFile.value = null;
  backgroundFile.value = null;
  logoPreview.value = null;
  backgroundPreview.value = null;
  removedLogo.value = false;
  removedBackground.value = false;
  v$.value.$reset();
}

function openCreate() {
  editingProfile.value = null;
  resetForm();
  showModal.value = true;
}

function openEdit(profile) {
  editingProfile.value = profile;
  form.value = {
    name: profile.name,
    title_web_en: profile.title_web_en,
    title_web_th: profile.title_web_th,
    head_form_en: profile.head_form_en,
    head_form_th: profile.head_form_th,
    foot_form_en: profile.foot_form_en || '',
    foot_form_th: profile.foot_form_th || '',
  };
  logoFile.value = null;
  backgroundFile.value = null;
  logoPreview.value = profile.logo_url;
  backgroundPreview.value = profile.background_url;
  removedLogo.value = false;
  removedBackground.value = false;
  v$.value.$reset();
  showModal.value = true;
}

function closeModal() {
  showModal.value = false;
  editingProfile.value = null;
  resetForm();
}

function onLogoChange(e) {
  const file = e.target.files[0];
  if (!file) return;
  logoFile.value = file;
  removedLogo.value = false;
  logoPreview.value = URL.createObjectURL(file);
}

function onBackgroundChange(e) {
  const file = e.target.files[0];
  if (!file) return;
  backgroundFile.value = file;
  removedBackground.value = false;
  backgroundPreview.value = URL.createObjectURL(file);
}

function removeLogo() {
  logoFile.value = null;
  logoPreview.value = null;
  removedLogo.value = true;
}

function removeBackground() {
  backgroundFile.value = null;
  backgroundPreview.value = null;
  removedBackground.value = true;
}

async function submitProfile() {
  const valid = await v$.value.$validate();
  if (!valid) return;

  const formData = new FormData();
  Object.entries(form.value).forEach(([key, val]) => {
    formData.append(key, val ?? '');
  });

  if (logoFile.value) {
    formData.append('logo', logoFile.value);
  }
  if (backgroundFile.value) {
    formData.append('background', backgroundFile.value);
  }

  if (editingProfile.value) {
    if (removedLogo.value) formData.append('remove_logo', '1');
    if (removedBackground.value) formData.append('remove_background', '1');

    processing.value = true;
    router.post(`/admin/hotel-profiles/${editingProfile.value.id}`, formData, {
      onSuccess: () => closeModal(),
      onFinish: () => { processing.value = false; },
    });
  } else {
    processing.value = true;
    router.post('/admin/hotel-profiles', formData, {
      onSuccess: () => closeModal(),
      onFinish: () => { processing.value = false; },
    });
  }
}

function activateProfile(profile) {
  router.post(`/admin/hotel-profiles/${profile.id}/activate`);
}

function confirmDelete(profile) {
  deletingProfile.value = profile;
  showDeleteModal.value = true;
}

function deleteProfile() {
  deleteProcessing.value = true;
  router.delete(`/admin/hotel-profiles/${deletingProfile.value.id}`, {
    onSuccess: () => {
      showDeleteModal.value = false;
      deletingProfile.value = null;
    },
    onFinish: () => { deleteProcessing.value = false; },
  });
}
</script>
