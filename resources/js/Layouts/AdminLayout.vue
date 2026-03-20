<template>
  <div class="min-h-screen bg-slate-50 flex">
    <!-- Sidebar -->
    <aside
      :class="[
        'fixed inset-y-0 left-0 z-30 flex flex-col bg-white border-r border-slate-200 transition-all duration-300',
        collapsed ? 'w-[68px]' : 'w-60'
      ]">
      <!-- Logo + Collapse/Expand -->
      <div class="h-16 border-b border-slate-100 shrink-0 px-3 flex items-center" :class="collapsed ? 'justify-center' : 'justify-between'">
        <a v-show="!collapsed" href="/admin/dashboard" class="flex items-center gap-3 overflow-hidden">
          <div class="w-9 h-9 bg-primary-600 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
          </div>
          <span class="text-lg font-bold text-slate-900 tracking-tight whitespace-nowrap">Comment</span>
        </a>
        <button @click="collapsed = !collapsed"
          class="w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition shrink-0"
          :title="collapsed ? 'Expand sidebar' : 'Collapse sidebar'">
          <svg :class="['w-4 h-4 transition-transform duration-300', collapsed ? 'rotate-180' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
          </svg>
        </button>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <a v-for="item in navItems" :key="item.href" :href="item.href"
          :class="[
            'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group',
            isActive(item.href)
              ? 'bg-primary-50 text-primary-700'
              : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100'
          ]"
          :title="item.label">
          <div :class="['w-5 h-5 shrink-0', isActive(item.href) ? 'text-primary-600' : 'text-slate-400 group-hover:text-slate-600']" v-html="item.icon" />
          <span v-show="!collapsed" class="whitespace-nowrap">{{ item.label }}</span>
        </a>
      </nav>

    </aside>

    <!-- Main content -->
    <div :class="['flex-1 transition-all duration-300', collapsed ? 'ml-[68px]' : 'ml-60']">
      <!-- Top bar -->
      <header class="sticky top-0 z-20 bg-white/80 backdrop-blur-sm border-b border-slate-200 h-16 flex items-center px-6">
        <div class="flex-1" />
        <div class="relative" ref="dropdownRef">
          <button @click="showDropdown = !showDropdown"
            class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-slate-100 transition">
            <div class="w-8 h-8 bg-primary-100 text-primary-700 rounded-full flex items-center justify-center shrink-0 text-xs font-bold">
              {{ auth?.user?.name?.charAt(0)?.toUpperCase() || 'U' }}
            </div>
            <div class="text-left hidden sm:block">
              <p class="text-sm font-medium text-slate-900 leading-tight">{{ auth?.user?.name }}</p>
              <p class="text-xs text-slate-400 leading-tight">{{ auth?.user?.role }}</p>
            </div>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <!-- Dropdown -->
          <Transition
            enter-active-class="transition duration-150 ease-out"
            enter-from-class="opacity-0 scale-95 -translate-y-1"
            enter-to-class="opacity-100 scale-100 translate-y-0"
            leave-active-class="transition duration-100 ease-in"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95">
            <div v-if="showDropdown"
              class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-200 py-1.5 z-50">
              <div class="px-4 py-2.5 border-b border-slate-100">
                <p class="text-sm font-medium text-slate-900">{{ auth?.user?.name }}</p>
                <p class="text-xs text-slate-400">{{ auth?.user?.email }}</p>
              </div>
              <form @submit.prevent="logout" class="px-1.5 pt-1.5">
                <button type="submit"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-red-600 hover:bg-red-50 transition">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                  </svg>
                  Logout
                </button>
              </form>
            </div>
          </Transition>
        </div>
      </header>

      <!-- Page content -->
      <main class="p-6">
        <Transition
          enter-active-class="transition duration-200"
          enter-from-class="opacity-0 -translate-y-1"
          enter-to-class="opacity-100 translate-y-0"
          leave-active-class="transition duration-150"
          leave-from-class="opacity-100"
          leave-to-class="opacity-0">
          <div v-if="$page.props.flash?.success"
            class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ $page.props.flash.success }}
          </div>
        </Transition>
        <div v-if="$page.props.flash?.error"
          class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm flex items-center gap-2">
          <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
          {{ $page.props.flash.error }}
        </div>
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { usePage, router } from '@inertiajs/vue3';
import { computed, ref, onMounted, onUnmounted } from 'vue';

const page = usePage();
const auth = computed(() => page.props.auth);
const currentPath = computed(() => page.url);
const collapsed = ref(false);
const showDropdown = ref(false);
const dropdownRef = ref(null);

function handleClickOutside(e) {
  if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
    showDropdown.value = false;
  }
}

onMounted(() => document.addEventListener('click', handleClickOutside));
onUnmounted(() => document.removeEventListener('click', handleClickOutside));

const navItems = computed(() => {
  const items = [
    {
      href: '/admin/dashboard',
      label: 'Dashboard',
      icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>',
    },
    {
      href: '/admin/survey-links',
      label: 'Survey Links',
      icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>',
    },
  ];

  if (auth.value?.user?.role === 'admin') {
    items.push(
      {
        href: '/admin/survey-sections',
        label: 'Sections & Questions',
        icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>',
      },
      {
        href: '/admin/rooms',
        label: 'Rooms',
        icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
      },
      {
        href: '/admin/hotel-profiles',
        label: 'Hotel Profiles',
        icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>',
      },
      {
        href: '/admin/users',
        label: 'Users',
        icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"/></svg>',
      },
    );
  }

  return items;
});

function isActive(href) {
  return currentPath.value === href || currentPath.value?.startsWith(href + '/');
}

function logout() {
  router.post('/admin/logout');
}
</script>
