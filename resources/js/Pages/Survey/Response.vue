<template>
  <Head :title="`Response #${currentNumber}`" />
  <GuestLayout :title="settings.title" :footer-text="settings.foot_form" :logo-url="settings.logo_url" :background-url="settings.background_url">
    <template #header-actions>
      <LanguageSwitcher :locale="locale" :slug="`${link.slug}/${currentNumber}`" />
    </template>

    <div class="mb-6 text-center">
      <h2 class="text-2xl font-bold text-slate-900">{{ settings.head_form }}</h2>
      <p class="text-sm text-slate-500 mt-1.5">
        {{ link.group_name }} &mdash;
        {{ locale === 'th' ? 'คำตอบที่' : 'Response' }} #{{ currentNumber }}
      </p>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mb-6">
      <a v-if="currentNumber > 1"
        :href="`/${locale}/${link.slug}/${currentNumber - 1}`"
        class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        {{ locale === 'th' ? 'ก่อนหน้า' : 'Previous' }}
      </a>
      <span v-else />
      <span class="text-sm text-slate-400 font-medium">{{ currentNumber }} / {{ totalResponses }}</span>
      <a v-if="currentNumber < totalResponses"
        :href="`/${locale}/${link.slug}/${currentNumber + 1}`"
        class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
        {{ locale === 'th' ? 'ถัดไป' : 'Next' }}
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </a>
      <span v-else />
    </div>

    <!-- Sections (readonly) -->
    <div class="space-y-6">
      <SurveySection v-for="section in sections" :key="section.id"
        :title="sectionTitle(section)">
        <SurveyQuestion
          v-for="question in section.questions" :key="question.id"
          :number="question.sort_order"
          :text="questionText(question)"
          :answer="getAnswer(question.id)"
          :comment="getComment(question.id)"
          :locale="locale"
          :readonly="true"
        />
      </SurveySection>

      <!-- Personal Info (readonly) -->
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="bg-gradient-to-r from-primary-600 to-primary-500 px-5 py-3.5">
          <h3 class="text-white font-semibold text-sm">
            {{ locale === 'th' ? 'ข้อมูลส่วนตัว' : 'Personal Information' }}
          </h3>
        </div>
        <div class="px-5 py-5 space-y-4">
          <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
              <span class="text-slate-400">{{ locale === 'th' ? 'ชื่อ' : 'First Name' }}</span>
              <p class="font-medium text-slate-900 mt-0.5">{{ response.first_name }}</p>
            </div>
            <div>
              <span class="text-slate-400">{{ locale === 'th' ? 'นามสกุล' : 'Last Name' }}</span>
              <p class="font-medium text-slate-900 mt-0.5">{{ response.last_name }}</p>
            </div>
            <div>
              <span class="text-slate-400">{{ locale === 'th' ? 'เบอร์โทร' : 'Telephone' }}</span>
              <p class="text-slate-700 mt-0.5">{{ response.telephone || '-' }}</p>
            </div>
            <div>
              <span class="text-slate-400">{{ locale === 'th' ? 'อีเมล' : 'Email' }}</span>
              <p class="text-slate-700 mt-0.5">{{ response.email || '-' }}</p>
            </div>
          </div>
          <div v-if="response.overall_rating" class="pt-4 border-t border-slate-100">
            <span class="text-sm text-slate-400">{{ locale === 'th' ? 'คะแนนรวม' : 'Overall Rating' }}</span>
            <StarRating :model-value="response.overall_rating" :readonly="true" class="mt-1" />
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import GuestLayout from '../../Layouts/GuestLayout.vue';
import SurveySection from '../../Components/Survey/SurveySection.vue';
import SurveyQuestion from '../../Components/Survey/SurveyQuestion.vue';
import StarRating from '../../Components/Survey/StarRating.vue';
import LanguageSwitcher from '../../Components/Survey/LanguageSwitcher.vue';

const props = defineProps({
  link: Object,
  response: Object,
  sections: Array,
  settings: Object,
  locale: String,
  totalResponses: Number,
  currentNumber: Number,
});

// Build answer lookup from response.answers
const answersByQuestion = {};
if (props.response?.answers) {
  for (const a of props.response.answers) {
    answersByQuestion[a.question_id] = a;
  }
}

function getAnswer(questionId) {
  return answersByQuestion[questionId]?.answer || '';
}
function getComment(questionId) {
  return answersByQuestion[questionId]?.comment || '';
}
function sectionTitle(section) {
  return section.translations?.[0]?.title || '';
}
function questionText(question) {
  return question.translations?.[0]?.text || '';
}
</script>
