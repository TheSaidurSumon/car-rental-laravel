<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from "../../Layouts/AdminLayout.vue";
defineProps({ stats: Object });
</script>

<template>
  <Head title="Admin Dashboard" />
  <AdminLayout>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <div class="flex items-center p-6 bg-gradient-to-r from-indigo-500 to-indigo-700 text-white rounded-lg shadow-lg">
        <div class="p-3 bg-indigo-900 rounded-full mr-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 6 4-8 3 6h4" />
          </svg>
        </div>
        <div>
          <h3 class="text-sm font-semibold uppercase">Total Cars</h3>
          <p class="text-3xl font-bold">{{ stats.totalCars }}</p>
        </div>
      </div>
      
      <div class="flex items-center p-6 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-lg shadow-lg">
        <div class="p-3 bg-green-900 rounded-full mr-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <div>
          <h3 class="text-sm font-semibold uppercase">Available Cars</h3>
          <p class="text-3xl font-bold">{{ stats.availableCars }}</p>
        </div>
      </div>
      
      <div class="flex items-center p-6 bg-gradient-to-r from-yellow-400 to-yellow-600 text-white rounded-lg shadow-lg">
        <div class="p-3 bg-yellow-700 rounded-full mr-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 6 4-8 3 6h4" />
          </svg>
        
        </div>
        <div>
          <h3 class="text-sm font-semibold uppercase">Total Rentals</h3>
          <p class="text-3xl font-bold">{{ stats.totalRentals }}</p>
        </div>
      </div>
      
      <div class="flex items-center p-6 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-lg shadow-lg">
        <div class="p-3 bg-red-900 rounded-full mr-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3v5h6v-5c0-1.657-1.343-3-3-3z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
          </svg>
        </div>
        <div>
          <h3 class="text-sm font-semibold uppercase">Total Revenue</h3>
          <p class="text-3xl font-bold">TK {{ stats.totalProfit || 0 }}</p>
        </div>
      </div>
      
    </div>
  </AdminLayout>
</template>
