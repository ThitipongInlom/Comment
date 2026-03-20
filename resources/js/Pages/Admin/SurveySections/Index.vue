<template>
  <Head title="Sections & Questions" />
  <AdminLayout>
    <div class="space-y-6">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xl font-bold text-slate-900">Sections & Questions</h2>
          <p class="text-sm text-slate-500 mt-0.5">Manage survey sections and questions per hotel profile</p>
        </div>
        <button @click="openCreateSection" :disabled="!selectedProfileId"
          :class="['inline-flex items-center gap-2 px-4 py-2.5 text-white text-sm font-semibold rounded-xl transition shadow-sm',
            selectedProfileId
              ? 'bg-primary-600 hover:bg-primary-700 shadow-primary-600/20'
              : 'bg-slate-300 cursor-not-allowed']">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Add Section
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

      <!-- Sections with Drag & Drop -->
      <draggable
        v-if="localSections.length > 0"
        v-model="localSections"
        item-key="id"
        handle=".section-handle"
        ghost-class="opacity-30"
        @end="onSectionReorder"
        class="space-y-3"
      >
        <template #item="{ element: section, index }">
          <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <!-- Section Header -->
            <div class="flex items-center gap-3 px-5 py-4">
              <!-- Drag Handle -->
              <div class="section-handle cursor-grab active:cursor-grabbing text-slate-300 hover:text-slate-500 transition shrink-0">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M8 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm8-15a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" />
                </svg>
              </div>

              <!-- Expand toggle -->
              <button @click="toggleSection(section.id)" class="shrink-0">
                <svg :class="['w-4 h-4 text-slate-400 transition-transform', expandedSectionId === section.id ? 'rotate-90' : '']"
                  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </button>

              <span class="text-sm font-bold text-primary-600 w-6 shrink-0">{{ index + 1 }}.</span>
              <div class="flex-1 min-w-0 cursor-pointer" @click="toggleSection(section.id)">
                <span class="text-sm font-semibold text-slate-900">{{ getTranslation(section, 'en') }}</span>
                <span class="text-slate-300 mx-2">/</span>
                <span class="text-sm text-slate-500">{{ getTranslation(section, 'th') }}</span>
              </div>
              <span class="inline-flex items-center px-2.5 py-1 bg-primary-50 text-primary-700 rounded-lg text-xs font-semibold shrink-0">
                {{ section.questions_count }} questions
              </span>
              <div class="inline-flex items-center gap-1.5 shrink-0">
                <button @click="openEditSection(section)"
                  class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary-50 text-primary-600 border border-primary-200 hover:bg-primary-100 rounded-lg text-xs font-semibold transition">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                  Edit
                </button>
                <button @click="confirmDeleteSection(section)"
                  :disabled="hasAnswers(section)"
                  :class="['inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold transition border',
                    hasAnswers(section)
                      ? 'bg-slate-50 text-slate-300 border-slate-100 cursor-not-allowed'
                      : 'bg-red-50 text-red-600 border-red-200 hover:bg-red-100']">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                  Delete
                </button>
              </div>
            </div>

            <!-- Expanded Questions -->
            <div v-if="expandedSectionId === section.id" class="border-t border-slate-100">
              <div class="p-4 space-y-2">
                <draggable
                  v-model="section.questions"
                  item-key="id"
                  handle=".question-handle"
                  ghost-class="opacity-30"
                  @end="() => onQuestionReorder(section)"
                  class="space-y-2"
                >
                  <template #item="{ element: question, index: qIndex }">
                    <div class="flex items-start gap-3 px-4 py-3 bg-slate-50 rounded-xl">
                      <!-- Drag Handle -->
                      <div class="question-handle cursor-grab active:cursor-grabbing text-slate-300 hover:text-slate-500 transition shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M8 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm8-15a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" />
                        </svg>
                      </div>
                      <span class="text-xs font-bold text-slate-400 mt-0.5 w-5 shrink-0">{{ qIndex + 1 }}.</span>
                      <div class="flex-1 min-w-0">
                        <p class="text-sm text-slate-800 leading-relaxed">{{ getQuestionText(question, 'en') }}</p>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">{{ getQuestionText(question, 'th') }}</p>
                      </div>
                      <div class="inline-flex items-center gap-1.5 shrink-0">
                        <button @click="openEditQuestion(section, question)"
                          class="inline-flex items-center gap-1 px-2.5 py-1 bg-white text-primary-600 border border-primary-200 hover:bg-primary-50 rounded-lg text-xs font-semibold transition">
                          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                          </svg>
                          Edit
                        </button>
                        <button @click="confirmDeleteQuestion(question)"
                          class="inline-flex items-center gap-1 px-2.5 py-1 bg-white text-red-600 border border-red-200 hover:bg-red-50 rounded-lg text-xs font-semibold transition">
                          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                          </svg>
                          Delete
                        </button>
                      </div>
                    </div>
                  </template>
                </draggable>
                <div v-if="section.questions.length === 0" class="px-4 py-6 text-center text-slate-400 text-sm">
                  No questions in this section
                </div>
                <button @click="openCreateQuestion(section)"
                  class="w-full py-2.5 border-2 border-dashed border-slate-200 hover:border-primary-300 hover:bg-primary-50/50 text-slate-400 hover:text-primary-600 text-sm font-semibold rounded-xl transition inline-flex items-center justify-center gap-2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Add Question
                </button>
              </div>
            </div>
          </div>
        </template>
      </draggable>

      <div v-else class="bg-white rounded-2xl shadow-sm border border-slate-200 px-5 py-12 text-center text-slate-400 text-sm">
        {{ selectedProfileId ? 'No sections yet for this profile' : 'Select a hotel profile to view sections' }}
      </div>

      <!-- Add/Edit Section Modal -->
      <Modal :show="showSectionModal" :title="editingSection ? 'Edit Section' : 'Add Section'" @close="closeSectionModal">
        <template #icon>
          <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
        </template>
        <form @submit.prevent="submitSection" class="space-y-5">
          <div>
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
              <span class="inline-flex items-center justify-center w-4 h-4 bg-blue-100 text-blue-600 rounded text-[10px] font-bold">EN</span>
              Title (English)
            </label>
            <input v-model="sectionForm.title_en" @blur="sectionV$.title_en.$touch()" type="text"
              :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                sectionV$.title_en.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
              placeholder="e.g. The Sales Team">
            <p v-if="sectionV$.title_en.$error" class="text-xs text-red-500 mt-1.5">{{ sectionV$.title_en.$errors[0].$message }}</p>
            <p v-else-if="sectionForm.errors.title_en" class="text-xs text-red-500 mt-1.5">{{ sectionForm.errors.title_en }}</p>
          </div>
          <div>
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
              <span class="inline-flex items-center justify-center w-4 h-4 bg-emerald-100 text-emerald-600 rounded text-[10px] font-bold">TH</span>
              Title (Thai)
            </label>
            <input v-model="sectionForm.title_th" @blur="sectionV$.title_th.$touch()" type="text"
              :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                sectionV$.title_th.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
              placeholder="e.g. ทีมขาย">
            <p v-if="sectionV$.title_th.$error" class="text-xs text-red-500 mt-1.5">{{ sectionV$.title_th.$errors[0].$message }}</p>
            <p v-else-if="sectionForm.errors.title_th" class="text-xs text-red-500 mt-1.5">{{ sectionForm.errors.title_th }}</p>
          </div>
          <button type="submit" :disabled="sectionForm.processing"
            class="w-full py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl
                   transition shadow-sm shadow-primary-600/20 disabled:opacity-50 inline-flex items-center justify-center gap-2">
            <svg v-if="sectionForm.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ sectionForm.processing ? 'Saving...' : (editingSection ? 'Update Section' : 'Add Section') }}
          </button>
        </form>
      </Modal>

      <!-- Add/Edit Question Modal -->
      <Modal :show="showQuestionModal" :title="editingQuestion ? 'Edit Question' : 'Add Question'" @close="closeQuestionModal">
        <template #icon>
          <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </template>
        <form @submit.prevent="submitQuestion" class="space-y-5">
          <div>
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
              <span class="inline-flex items-center justify-center w-4 h-4 bg-blue-100 text-blue-600 rounded text-[10px] font-bold">EN</span>
              Question (English)
            </label>
            <textarea v-model="questionForm.text_en" @blur="questionV$.text_en.$touch()" rows="3"
              :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition resize-none',
                questionV$.text_en.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
              placeholder="e.g. Has the responsible sales team member been pro-actively supporting you?"></textarea>
            <p v-if="questionV$.text_en.$error" class="text-xs text-red-500 mt-1.5">{{ questionV$.text_en.$errors[0].$message }}</p>
            <p v-else-if="questionForm.errors.text_en" class="text-xs text-red-500 mt-1.5">{{ questionForm.errors.text_en }}</p>
          </div>
          <div>
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
              <span class="inline-flex items-center justify-center w-4 h-4 bg-emerald-100 text-emerald-600 rounded text-[10px] font-bold">TH</span>
              Question (Thai)
            </label>
            <textarea v-model="questionForm.text_th" @blur="questionV$.text_th.$touch()" rows="3"
              :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition resize-none',
                questionV$.text_th.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
              placeholder="e.g. พนักงานฝ่ายขายที่รับผิดชอบได้ให้การบริการอย่างกระตือรือร้นหรือไม่?"></textarea>
            <p v-if="questionV$.text_th.$error" class="text-xs text-red-500 mt-1.5">{{ questionV$.text_th.$errors[0].$message }}</p>
            <p v-else-if="questionForm.errors.text_th" class="text-xs text-red-500 mt-1.5">{{ questionForm.errors.text_th }}</p>
          </div>
          <button type="submit" :disabled="questionForm.processing"
            class="w-full py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl
                   transition shadow-sm shadow-primary-600/20 disabled:opacity-50 inline-flex items-center justify-center gap-2">
            <svg v-if="questionForm.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ questionForm.processing ? 'Saving...' : (editingQuestion ? 'Update Question' : 'Add Question') }}
          </button>
        </form>
      </Modal>

      <!-- Delete Section Confirmation -->
      <Modal :show="showDeleteSectionModal" title="Delete Section" size="sm" @close="showDeleteSectionModal = false">
        <template #icon>
          <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </template>
        <p class="text-sm text-slate-600">
          Are you sure you want to delete section <span class="font-semibold">{{ getTranslation(deletingSection, 'en') }}</span>?
          This will also delete all questions in this section.
        </p>
        <div class="flex items-center gap-3 mt-5">
          <button @click="showDeleteSectionModal = false"
            class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition inline-flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Cancel
          </button>
          <button @click="deleteSection" :disabled="deleteForm.processing"
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

      <!-- Delete Question Confirmation -->
      <Modal :show="showDeleteQuestionModal" title="Delete Question" size="sm" @close="showDeleteQuestionModal = false">
        <template #icon>
          <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </template>
        <p class="text-sm text-slate-600">Are you sure you want to delete this question?</p>
        <div class="flex items-center gap-3 mt-5">
          <button @click="showDeleteQuestionModal = false"
            class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition inline-flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Cancel
          </button>
          <button @click="deleteQuestion" :disabled="deleteForm.processing"
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

    <!-- Toast Notification -->
    <Teleport to="body">
      <Transition
        enter-active-class="transition duration-300 ease-out"
        enter-from-class="opacity-0 translate-x-8"
        enter-to-class="opacity-100 translate-x-0"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="opacity-100 translate-x-0"
        leave-to-class="opacity-0 translate-x-8"
      >
        <div v-if="toast.show" class="fixed top-6 right-6 z-50">
          <div :class="['flex items-center gap-2.5 px-4 py-3 rounded-xl shadow-lg border text-sm font-medium',
            toast.type === 'success'
              ? 'bg-emerald-50 border-emerald-200 text-emerald-700'
              : 'bg-red-50 border-red-200 text-red-700']">
            <svg v-if="toast.type === 'success'" class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <svg v-else class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            {{ toast.message }}
          </div>
        </div>
      </Transition>
    </Teleport>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { useVuelidate } from '@vuelidate/core';
