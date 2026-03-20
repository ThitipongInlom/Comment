<template>
  <Head :title="settings.head_form" />
  <GuestLayout :title="settings.title" :footer-text="settings.foot_form" :logo-url="settings.logo_url" :background-url="settings.background_url">
    <template #header-actions>
      <LanguageSwitcher :locale="locale" :slug="link.slug" />
    </template>

    <div class="mb-8 text-center">
      <h2 class="text-2xl font-bold text-slate-900">{{ settings.head_form }}</h2>
      <p class="text-sm text-slate-500 mt-1.5">{{ link.group_name }}</p>
    </div>

    <form @submit.prevent="submit" class="space-y-6">
      <!-- Survey Sections -->
      <SurveySection v-for="section in sections" :key="section.id"
        :title="sectionTitle(section)">
        <SurveyQuestion
          v-for="question in section.questions" :key="question.id"
          :number="question.sort_order"
          :text="questionText(question)"
          :answer="getAnswer(question.id)"
          :comment="getComment(question.id)"
          :locale="locale"
          @update:answer="setAnswer(question.id, $event)"
          @update:comment="setComment(question.id, $event)"
        />
      </SurveySection>

      <!-- Personal Info -->
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="bg-gradient-to-r from-primary-600 to-primary-500 px-5 py-3.5">
          <h3 class="text-white font-semibold text-sm">
            {{ locale === 'th' ? 'ข้อมูลส่วนตัว' : 'Personal Information' }}
          </h3>
        </div>
        <div class="px-5 py-5 space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                {{ locale === 'th' ? 'ชื่อ' : 'First Name' }} <span class="text-red-400">*</span>
              </label>
              <input v-model="form.first_name" @blur="v$.first_name.$touch()" type="text"
                :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                  v$.first_name.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
                :placeholder="locale === 'th' ? 'กรอกชื่อ' : 'Enter first name'">
              <p v-if="v$.first_name.$error" class="text-xs text-red-500 mt-1.5">{{ v$.first_name.$errors[0].$message }}</p>
            </div>
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                {{ locale === 'th' ? 'นามสกุล' : 'Last Name' }} <span class="text-red-400">*</span>
              </label>
              <input v-model="form.last_name" @blur="v$.last_name.$touch()" type="text"
                :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                  v$.last_name.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
                :placeholder="locale === 'th' ? 'กรอกนามสกุล' : 'Enter last name'">
              <p v-if="v$.last_name.$error" class="text-xs text-red-500 mt-1.5">{{ v$.last_name.$errors[0].$message }}</p>
            </div>
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                {{ locale === 'th' ? 'เบอร์โทร' : 'Telephone' }}
              </label>
              <input v-model="form.telephone" type="tel"
                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm
                       focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 focus:bg-white transition"
                :placeholder="locale === 'th' ? 'กรอกเบอร์โทร' : 'Enter telephone'">
            </div>
            <div>
              <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                {{ locale === 'th' ? 'อีเมล' : 'Email' }}
              </label>
              <input v-model="form.email" @blur="v$.email.$touch()" type="email"
                :class="['w-full px-3.5 py-2.5 bg-slate-50 border rounded-xl text-sm focus:ring-2 focus:bg-white transition',
                  v$.email.$error ? 'border-red-300 focus:ring-red-500/20 focus:border-red-500' : 'border-slate-200 focus:ring-primary-500/20 focus:border-primary-500']"
                :placeholder="locale === 'th' ? 'กรอกอีเมล' : 'Enter email'">
              <p v-if="v$.email.$error" class="text-xs text-red-500 mt-1.5">{{ v$.email.$errors[0].$message }}</p>
            </div>
          </div>

          <!-- Star Rating -->
          <div class="pt-4 border-t border-slate-100">
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-2">
              <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
              </svg>
              {{ locale === 'th' ? 'คะแนนรวม' : 'Overall Rating' }}
            </label>
            <StarRating v-model="form.overall_rating" />
          </div>
        </div>
      </div>

      <!-- Submit -->
      <div class="text-center">
        <button type="submit" :disabled="form.processing"
          class="px-10 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl
                 shadow-sm shadow-primary-600/20 transition disabled:opacity-50">
          {{ form.processing
            ? (locale === 'th' ? 'กำลังส่ง...' : 'Submitting...')
            : (locale === 'th' ? 'ส่งแบบสอบถาม' : 'Submit Survey') }}
        </button>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import { reactive, computed } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useVuelidate } from '@vuelidate/core';
import { useValidators } from '../../Utils/validators';
import GuestLayout from '../../Layouts/GuestLayout.vue';
import SurveySection from '../../Components/Survey/SurveySection.vue';
import SurveyQuestion from '../../Components/Survey/SurveyQuestion.vue';
import StarRating from '../../Components/Survey/StarRating.vue';
import LanguageSwitcher from '../../Components/Survey/LanguageSwitcher.vue';

const props = defineProps({
  link: Object,
  sections: Array,
  settings: Object,
  locale: String,
});

const { required, email } = useValidators(props.locale);

// Build answers map keyed by question_id
const answersMap = reactive({});

function getAnswer(questionId) {
  return answersMap[questionId]?.answer || '';
}
function getComment(questionId) {
  return answersMap[questionId]?.comment || '';
}
function setAnswer(questionId, value) {
  if (!answersMap[questionId]) answersMap[questionId] = { answer: '', comment: '' };
  answersMap[questionId].answer = value;
}
function setComment(questionId, value) {
  if (!answersMap[questionId]) answersMap[questionId] = { answer: '', comment: '' };
  answersMap[questionId].comment = value;
}

function sectionTitle(section) {
  return section.translations?.[0]?.title || '';
}
function questionText(question) {
  return question.translations?.[0]?.text || '';
}

const form = useForm({
  survey_link_id: props.link.id,
  first_name: '',
  last_name: '',
  telephone: '',
  email: '',
  overall_rating: null,
  answers: [],
  locale: props.locale,
});

const rules = computed(() => ({
  first_name: { required },
  last_name: { required },
  email: { email },
}));

const v$ = useVuelidate(rules, form);

async function submit() {
  const valid = await v$.value.$validate();
  if (!valid) return;

  // Collect all answers
  form.answers = Object.entries(answersMap).map(([questionId, data]) => ({
    question_id: parseInt(questionId),
    answer: data.answer || null,
    comment: data.comment || null,
  }));

  form.post('/survey/submit');
}
</script>
