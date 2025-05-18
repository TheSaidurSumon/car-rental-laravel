<template>
  <FrontendLayout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid md:grid-cols-2 gap-8 bg-white rounded-2xl shadow-lg overflow-hidden">
        
        <!-- Car Image Section -->
        <div class="bg-gray-100 relative">
          <img
            v-if="car.image"
            :src="`/storage/${car.image}`"
            :alt="car.name"
            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
          />
          <img
            v-else
            src="../../../Assets/img/empty-car.jpg"
            alt="Empty image"
            class="w-full h-full object-cover opacity-70"
          />
          <div
            v-if="!car.availability"
            class="absolute top-4 left-4 bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow"
          >
            Not Available
          </div>
        </div>

        <!-- Car Info Section -->
        <div class="p-6 flex flex-col justify-between space-y-6">
          <!-- Title and Info -->
          <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-1">{{ car.name }}</h1>
            <p class="text-gray-500">{{ car.brand }} • {{ car.model }} • {{ car.year }}</p>
            <span class="inline-block mt-4 px-3 py-1 text-sm rounded-full bg-indigo-100 text-indigo-700 font-medium">
              {{ car.car_type }}
            </span>
          </div>

          <!-- Pricing Info -->
          <div>
            <p class="text-sm text-gray-400">Daily Rent</p>
            <p class="text-4xl font-extrabold text-indigo-600">৳{{ car.daily_rent_price }}</p>
          </div>

          <!-- Action Button -->
          <div>
            <button
              v-if="car.availability"
              @click.prevent="openModal"
              class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-base font-semibold rounded-lg shadow transition"
            >
              Book Now
            </button>
            <p
              v-else
              class="w-full text-center px-6 py-3 bg-gray-400 text-white text-base font-semibold rounded-lg cursor-not-allowed"
            >
              Not Available
            </p>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <BookingModal v-if="showModal" @close="showModal = false" :car="car" />
    </div>
  </FrontendLayout>
</template>

<script setup>
import { ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import BookingModal from "@/Components/Rental/BookingModal.vue"
import FrontendLayout from "@/Layouts/FrontendLayout.vue"
import { createToaster } from "@meforma/vue-toaster"

const toaster = createToaster()
const page = usePage()
const car = page.props.car
const showModal = ref(false)

const openModal = () => {
  if (!page.props.user?.name) {
    toaster.error("You need to be logged in to book a car")
    router.get("/login")
  } else {
    showModal.value = true
  }
}
</script>