import { useValidators } from '../../../Utils/validators';

const { required } = useValidators();
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Modal from '../../../Components/UI/Modal.vue';
import vSelect from 'vue-select';
import draggable from 'vuedraggable';
import 'vue-select/dist/vue-select.css';

const props = defineProps({
  sections: { type: Array, default: () => [] },
  profiles: { type: Array, default: () => [] },
  selectedProfileId: { type: Number, default: null },
});

// --- Local copy for drag & drop ---
const localSections = ref([]);
watch(() => props.sections, (val) => {
  localSections.value = JSON.parse(JSON.stringify(val));
}, { immediate: true });

// --- State ---
const expandedSectionId = ref(null);
const showSectionModal = ref(false);
const showQuestionModal = ref(false);
const showDeleteSectionModal = ref(false);
const showDeleteQuestionModal = ref(false);
const editingSection = ref(null);
const editingQuestion = ref(null);
const deletingSection = ref(null);
const deletingQuestion = ref(null);
const activeSection = ref(null);

// --- Profile ---
const profileOptions = computed(() =>
  props.profiles.map(p => ({ label: p.name, value: p.id }))
);

function switchProfile(profileId) {
  router.get('/admin/survey-sections', { profile_id: profileId }, {
    preserveState: true,
    preserveScroll: true,
  });
}

