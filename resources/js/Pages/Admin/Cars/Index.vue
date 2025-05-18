<template>
  <AdminLayout>
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-extrabold text-gray-900">Manage Cars</h1>
      <Link
        href="/admin/cars/create"
        class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition"
      >
        <i class="fas fa-plus mr-2"></i> Add Car
      </Link>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-indigo-600">
          <tr>
            <th
              scope="col"
              class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
            >
              ID
            </th>
            <th
              scope="col"
              class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
            >
              Image
            </th>
            <th
              scope="col"
              class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
            >
              Name
            </th>
            <th
              scope="col"
              class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
            >
              Brand
            </th>
            <th
              scope="col"
              class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
            >
              Model
            </th>
            <th
              scope="col"
              class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
            >
              Year
            </th>
            <th
              scope="col"
              class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
            >
              Daily Rent Price
            </th>
            <th
              scope="col"
              class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
            >
              Availability
            </th>
            <th
              scope="col"
              class="px-4 py-3 text-center text-xs font-medium text-white uppercase tracking-wider"
            >
              Action
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr v-for="car in cars" :key="car.id" class="hover:bg-gray-50">
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ car.id }}</td>
            <td class="px-4 py-3 whitespace-nowrap">
              <img
                class="w-16 h-16 rounded-md object-cover"
                :src="car.image ? `/storage/${car.image}` : '/empty.png'"
                alt="car image"
              />
            </td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ car.name }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ car.brand }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ car.model }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ car.year }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">TK {{ car.daily_rent_price }}</td>
            <td class="px-4 py-3 whitespace-nowrap">
              <span
                :class="car.availability ? 'bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold' : 'bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold'"
              >
                {{ car.availability ? 'Available' : 'Not Available' }}
              </span>
            </td>
            <td class="px-4 py-3 whitespace-nowrap text-center text-sm font-medium space-x-4">
              <Link
                :href="`/admin/cars/${car.id}/edit`"
                class="text-indigo-600 hover:text-indigo-900"
                title="Edit"
              >
                <i class="fas fa-edit"></i>
              </Link>
              <button
                @click="deleteResource(car.id)"
                class="text-red-600 hover:text-red-900"
                title="Delete"
              >
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Confirm Dialog Component -->
    <ConfirmDialog
      :isOpen="showDeleteModal"
      title="Delete Car"
      message="Are you sure you want to delete this car?"
      @close="showDeleteModal = false"
      @confirm="confirmDelete"
    />
  </AdminLayout>
</template>

<script setup>
import { Link, router, usePage, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import ConfirmDialog from '@/Components/ConfirmDialog.vue';
import { createToaster } from '@meforma/vue-toaster';
import { ref } from 'vue';

const page = usePage();
const toaster = createToaster();
const form = useForm({});

const cars = page.props.cars;

const showDeleteModal = ref(false);
const resourceToDelete = ref(null);

const deleteResource = (id) => {
  resourceToDelete.value = id;
  showDeleteModal.value = true;
};

const confirmDelete = () => {
  form.delete(`/admin/cars/${resourceToDelete.value}`, {
    onSuccess: () => {
      if (page.props.flash.status === true) {
        toaster.success(page.props.flash.message);
        router.get('/admin/cars');
      } else {
        toaster.error(page.props.flash.message);
      }
    },
  });
};
</script>
