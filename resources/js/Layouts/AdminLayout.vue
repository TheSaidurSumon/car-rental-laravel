<template>
  <div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-72 bg-gray-900 shadow-lg text-gray-200 flex flex-col">
      <nav class="p-8 flex flex-col h-full">
        <h2 class="text-2xl font-extrabold mb-10 tracking-wide text-yellow-400">Admin Panel</h2>
        <ul class="flex flex-col space-y-4 flex-grow">
          <li>
            <Link
              href="/admin/dashboard"
              :class="navClass('/admin/dashboard')"
              class="flex items-center space-x-3"
            >
              <i class="fas fa-tachometer-alt w-5"></i>
              <span>Dashboard</span>
            </Link>
          </li>
          <li>
            <Link
              href="/admin/cars"
              :class="navClass('/admin/cars')"
              class="flex items-center space-x-3"
            >
              <i class="fas fa-car w-5"></i>
              <span>Cars</span>
            </Link>
          </li>
          <li>
            <Link
              href="/admin/customers"
              :class="navClass('/admin/customers')"
              class="flex items-center space-x-3"
            >
              <i class="fas fa-users w-5"></i>
              <span>Customers</span>
            </Link>
          </li>
          <li>
            <Link
              href="/admin/rentals"
              :class="navClass('/admin/rentals')"
              class="flex items-center space-x-3"
            >
              <i class="fas fa-file-contract w-5"></i>
              <span>Rentals</span>
            </Link>
          </li>
        </ul>
        <div class="mt-auto pt-6 border-t border-gray-700">
          <button
            @click="logout"
            class="w-full py-2 text-red-400 hover:text-red-600 font-semibold focus:outline-none focus:ring-2 focus:ring-red-500 rounded"
          >
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
        </div>
      </nav>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
      <!-- Top Navbar -->
      <header class="bg-white shadow-md px-8 py-5 flex justify-between items-center border-b border-gray-200">
        <h2 class="text-3xl font-bold text-gray-800 tracking-wide">Admin Dashboard</h2>
        <div class="flex items-center space-x-6">
          <span class="text-gray-600 text-lg">Welcome, <strong>{{ user.name }}</strong></span>
        </div>
      </header>

      <!-- Page Content -->
      <main class="p-8 flex-1 overflow-y-auto bg-white rounded-tr-lg rounded-br-lg shadow-inner">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { Link, usePage, router } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const user = page.props.user || {}

const currentUrl = computed(() => page.url)

const navClass = (path) => {
  return currentUrl.value.startsWith(path)
    ? 'bg-yellow-400 text-gray-900 rounded-md px-4 py-2 font-semibold shadow-lg'
    : 'hover:bg-yellow-300 hover:text-gray-900 rounded-md px-4 py-2 transition-colors duration-200 flex items-center'
}

const logout = () => {
  router.get('/logout')
}
</script>