// --- Helpers ---
function getTranslation(section, locale) {
  if (!section) return '';
  return section.translations?.find(t => t.locale === locale)?.title || '';
}

function getQuestionText(question, locale) {
  return question.translations?.find(t => t.locale === locale)?.text || '';
}

function hasAnswers(section) {
  return section.questions?.some(q => q.answers_count > 0);
}

function toggleSection(sectionId) {
  expandedSectionId.value = expandedSectionId.value === sectionId ? null : sectionId;
}

// --- Toast ---
const toast = ref({ show: false, message: '', type: 'success' });
let toastTimer = null;

function showToast(message, type = 'success') {
  if (toastTimer) clearTimeout(toastTimer);
  toast.value = { show: true, message, type };
  toastTimer = setTimeout(() => { toast.value.show = false; }, 3000);
}

// --- Drag & Drop Reorder ---
function onSectionReorder() {
  const items = localSections.value.map((s, i) => ({ id: s.id, sort_order: i + 1 }));
  router.post('/admin/survey-sections/reorder', { items }, {
    preserveScroll: true,
    onSuccess: () => showToast('Order updated'),
    onError: () => showToast('Failed to update order', 'error'),
  });
}

function onQuestionReorder(section) {
  const items = section.questions.map((q, i) => ({ id: q.id, sort_order: i + 1 }));
  router.post('/admin/survey-questions/reorder', { items }, {
    preserveScroll: true,
    onSuccess: () => showToast('Order updated'),
    onError: () => showToast('Failed to update order', 'error'),
  });
}

