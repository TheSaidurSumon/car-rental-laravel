<template>
  <AdminLayout>
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-extrabold text-gray-900">Manage Rentals</h1>
      <Link
        href="/admin/rentals/create"
        class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition"
      >
        <i class="fas fa-plus mr-2"></i>Add Rental
      </Link>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-indigo-700 text-white text-xs uppercase tracking-wider">
          <tr>
            <th class="px-4 py-3 text-left">ID</th>
            <th class="px-4 py-3 text-left">Customer</th>
            <th class="px-4 py-3 text-left">Car</th>
            <th class="px-4 py-3 text-left">Start Date</th>
            <th class="px-4 py-3 text-left">End Date</th>
            <th class="px-4 py-3 text-left">Days</th>
            <th class="px-4 py-3 text-left">Daily Cost</th>
            <th class="px-4 py-3 text-left">Total Cost</th>
            <th class="px-4 py-3 text-left">Status</th>
            <th class="px-4 py-3 text-left">Action</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          <tr v-for="rental in rentals" :key="rental.id" class="hover:bg-gray-50 transition">
            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ rental.id }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ rental.user?.name || '-' }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ rental.car?.name || '-' }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ formatDate(rental.start_date) }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ formatDate(rental.end_date) }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ getDateDiff(rental.start_date, rental.end_date) }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">TK {{ rental.car?.daily_rent_price ?? '0' }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-indigo-700">TK {{ rental.total_cost }}</td>
            <td class="px-4 py-3 whitespace-nowrap">
              <span
                :class="{
                  'bg-yellow-100 text-yellow-800 border-yellow-300': rental.status === 'Ongoing',
                  'bg-green-100 text-green-800 border-green-300': rental.status === 'Completed',
                  'bg-red-100 text-red-800 border-red-300': rental.status !== 'Ongoing' && rental.status !== 'Completed',
                }"
                class="inline-block px-3 py-1 text-xs font-semibold rounded border"
              >
                {{ rental.status }}
              </span>
            </td>
            <td class="px-4 py-3 whitespace-nowrap">
              <Link
                :href="`/admin/rentals/${rental.id}/edit`"
                class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded"
                aria-label="Edit rental"
              >
                <i class="fas fa-edit"></i>
              </Link>
              <!-- Uncomment if delete enabled -->
              <!--
              <button
                @click="deleteResource(rental.id)"
                class="ml-3 text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 rounded"
                aria-label="Delete rental"
              >
                <i class="fas fa-trash-alt"></i>
              </button>
              -->
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Confirm Dialog Component -->
    <ConfirmDialog
      :isOpen="showDeleteModal"
      title="Delete Rental"
      message="Are you sure you want to delete this rental?"
      @close="showDeleteModal = false"
      @confirm="confirmDelete"
    />
  </AdminLayout>
</template>

<script setup>
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import ConfirmDialog from '@/Components/ConfirmDialog.vue';
import { createToaster } from '@meforma/vue-toaster';
import { ref } from 'vue';
import { format } from 'date-fns';

const page = usePage();
const toaster = createToaster();
const form = useForm({});

const rentals = page.props.rentals;

const showDeleteModal = ref(false);
const resourceToDelete = ref(null);

if (page.props.share_data) {
  toaster.error(page.props.share_data);
}

const deleteResource = (id) => {
  resourceToDelete.value = id;
  showDeleteModal.value = true;
};

const confirmDelete = () => {
  form.delete(`/admin/rentals/${resourceToDelete.value}`, {
    onSuccess: () => {
      if (page.props.flash.status) {
        toaster.success(page.props.flash.message);
        router.get('/admin/rentals');
      } else {
        toaster.error(page.props.flash.message);
      }
    },
  });
};

const formatDate = (dateString) => {
  if (!dateString) return '-';
  const date = new Date(dateString);
  const day = date.getDate();
  const suffix =
    ['th', 'st', 'nd', 'rd'][
      day % 10 > 3 || (day % 100 - day % 10) === 10 ? 0 : day % 10
    ];
  return `${day}${suffix} ${format(date, 'MMM, yyyy')}`;
};

const getDateDiff = (startDate, endDate) => {
  const start = new Date(startDate);
  const end = new Date(endDate);
  const diffTime = end - start < 1 ? 1 : end - start + 1;
  return Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // ms to days
};
</script>
