<template>
  <header class="bg-white shadow-md sticky top-0 z-50 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-3 md:py-5 flex items-center justify-between">
      <!-- Mobile menu button -->
      <button
        @click="menuOpen = !menuOpen"
        type="button"
        aria-label="Toggle menu"
        aria-expanded="menuOpen"
        class="md:hidden w-10 h-10 rounded-lg flex justify-center items-center text-cyan-600 hover:bg-cyan-100 focus:outline-none focus:ring-2 focus:ring-cyan-400"
      >
        <svg
          class="w-6 h-6 transition-transform duration-300"
          :class="{ 'rotate-90': menuOpen }"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Logo -->
      <Link
        href="/"
        class="font-extrabold text-2xl text-cyan-700 hover:text-cyan-900 transition-colors"
      >
        Car Rental
      </Link>

      <!-- Desktop navigation -->
      <nav class="hidden md:flex space-x-8 items-center text-gray-700 font-medium">
        <Link href="/" :class="navClass('/')">Home</Link>
        <Link href="/cars" :class="navClass('/cars')">Browse Cars</Link>
        <Link href="/about" :class="navClass('/about')">About</Link>
        <Link href="/contact" :class="navClass('/contact')">Contact</Link>
        <Link
          v-if="user?.name"
          :href="user.role === 'admin' ? '/admin/dashboard' : '/rentals'"
          :class="navClass(user.role === 'admin' ? '/admin/dashboard' : '/rentals')"
        >
          {{ user.name }}
        </Link>
        <Link v-if="!user?.name" href="/login" :class="navClass('/login')">Login</Link>
        <Link v-if="user?.name" href="/logout" :class="navClass('/logout')">Logout</Link>
      </nav>
    </div>

    <!-- Mobile navigation -->
    <transition name="fade-slide" mode="out-in">
      <nav
        v-if="menuOpen"
        class="md:hidden bg-white shadow-lg rounded-b-lg mx-4 mb-4 p-4 space-y-3 text-gray-700 font-medium"
      >
        <Link href="/" :class="navClass('/')">Home</Link>
        <Link href="/cars" :class="navClass('/cars')">Browse Cars</Link>
        <Link href="/about" :class="navClass('/about')">About</Link>
        <Link href="/contact" :class="navClass('/contact')">Contact</Link>
        <Link
          v-if="user?.name"
          :href="user.role === 'admin' ? '/admin/dashboard' : '/rentals'"
          :class="navClass(user.role === 'admin' ? '/admin/dashboard' : '/rentals')"
        >
          {{ user.name }}
        </Link>
        <Link v-if="!user?.name" href="/login" :class="navClass('/login')">Login</Link>
        <Link v-if="user?.name" href="/logout" :class="navClass('/logout')">Logout</Link>
      </nav>
    </transition>
  </header>

  <slot />

  <footer class="bg-cyan-700 text-cyan-100 py-12 mt-16">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 text-center">
      <p class="text-lg font-semibold">&copy; 2025 Car Rental. All rights reserved.</p>
    </div>
  </footer>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()
const menuOpen = ref(false)
const user = page.props.user || {}

const currentUrl = computed(() => page.url)

const navClass = (path) => {
  return currentUrl.value === path
    ? 'text-cyan-700 underline'
    : 'hover:text-cyan-700 transition-colors duration-200'
}
</script>

<style>
.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: all 0.3s ease;
}
.fade-slide-enter-from {
  opacity: 0;
  transform: translateY(-10px);
}
.fade-slide-enter-to {
  opacity: 1;
  transform: translateY(0);
}
.fade-slide-leave-from {
  opacity: 1;
  transform: translateY(0);
}
.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>
