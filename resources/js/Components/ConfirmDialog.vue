<template>
  <div
    v-show="isOpen"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50"
  >
    <transition
      enter-active-class="transition transform ease-out duration-300"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition transform ease-in duration-200"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div
        v-show="isOpen"
        class="bg-white rounded-xl shadow-xl max-w-md w-full p-6"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-title"
      >
        <h2
          id="modal-title"
          class="text-xl font-semibold text-gray-900 mb-4 flex items-center space-x-2"
        >
          <svg
            class="w-6 h-6 text-red-600"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            viewBox="0 0 24 24"
            aria-hidden="true"
          >
            <path d="M12 9v4m0 4h.01M4.93 4.93l14.14 14.14" />
          </svg>
          <span>{{ title }}</span>
        </h2>
        <p class="text-gray-700 mb-6">{{ message }}</p>
        <div class="flex justify-end space-x-4">
          <button
            @click="close"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition"
          >
            <svg
              class="w-5 h-5 mr-2"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              viewBox="0 0 24 24"
            >
              <path d="M6 18L18 6M6 6l12 12" />
            </svg>
            {{ cancel }}
          </button>
          <button
            @click="confirm"
            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition"
          >
            <svg
              class="w-5 h-5 mr-2"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              viewBox="0 0 24 24"
            >
              <path d="M3 6h18M9 6v12a3 3 0 006 0V6" />
            </svg>
            {{ ok }}
          </button>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
  isOpen: Boolean,
  title: {
    type: String,
    default: 'Confirm Delete',
  },
  message: {
    type: String,
    default: 'Are you sure you want to delete this item?',
  },
  ok: {
    type: String,
    default: 'Delete',
  },
  cancel: {
    type: String,
    default: 'Cancel',
  },
})

const emit = defineEmits(['close', 'confirm'])

const close = () => emit('close')
const confirm = () => emit('confirm')
</script>
