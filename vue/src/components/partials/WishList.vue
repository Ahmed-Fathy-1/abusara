<template>
  <TransitionRoot as="template" :show="wishlistOpened">
    <Dialog as="div" class="relative z-10" @close="toggleWishlist">
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

      <div v-show="wishlistOpened" class="fixed inset-0 overflow-hidden">
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
                      <DialogTitle class="text-lg font-medium text-gray-900">Wishlist</DialogTitle>
                      <div class="ml-3 flex h-7 items-center">
                        <button
                          type="button"
                          class="relative -m-2 p-2 text-gray-400 hover:text-gray-500 outline-none"
                          @click="toggleWishlist"
                        >
                          <span class="absolute -inset-0.5" />
                          <span class="sr-only">Close panel</span>
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>

                    <div v-if="wishlistLength > 0" class="mt-8">
                      <div class="flow-root">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                          <li v-for="item in wishlist" :key="item.product.id" class="flex py-6">
                            <div
                              class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200"
                            >
                              <RouterLink :to="`/product/${item.product.id}`">
                                <img
                                  :src="item.product.images[0]"
                                  :alt="item.product.name"
                                  class="h-full w-full object-contain object-center"
                                />
                              </RouterLink>
                            </div>

                            <div class="ml-4 flex flex-1 flex-col">
                              <div>
                                <div
                                  class="flex justify-between text-base font-medium text-gray-900"
                                >
                                  <h3>
                                    <RouterLink :to="`/product/$${item.product.id}`">{{
                                      item.product.name
                                    }}</RouterLink>
                                  </h3>
                                  <p class="ml-4 whitespace-nowrap">{{ item.product.prices[0].price }} AUD</p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">
                                  {{ item.product.category_id.name }}
                                </p>
                              </div>
                              <div class="flex justify-end">
                                <button
                                  @click="removeFromWishlist(item.product.id)"
                                  type="button"
                                  class="font-medium text-red-600 hover:text-red-500"
                                >
                                  Remove
                                </button>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>

                    <div
                      class="mt-8 text-center text-gray-600 flex flex-col justify-center items-center gap-4"
                      v-else
                    >
                      <img width="150px" src="/wishlist.png" alt="" />
                      <p class="text-xl font-bold text-wrap over">Your Wishlist looks empty!</p>
                      <p class="text-lg">What are you waiting for?</p>
                      <button
                        @click="toggleWishlist"
                        class="text-white bg-primary p-2 hover:bg-lime-600 transition duration-300 font-semibold rounded-md"
                      >
                        Start Shopping
                      </button>
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
import { useCartStore } from '@/stores/cart'
const cart = useCartStore()
</script>

<script>
import { useWishlistStore } from '@/stores/wishlist'
import { mapState, mapActions } from 'pinia'
export default {
  computed: {
    ...mapState(useWishlistStore, ['wishlistOpened', 'wishlist', 'wishlistLength'])
  },
  methods: {
    ...mapActions(useWishlistStore, ['toggleWishlist', 'loadWishlist', 'removeFromWishlist'])
  },

  async mounted() {
    await this.loadWishlist()
  }
}
</script>
