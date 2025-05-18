<template>
  <FrontendLayout>
    <div class="py-12 bg-gray-50 min-h-screen">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Hero Section -->
        <section class="text-center mb-16">
          <h1 class="text-4xl font-extrabold text-gray-800 mb-4">
            Reliable & Affordable Car Rentals
          </h1>
          <p class="max-w-2xl mx-auto text-lg text-gray-600 mb-8">
            Explore your destination with our wide selection of cars, available for rent at competitive prices.  
            Easy booking, flexible terms, and 24/7 support to make your trip smooth.
          </p>

          <div class="flex justify-center gap-6">
            <Link
              href="/cars"
              class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition"
            >
              Browse Cars
            </Link>
            <Link
              href="/contact"
              class="px-6 py-3 border border-indigo-600 text-indigo-600 font-semibold rounded-md hover:bg-indigo-50 transition"
            >
              Contact Us
            </Link>
          </div>
        </section>

        <!-- Features Section -->
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-10 text-center">
          <div class="bg-white p-6 rounded-lg shadow-md">
            <svg class="mx-auto mb-4 h-12 w-12 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <path d="M3 12h18M3 6h18M3 18h18"></path>
            </svg>
            <h3 class="text-xl font-semibold mb-2">Wide Vehicle Selection</h3>
            <p class="text-gray-600">Choose from economy, luxury, SUVs, and more to fit your style and budget.</p>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-md">
            <svg class="mx-auto mb-4 h-12 w-12 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <path d="M12 8v8m-4-4h8"></path>
            </svg>
            <h3 class="text-xl font-semibold mb-2">Affordable Prices</h3>
            <p class="text-gray-600">Competitive rates and special discounts ensure great value for your rental.</p>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-md">
            <svg class="mx-auto mb-4 h-12 w-12 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10"></circle>
              <path d="M12 8v4l3 3"></path>
            </svg>
            <h3 class="text-xl font-semibold mb-2">24/7 Customer Support</h3>
            <p class="text-gray-600">We're here whenever you need assistance with your booking or rental experience.</p>
          </div>
        </section>

      </div>
    </div>
  </FrontendLayout>
</template>

<script setup>
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>

<style scoped>
</style>
