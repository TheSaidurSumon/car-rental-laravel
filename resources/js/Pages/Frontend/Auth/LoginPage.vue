<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
      <form @submit.prevent="submit" novalidate>
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Sign In</h2>

        <div class="mb-5">
          <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
          <input
            id="email"
            v-model="form.email"
            type="email"
            placeholder="Enter your email"
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
            required
            autocomplete="email"
          />
        </div>

        <div class="mb-6">
          <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
          <input
            id="password"
            v-model="form.password"
            type="password"
            placeholder="Enter your password"
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
            required
            autocomplete="current-password"
          />
        </div>

        <button
          type="submit"
          class="w-full bg-indigo-600 text-white py-3 rounded-md font-semibold hover:bg-indigo-700 transition"
        >
          Login
        </button>

        <p class="mt-6 text-center text-gray-600 text-sm">
          Don't have an account?
          <Link href="/register" class="text-indigo-600 font-semibold hover:underline ml-1">Sign Up</Link>
        </p>

        <p class="mt-2 text-center text-gray-600 text-sm">
          Back To
          <Link href="/" class="text-indigo-600 font-semibold hover:underline ml-1">Home</Link>
        </p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm, usePage, router, Link } from '@inertiajs/vue3'
import { createToaster } from '@meforma/vue-toaster'

const toaster = createToaster()

const form = useForm({
  email: '',
  password: ''
})

const page = usePage()

if (page.props.share_data) {
  toaster.error(page.props.share_data)
}

function submit() {
  if (!form.email) {
    toaster.error('Email is required')
    return
  }
  if (!form.password) {
    toaster.error('Password is required')
    return
  }

  form.post('/login', {
    onSuccess: () => {
      if (page.props.flash?.status) {
        toaster.success(page.props.flash.message)
      } else {
        toaster.error(page.props.flash?.message || 'Login failed')
      }
    },
    onError: () => {
      toaster.error('Invalid email or password')
    }
  })
}
</script>
