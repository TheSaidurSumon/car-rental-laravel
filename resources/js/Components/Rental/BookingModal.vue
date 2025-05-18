<template>
  <div
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50 p-4"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-title"
  >
    <div
      class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 sm:p-8"
    >
      <h2
        id="modal-title"
        class="text-2xl font-semibold text-gray-900 mb-6"
      >
        Add Booking for car "<span class="font-medium text-indigo-600">{{ car.name }}</span>"
      </h2>

      <form @submit.prevent="submitForm" class="space-y-6">

        <div>
          <label for="start_date" class="block text-gray-700 font-medium mb-1">Start Date</label>
          <DatePicker
            id="start_date"
            v-model="form.start_date"
            :min-date="minDate"
            auto-apply
            :format="dateFormat"
            position="left"
            class="w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 transition"
          />
          <p v-if="errors.start_date" class="mt-1 text-sm text-red-600">{{ errors.start_date }}</p>
        </div>

        <div>
          <label for="end_date" class="block text-gray-700 font-medium mb-1">End Date</label>
          <DatePicker
            id="end_date"
            v-model="form.end_date"
            :min-date="form.start_date || minDate"
            auto-apply
            :format="dateFormat"
            position="left"
            class="w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 transition"
          />
          <p v-if="errors.end_date" class="mt-1 text-sm text-red-600">{{ errors.end_date }}</p>
        </div>

        <div class="flex justify-end space-x-4">
          <button
            type="button"
            @click="close"
            class="inline-flex items-center justify-center px-5 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
          >
            Cancel
          </button>

          <button
            type="submit"
            class="inline-flex items-center justify-center px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
          >
            Add Booking
          </button>
        </div>

      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, defineProps, defineEmits } from 'vue';
import DatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { usePage, useForm, router } from '@inertiajs/vue3';
import { createToaster } from "@meforma/vue-toaster";

const dateFormat = 'yyyy-MM-dd';

const props = defineProps({
  isOpen: Boolean,
  car: Object,
});

const toaster = createToaster();
const emit = defineEmits(['close']);

const close = () => {
  emit('close');
};

const errors = ref({});

const page = usePage();

const minDate = new Date();
minDate.setDate(minDate.getDate() + 1);

const form = useForm({
  start_date: null,
  end_date: null,
  car_id: props.car.id,
});

const validateForm = () => {
  errors.value = {};

  if (!form.start_date) {
    errors.value.start_date = "Start date is required.";
  }

  if (!form.end_date) {
    errors.value.end_date = "End date is required.";
  } else if (form.start_date && form.end_date < form.start_date) {
    errors.value.end_date = "End date must be after start date.";
  }

  return Object.keys(errors.value).length === 0;
};

const submitForm = () => {
  if (!validateForm()) return;

  form.post(`/rentals`, {
    onError: (errors) => {
      toaster.error(Object.values(errors).flat().join(' '));
    },
    onSuccess: () => {
      if (page.props.flash.status) {
        toaster.success(page.props.flash.message);
        router.get("/rentals");
      } else {
        toaster.error(page.props.flash.message);
      }
    },
  });
};
</script>
