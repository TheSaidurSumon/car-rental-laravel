<template>
  <AdminLayout>
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-gray-800">Manage Customers</h1>
      <Link
        href="/admin/customers/create"
        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition"
      >
        <i class="fas fa-plus mr-2"></i> Add Customer
      </Link>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-900">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
              ID
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
              Name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">
              Email
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-100 uppercase tracking-wider">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr
            v-for="customer in customers"
            :key="customer.id"
            class="hover:bg-gray-50 transition duration-150"
          >
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ customer.id }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ customer.name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ customer.email }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-4">
              <Link
                :href="`/admin/customers/${customer.id}/edit`"
                class="text-blue-600 hover:text-blue-800"
                aria-label="Edit Customer"
              >
                <i class="fas fa-edit"></i>
              </Link>
              <button
                @click="deleteResource(customer.id)"
                class="text-red-600 hover:text-red-800 focus:outline-none"
                aria-label="Delete Customer"
              >
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
          <tr v-if="customers.length === 0">
            <td colspan="4" class="text-center py-6 text-gray-500 italic">No customers found.</td>
          </tr>
        </tbody>
      </table>
    </div>

    <ConfirmDialog
      :isOpen="showDeleteModal"
      title="Delete Customer"
      message="Are you sure you want to delete this customer?"
      @close="showDeleteModal = false"
      @confirm="confirmDelete"
    />
  </AdminLayout>
</template>

<script setup>
import { Link, usePage, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import { createToaster } from '@meforma/vue-toaster';
import ConfirmDialog from '../../../Components/ConfirmDialog.vue';

const toaster = createToaster();
const form = useForm({});
const page = usePage();

const customers = page.props.customers;

const showDeleteModal = ref(false);
const resourceToDelete = ref(null);

const deleteResource = (id) => {
  resourceToDelete.value = id;
  showDeleteModal.value = true;
};

const confirmDelete = () => {
  form.delete(`/admin/customers/${resourceToDelete.value}`, {
    onSuccess: () => {
      if (page.props.flash.status === true) {
        toaster.success(page.props.flash.message);
        router.get('/admin/customers');
      } else {
        toaster.error(page.props.flash.message);
      }
    },
  });
};
</script>
