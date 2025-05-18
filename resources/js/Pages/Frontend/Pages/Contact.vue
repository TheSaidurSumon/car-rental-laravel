<template>
  <FrontendLayout>
    <div class="py-10 bg-gray-50 min-h-screen">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <header class="mb-8 text-center">
          <h1 class="text-3xl font-bold text-gray-700">Contact Us</h1>
          <p class="mt-2 text-lg text-gray-600">We are here to help! Reach out to us.</p>
        </header>

        <section class="bg-white rounded-lg shadow-md p-8">
          <form @submit.prevent="submit" novalidate>
            <div class="space-y-6">
              <div>
                <label for="name" class="block mb-2 font-semibold text-gray-700">Your Name</label>
                <input
                  id="name"
                  type="text"
                  v-model="form.name"
                  placeholder="John Doe"
                  class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                  autocomplete="name"
                  required
                />
              </div>

              <div>
                <label for="email" class="block mb-2 font-semibold text-gray-700">Your Email</label>
                <input
                  id="email"
                  type="email"
                  v-model="form.email"
                  placeholder="you@example.com"
                  class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                  autocomplete="email"
                  required
                />
              </div>

              <div>
                <label for="description" class="block mb-2 font-semibold text-gray-700">Your Message</label>
                <textarea
                  id="description"
                  v-model="form.description"
                  placeholder="Write your message here..."
                  rows="5"
                  class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition resize-none"
                  required
                ></textarea>
              </div>
            </div>

            <div class="mt-8">
              <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded-md font-semibold hover:bg-indigo-700 transition"
              >
                Send Message
              </button>
            </div>
          </form>
        </section>
      </div>
    </div>
  </FrontendLayout>
</template>

<script setup>
import FrontendLayout from '@/Layouts/FrontendLayout.vue'
import { useForm, usePage, router } from '@inertiajs/vue3'
import { createToaster } from '@meforma/vue-toaster'

const form = useForm({ name: '', email: '', description: '' })
const toaster = createToaster()
const page = usePage()

function submit() {
  if (!form.name.trim()) {
    toaster.error('Name is required')
    return
  }
  if (!form.email.trim()) {
    toaster.error('Email is required')
    return
  }
  if (!form.description.trim()) {
    toaster.error('Message is required')
    return
  }

  form.post('/contact', {
    onSuccess: () => {
      if (page.props.flash?.status === true) {
        toaster.success(page.props.flash.message)
        form.reset()
      } else {
        toaster.error(page.props.flash?.message || 'Failed to send message')
      }
    },
    onError: () => {
      toaster.error('Failed to send message')
    },
  })
}
</script>
