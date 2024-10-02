<template>
  <Dialog :open="isOpen" @close="closeDialog" class="relative z-50">
    <div class="fixed inset-0 bg-black/30" aria-hidden="true" />
    <div class="fixed inset-0 flex w-screen items-center justify-center p-4opacity-10">
      <DialogPanel class="w-full shadow-md max-w-sm rounded bg-white p-4">
        <DialogTitle class="text-gray-700 text-xl font-semibold border-b border-gray-200 pb-2 mb-2"
          >Deactivate account</DialogTitle
        >
        <DialogDescription class="text-red-500 mb-1"
          >NOTE that his will permanently deactivate your account</DialogDescription
        >

        <p class="text-gray-400 mb-4 text-balance text-sm w-full">
          Are you sure you want to deactivate your account? All of your data will be permanently
          removed. This action cannot be undone.
        </p>

        <button
          class="bg-primary hover:bg-lime-600 text-white text-sm py-1 px-2 mr-4 rounded-md"
          @click="closeDialog"
        >
          Cancel
        </button>
        <button class="text-red-500 hover:text-red-400" @click="handleDeactivate">
          Deactivate
        </button>
      </DialogPanel>
    </div>
  </Dialog>
</template>

<script setup>
import { Dialog, DialogPanel, DialogTitle, DialogDescription } from '@headlessui/vue'

const isOpen = defineProps(['isOpen'])
const emit = defineEmits()

function closeDialog() {
  emit('close', false)
}

function handleDeactivate() {
  // ...
}
</script>