// --- Section Form ---
const sectionForm = useForm({
  hotel_profile_id: null,
  title_en: '',
  title_th: '',
});

const sectionRules = computed(() => ({
  title_en: { required },
  title_th: { required },
}));

const sectionV$ = useVuelidate(sectionRules, sectionForm);

function openCreateSection() {
  editingSection.value = null;
  sectionForm.reset();
  sectionForm.hotel_profile_id = props.selectedProfileId;
  sectionV$.value.$reset();
  showSectionModal.value = true;
}

function openEditSection(section) {
  editingSection.value = section;
  sectionForm.hotel_profile_id = section.hotel_profile_id;
  sectionForm.title_en = getTranslation(section, 'en');
  sectionForm.title_th = getTranslation(section, 'th');
  sectionV$.value.$reset();
  showSectionModal.value = true;
}

function closeSectionModal() {
  showSectionModal.value = false;
  editingSection.value = null;
  sectionForm.reset();
  sectionV$.value.$reset();
}

async function submitSection() {
  const valid = await sectionV$.value.$validate();
  if (!valid) return;

  if (editingSection.value) {
    sectionForm.put(`/admin/survey-sections/${editingSection.value.id}`, {
      onSuccess: () => closeSectionModal(),
    });
  } else {
    sectionForm.post('/admin/survey-sections', {
      onSuccess: () => closeSectionModal(),
    });
  }
}

function confirmDeleteSection(section) {
  deletingSection.value = section;
  showDeleteSectionModal.value = true;
}

// --- Question Form ---
const questionForm = useForm({
  section_id: null,
  text_en: '',
  text_th: '',
});

const questionRules = computed(() => ({
  text_en: { required },
  text_th: { required },
}));

const questionV$ = useVuelidate(questionRules, questionForm);

function openCreateQuestion(section) {
  activeSection.value = section;
  editingQuestion.value = null;
  questionForm.reset();
  questionForm.section_id = section.id;
  questionV$.value.$reset();
  showQuestionModal.value = true;
}

function openEditQuestion(section, question) {
  activeSection.value = section;
  editingQuestion.value = question;
  questionForm.section_id = section.id;
  questionForm.text_en = getQuestionText(question, 'en');
  questionForm.text_th = getQuestionText(question, 'th');
  questionV$.value.$reset();
  showQuestionModal.value = true;
}

function closeQuestionModal() {
  showQuestionModal.value = false;
  editingQuestion.value = null;
  activeSection.value = null;
  questionForm.reset();
  questionV$.value.$reset();
}

async function submitQuestion() {
  const valid = await questionV$.value.$validate();
  if (!valid) return;

  if (editingQuestion.value) {
    questionForm.put(`/admin/survey-questions/${editingQuestion.value.id}`, {
      onSuccess: () => closeQuestionModal(),
    });
  } else {
    questionForm.post('/admin/survey-questions', {
      onSuccess: () => closeQuestionModal(),
    });
  }
}

function confirmDeleteQuestion(question) {
  deletingQuestion.value = question;
  showDeleteQuestionModal.value = true;
}

// --- Delete ---
const deleteForm = useForm({});

function deleteSection() {
  deleteForm.delete(`/admin/survey-sections/${deletingSection.value.id}`, {
    onSuccess: () => {
      showDeleteSectionModal.value = false;
      deletingSection.value = null;
    },
  });
}

function deleteQuestion() {
  deleteForm.delete(`/admin/survey-questions/${deletingQuestion.value.id}`, {
    onSuccess: () => {
      showDeleteQuestionModal.value = false;
      deletingQuestion.value = null;
    },
  });
}
</script>
