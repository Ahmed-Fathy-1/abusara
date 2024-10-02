<template>
  <TransitionRoot as="template" :show="cartStore.isOpen">
    <Dialog as="div" class="relative z-10" @close="cartStore.toggleCart">
      <TransitionChild
        as="template"
        enter="ease-in-out duration-500"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in-out duration-500"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div v-show="cartStore.isOpen" class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
          <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <TransitionChild
              as="template"
              enter="transform transition ease-in-out duration-500 sm:duration-700"
              enter-from="translate-x-full"
              enter-to="translate-x-0"
              leave="transform transition ease-in-out duration-500 sm:duration-700"
              leave-from="translate-x-0"
              leave-to="translate-x-full"
            >
              <DialogPanel class="pointer-events-auto w-screen max-w-md">
                <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                  <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                    <div class="flex items-start justify-between">
                      <DialogTitle class="text-lg font-medium text-gray-900"
                        >Shopping cart</DialogTitle
                      >
                      <div class="ml-3 flex h-7 items-center">
                        <button
                          type="button"
                          class="relative -m-2 p-2 text-gray-400 hover:text-gray-500 outline-none"
                          @click="cartStore.toggleCart"
                        >
                          <span class="absolute -inset-0.5" />
                          <span class="sr-only">Close panel</span>
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>

                    <div v-if="cartStore.cartLength > 0" class="mt-8">
                      <div class="flow-root">
                        <!-- Loop through cart -->
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                          <template v-for="item in cartStore.cartItems" :key="item.product_id.id">
                            <CartItems :item="item" />
                          </template>
                        </ul>
                      </div>
                    </div>
                    <div
                      v-else
                      class="mt-8 text-center text-gray-600 flex flex-col justify-center items-center gap-4"
                    >
                      <img width="150px" src="@/assets/images/cart/empty-cart.svg" alt="" />
                      <p class="text-xl font-bold text-wrap over">
                        Your Shopping Cart looks empty!
                      </p>
                      <p class="text-lg">What are you waiting for?</p>
                      <button
                        @click="cartStore.toggleCart"
                        class="text-white bg-primary p-2 hover:bg-lime-600 transition duration-300 font-semibold rounded-md"
                      >
                        Start Shopping
                      </button>
                    </div>
                  </div>

                  <div
                    v-if="cartStore.cartLength > 0"
                    class="border-t border-gray-200 px-4 py-6 sm:px-6"
                  >
                    <div class="flex justify-between text-base font-medium text-gray-900">
                      <p>Subtotal</p>
                      <p v-if="cartStore.cart.subtotal_price">
                        {{ cartStore.cart.total_cost }} AUD
                      </p>
                      <p class="text-gray-600 text-xs font-thin" v-else>
                        Will be calculated after logging in
                      </p>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">
                      Shipping and taxes calculated at checkout.
                    </p>
                    <div class="mt-6">
                      <button
                        @click.prevent="handleCheckout"
                        class="flex items-center justify-center rounded-md border border-transparent bg-primary px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-lime-600 w-full"
                      >
                        Checkout
                      </button>
                    </div>
                    <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                      <p>
                        or
                        <button
                          type="button"
                          class="font-medium text-primary hover:text-lime-600"
                          @click="cartStore.toggleCart"
                        >
                          Continue Shopping
                          <span aria-hidden="true"> &rarr;</span>
                        </button>
                      </p>
                    </div>
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { onMounted, ref, watch, watchEffect } from 'vue'
import { useRouter } from 'vue-router'
const router = useRouter()

import { useCartStore } from '@/stores/cart'
import useAuthModalStore from '@/stores/authModal'
import CartItems from './CartItems.vue'

const cartStore = useCartStore()
const authModalStore = useAuthModalStore()

function handleCheckout() {
  const token = sessionStorage.getItem('token')
  if (token) {
    router.push('/checkout')
    cartStore.toggleCart()
  } else {
    cartStore.toggleCart()
    authModalStore.isOpen = true
  }
}

onMounted(() => {
  console.log(cartStore.cartItems)
})
</script>
