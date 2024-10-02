<template>
  <Dialog :open="isOpen" @close="closeDialog" class="relative z-50">
    <div class="fixed inset-0 bg-black/30" aria-hidden="true" />
    <div class="fixed inset-0 flex w-screen items-center justify-center p-4opacity-10">
      <DialogPanel class="w-full shadow-md max-w-sm rounded bg-white p-4">
        <transition name="fade" mode="out-in">
          <div
            v-if="show_alert"
            class="text-center bg-green-500 p-4 mb-4 text-white rounded-md font-bold"
            :class="alert_variant"
          >
            {{ alert_message }}
          </div>
        </transition>

        <DialogTitle class="text-gray-700 text-xl font-semibold border-b border-gray-200 pb-2 mb-2"
          >Change Password</DialogTitle
        >
        <div class="flex flex-col gap-1 border-b border-gray-200 pb-4">
          <vee-form @submit="handleChangePassword" :validation-schema="validationSchema">
            <div class="mb-3">
              <label for="old_password" class="block mb-2 text-sm font-medium text-gray-600"
                >Current Password</label
              >
              <vee-field
                name="old_password"
                type="password"
                id="old_password"
                class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
                placeholder="********"
                required
              />
              <ErrorMessage class="text-red-600" name="old_password" />
            </div>
            <div class="mb-3">
              <label for="new_password" class="block mb-2 text-sm font-medium text-gray-600"
                >New Password</label
              >
              <vee-field
                name="new_password"
                type="password"
                id="new_password"
                class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
                placeholder="********"
                required
              />
              <ErrorMessage class="text-red-600" name="new_password" />
            </div>
            <div class="mb-3">
              <label
                for="new_password_confirmation"
                class="block mb-2 text-sm font-medium text-gray-600"
                >Confirm New Password</label
              >
              <vee-field
                name="new_password_confirmation"
                type="password"
                id="new_password_confirmation"
                class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
                placeholder="********"
                required
              />
              <ErrorMessage class="text-red-600" name="new_password_confirmation" />
            </div>
            <button
              :disabled="form_in_submission"
              type="submit"
              class="bg-primary text-white hover:bg-lime-600 transition duration-300 w-full text-center font-semibold p-2 rounded-md mt-4"
            >
              Submit Change
            </button>
          </vee-form>
        </div>
        <button
          class="text-primary border-primary border-2 hover:bg-lime-600 hover:text-white transition duration-300 w-full text-center font-semibold p-2 rounded-md"
          @click="closeDialog"
        >
          Cancel
        </button>
      </DialogPanel>
    </div>
  </Dialog>
</template>

<script setup>
import { Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import { ref } from 'vue'
import axios from 'axios'
import { url } from '@/config'

const validationSchema = {
  old_password: 'required|min:8|max:100',
  new_password: 'required|min:8|max:100',
  new_password_confirmation: 'passwords_mismatch:@new_password'
}

const form_in_submission = ref(false)
const show_alert = ref(false)
const alert_message = ref('')
const alert_variant = ref('')

const isOpen = defineProps(['isOpen'])
const emit = defineEmits()

function closeDialog() {
  emit('close', false)
}

async function handleChangePassword(values) {
  form_in_submission.value = true
  show_alert.value = true
  alert_message.value = 'Please wait, form is in submission.'
  alert_variant.value = 'bg-blue-600'

  const token = sessionStorage.getItem('token')
  if (token) {
    try {
      const response = await axios.post(`${url}/details/password/change`, values, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      })
      console.log(response)
    } catch (error) {
      form_in_submission.value = false
      alert_message.value = error.response.data.message
      alert_variant.value = 'bg-red-600'
      setTimeout(() => {
        show_alert.value = false
      }, 3000)
      return
    }
  }
  form_in_submission.value = false
  alert_message.value = 'Password changed successfully!'
  alert_variant.value = 'bg-green-600'

  setTimeout(() => {
    show_alert.value = false
    closeDialog()
  }, 1000)
}
</script>

<style scoped>
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
.fade-enter-active,
.fade-leave-active {
  transition: all 0.5s;
}
</style>
