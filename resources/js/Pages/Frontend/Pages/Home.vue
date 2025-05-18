<template>
  <FrontendLayout>
    <!-- Hero Section with Background Image -->
    <section class="relative h-[80vh] bg-cover bg-center flex items-center justify-center text-white" style="background-image: url('https://media.gq.com/photos/5b64c090a3a1320b7280ed23/16:9/w_1600,c_limit/Lamborghini-Urus-2.jpg');">
      <div class="absolute inset-0 bg-black bg-opacity-50"></div>
      <div class="relative z-10 text-center max-w-3xl px-6">
        <h1 class="text-5xl sm:text-6xl font-extrabold leading-tight mb-4">Drive Your Dream</h1>
        <p class="text-lg sm:text-xl text-gray-100 mb-8">Find the best cars at unbeatable prices. Fast, reliable, and easy to book.</p>
        <Link
          href="/cars"
          class="inline-block px-10 py-4 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-bold text-lg rounded-full transition shadow-lg"
        >
          Browse Cars
        </Link>
      </div>
    </section>

    <!-- Main Content -->
    <div class="py-20 px-6 max-w-7xl mx-auto sm:px-8">

      <!-- Why Choose Us -->
      <section class="mb-28 text-center">
        <h2 class="text-4xl font-bold text-gray-900 mb-12">Why Choose Us?</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-12">
          <div>
            <div class="text-yellow-500 text-6xl mb-4">🚘</div>
            <h3 class="text-xl font-semibold mb-2">Modern Fleet</h3>
            <p class="text-gray-600">From sleek sedans to rugged SUVs, we've got every kind of car for every trip.</p>
          </div>
          <div>
            <div class="text-yellow-500 text-6xl mb-4">💳</div>
            <h3 class="text-xl font-semibold mb-2">Transparent Pricing</h3>
            <p class="text-gray-600">No hidden fees. What you see is what you pay.</p>
          </div>
          <div>
            <div class="text-yellow-500 text-6xl mb-4">🛡️</div>
            <h3 class="text-xl font-semibold mb-2">Trusted & Insured</h3>
            <p class="text-gray-600">We work only with certified providers. Your safety is our priority.</p>
          </div>
        </div>
      </section>

      <!-- How It Works -->
      <section class="bg-white p-12 rounded-3xl shadow-xl mb-28">
        <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">How It Works</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-10 text-center">
          <div>
            <div class="w-16 h-16 mx-auto flex items-center justify-center bg-yellow-500 text-white text-2xl font-bold rounded-full mb-4">1</div>
            <h3 class="text-lg font-semibold mb-2">Select</h3>
            <p class="text-gray-600">Choose the perfect car from our vast collection.</p>
          </div>
          <div>
            <div class="w-16 h-16 mx-auto flex items-center justify-center bg-yellow-500 text-white text-2xl font-bold rounded-full mb-4">2</div>
            <h3 class="text-lg font-semibold mb-2">Book</h3>
            <p class="text-gray-600">Reserve instantly with our secure platform.</p>
          </div>
          <div>
            <div class="w-16 h-16 mx-auto flex items-center justify-center bg-yellow-500 text-white text-2xl font-bold rounded-full mb-4">3</div>
            <h3 class="text-lg font-semibold mb-2">Drive</h3>
            <p class="text-gray-600">Pick up and enjoy the ride. No hassle, just drive.</p>
          </div>
        </div>
      </section>

      <!-- Testimonials -->
      <section class="mb-28">
        <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">What Our Customers Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <blockquote class="bg-gray-50 border-l-4 border-yellow-500 rounded-xl shadow-md p-6 italic text-gray-700">
            “Amazing experience! The booking was smooth and the car exceeded my expectations.”
            <footer class="mt-4 font-semibold text-gray-900">— Ayesha K.</footer>
          </blockquote>
          <blockquote class="bg-gray-50 border-l-4 border-yellow-500 rounded-xl shadow-md p-6 italic text-gray-700">
            “Great value and excellent service. Highly recommend for anyone needing a rental.”
            <footer class="mt-4 font-semibold text-gray-900">— Rahim H.</footer>
          </blockquote>
        </div>
      </section>

      <!-- Final CTA -->
      <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-2xl text-center p-12 shadow-lg">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Your Next Adventure Awaits</h2>
        <Link
          href="/cars"
          class="inline-block px-12 py-4 bg-white hover:bg-gray-100 text-yellow-600 font-bold text-lg rounded-full transition"
        >
          Explore Cars Now
        </Link>
      </section>

    </div>
  </FrontendLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const page = usePage();
const cars = ref(page.props.cars);
</script>

<style scoped>
/* Tailwind handles styling */
</style>
