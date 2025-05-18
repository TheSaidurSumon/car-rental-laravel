<template>
  <FrontendLayout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
      <h1 class="text-2xl font-bold mb-6 border-b-2 border-indigo-600 inline-block pb-1">
        All Your Rentals
      </h1>

      <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto">
          <thead class="bg-indigo-700 text-white text-sm uppercase tracking-wide">
            <tr>
              <th class="py-3 px-4 text-left w-1/12">Rent ID</th>
              <th class="py-3 px-4 text-left w-2/12">Car</th>
              <th class="py-3 px-4 text-left w-2/12">Start Date</th>
              <th class="py-3 px-4 text-left w-2/12">End Date</th>
              <th class="py-3 px-4 text-center w-1/12">Day/s</th>
              <th class="py-3 px-4 text-right w-1/12">Daily Cost</th>
              <th class="py-3 px-4 text-right w-1/12">Total Rent</th>
              <th class="py-3 px-4 text-center w-1/12">Status</th>
              <th class="py-3 px-4 text-center w-1/12">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="rental in rentals"
              :key="rental.id"
              class="even:bg-gray-50 hover:bg-indigo-50 transition-colors"
            >
              <td class="py-3 px-4 whitespace-nowrap">{{ rental.id }}</td>
              <td class="py-3 px-4 whitespace-nowrap">
                {{ rental.car.name }} ({{ rental.car.brand }})
              </td>
              <td class="py-3 px-4 whitespace-nowrap">{{ formatDate(rental.start_date) }}</td>
              <td class="py-3 px-4 whitespace-nowrap">{{ formatDate(rental.end_date) }}</td>
              <td class="py-3 px-4 text-center whitespace-nowrap">
                {{ getDateDiff(rental.start_date, rental.end_date) }}
              </td>
              <td class="py-3 px-4 text-right whitespace-nowrap">TK{{ rental.car.daily_rent_price }}</td>
              <td class="py-3 px-4 text-right whitespace-nowrap">TK{{ rental.total_cost }}</td>
              <td class="py-3 px-4 text-center whitespace-nowrap">
                <span
                  v-if="rental.status === 'Ongoing'"
                  class="inline-block bg-yellow-100 text-yellow-800 font-semibold px-3 py-1 rounded-full border border-yellow-300"
                >
                  Ongoing
                </span>
                <span
                  v-else-if="rental.status === 'Completed'"
                  class="inline-block bg-green-100 text-green-800 font-semibold px-3 py-1 rounded-full border border-green-300"
                >
                  Completed
                </span>
                <span
                  v-else
                  class="inline-block bg-red-100 text-red-800 font-semibold px-3 py-1 rounded-full border border-red-300"
                >
                  Canceled
                </span>
              </td>
              <td class="py-3 px-4 text-center whitespace-nowrap">
                <button
                  v-if="rental.status !== 'Canceled' && rental.status !== 'Completed'"
                  @click="deleteResource(rental.id)"
                  class="bg-red-600 hover:bg-red-700 transition-colors duration-200 px-4 py-2 text-white rounded-md text-sm"
                  aria-label="Cancel Booking"
                >
                  Cancel Booking
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Empty state if no rentals -->
      <div v-if="rentals.length === 0" class="mt-10 text-center text-gray-600">
        <p class="mb-4 text-lg">
          You don't have any active rentals.<br />
          To rent a car please click below
        </p>
        <Link
          href="/cars"
          class="inline-block bg-indigo-600 hover:bg-indigo-700 transition text-white px-5 py-3 rounded-md font-semibold"
        >
          Browse Cars
        </Link>
      </div>

      <!-- Confirm Dialog Component -->
      <ConfirmDialog
        :isOpen="showDeleteModal"
        title="Cancel Rental"
        message="Are you sure you want to cancel this rental?"
        @close="showDeleteModal = false"
        @confirm="confirmDelete"
        ok="Cancel"
        cancel="No"
      />
    </div>
  </FrontendLayout>
</template>

<script setup>
import { Link, router, usePage, useForm } from "@inertiajs/vue3";
import ConfirmDialog from "@/Components/ConfirmDialog.vue";
import { createToaster } from "@meforma/vue-toaster";
import { ref } from "vue";
import { format } from "date-fns";
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const page = usePage();
const toaster = createToaster();
const form = useForm({});

const rentals = page.props.rentals || [];

if (page.props.share_data) {
  toaster.error(page.props.share_data);
}

const showDeleteModal = ref(false);
const resourceToDelete = ref(null);

const deleteResource = (id) => {
  resourceToDelete.value = id;
  showDeleteModal.value = true;
};

const confirmDelete = () => {
  form.delete(`/rentals/${resourceToDelete.value}`, {
    onSuccess: () => {
      if (page.props.flash.status === true) {
        toaster.success(page.props.flash.message);
        router.get("/rentals");
      } else {
        toaster.error(page.props.flash.message);
      }
    },
  });
};

const formatDate = (dateString) => {
  if (!dateString) return "";
  const date = new Date(dateString);
  const day = date.getDate();
  const suffix =
    ["th", "st", "nd", "rd"][
      day % 10 > 3 || (day % 100 - day % 10) === 10 ? 0 : day % 10
    ];
  return `${day}${suffix} ${format(date, "MMM, yyyy")}`;
};

const getDateDiff = (startDate, endDate) => {
  const start = new Date(startDate);
  const end = new Date(endDate);
  const diffTime = end - start < 1 ? 1 : end - start + 1;
  return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
};
</script>

<style scoped>
/* Optional: Add smooth transition for hover effects */
table tr {
  transition: background-color 0.2s ease-in-out;
}
</style>
