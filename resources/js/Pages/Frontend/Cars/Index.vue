<template>
  <FrontendLayout>
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-400 text-white py-10 px-6 shadow-md">
      <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold mb-2">Explore Our Rental Fleet</h1>
        <p class="text-lg opacity-90">Find the perfect ride tailored to your journey.</p>
      </div>
    </div>

    <!-- Filters -->
    <div class="bg-white py-6 px-6 shadow-sm">
      <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <input
            v-model="filters.type"
            placeholder="Type (e.g., SUV, Sedan)"
            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            @input="applyFilters"
          />
          <input
            v-model="filters.brand"
            placeholder="Brand (e.g., Toyota)"
            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            @input="applyFilters"
          />
          <select
            v-model="filters.rent_price_range"
            @change="applyFilters"
            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
          >
            <option value="">Rent Price Range</option>
            <option value="100-below">TK100 or Below</option>
            <option value="100-500">TK100 - TK500</option>
            <option value="500-1000">TK500 - TK1000</option>
            <option value="1000-above">TK1000 or Above</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Car Cards -->
    <div class="py-10 px-6 bg-gray-50 min-h-screen">
      <div class="max-w-7xl mx-auto">
        <div v-if="cars && cars.length" class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
          <div
            v-for="car in cars"
            :key="car.id"
            class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition duration-300"
          >
            <div
              class="h-48 bg-cover bg-center"
              :style="{ backgroundImage: car.image ? `url('/storage/${car.image}')` : `url('/empty.png')` }"
            ></div>
            <div class="p-4">
              <h3 class="text-xl font-semibold text-gray-800 hover:text-indigo-600 transition">
                <Link :href="`/cars/${car.id}`">{{ car.name }}</Link>
              </h3>
              <p class="text-sm text-gray-500 mt-1">
                {{ car.car_type }} • {{ car.brand }} • {{ car.model }} ({{ car.year }})
              </p>
              <div class="text-indigo-600 text-xl font-bold mt-3">TK {{ car.daily_rent_price }} / day</div>
              <Link
                :href="`/cars/${car.id}`"
                class="mt-4 inline-block w-full text-center bg-indigo-600 text-white font-medium py-2 rounded-lg hover:bg-indigo-700 transition"
              >
                View Details
              </Link>
            </div>
          </div>
        </div>

        <!-- No Cars Found -->
        <div v-else class="text-center text-gray-500 text-lg py-20">
          🚗 No cars found for your filters.
        </div>
      </div>
    </div>
  </FrontendLayout>
</template>


<script setup>
import { ref, watch } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import FrontendLayout from '@/Layouts/FrontendLayout.vue'

const page = usePage()
const cars = ref(page.props.cars)
const filters = ref({
  type: page.props.filters?.type || '',
  brand: page.props.filters?.brand || '',
  rent_price_range: page.props.filters?.rent_price_range || ''
})

const applyFilters = () => {
  router.get('/cars', filters.value, { preserveState: true, replace: true })
}

watch(() => page.props.cars, (newCars) => {
  cars.value = newCars
}, { immediate: true })
</script>

<style scoped>
.text-primary {
  @apply text-indigo-600;
}
.bg-primary {
  @apply bg-indigo-600;
}
.bg-primary-dark {
  @apply bg-indigo-700;
}
</style>
