<template>
  <li class="flex py-6">
    <router-link @click.prevent="toggleCart" :to="`/products/${item.product_id.id}`">
      <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
        <img
          :src="item.product_id?.images[0]"
          alt="...."
          class="h-full w-full object-contain object-center"
        />
      </div>
    </router-link>

    <div class="ml-4 flex flex-1 flex-col">
      <div>
        <div class="flex justify-between text-base font-medium text-gray-900">
          <h3>
            <RouterLink @click.prevent="toggleCart" :to="`/product/${item.product_id.id}`">{{
              item.product_id.name
            }}</RouterLink>
          </h3>
          <p v-if="item.price" class="ml-4 whitespace-nowrap">{{ item.price }} AUD</p>
        </div>
        <p class="mt-1 text-sm text-gray-500">
          {{ item.product_id.category_id.name }}
        </p>
      </div>

      <!-- test update quantity -->
      <!-- <div class="relative flex flex-row w-full h-10 bg-transparent rounded-lg">
        <button
          @click="decrementQuantity"
          class="w-20 h-full text-gray-600 bg-gray-100 border-r rounded-l outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-300"
        >
          <span class="m-auto text-2xl font-thin">-</span>
        </button>
        <input
          min="1"
          type="number"
          class="flex items-center w-full justify-center font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-100 outline-none focus:outline-none text-md hover:text-black"
          v-model="quantity"
        />
        <button
          @click="incrementQuantity"
          class="w-20 h-full text-gray-600 bg-gray-100 border-l rounded-r outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-300"
        >
          <span class="m-auto text-2xl font-thin">+</span>
        </button>
      </div> -->
      <!-- /test update quantity -->

      <div class="flex flex-1 items-center justify-between text-sm">
        <div class="flex justify-end items-center gap-4">
          <p class="text-gray-500">Qty {{ item.quantity }}</p>
          <!-- <div class="flex gap-1">
            <button
              @click="incrementQuantity"
              class="w-8 text-gray-600 bg-gray-200 transition rounded outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-300"
            >
              <span class="m-auto text-2xl font-thi">+</span>
            </button>
            <button
              @click="decrementQuantity"
              class="w-8 text-gray-600 bg-gray-200 transition rounded outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-300"
            >
              <span class="m-auto text-2xl font-thi">-</span>
            </button>
          </div> -->
        </div>
        <div class="flex">
          <button
            @click="removeItemFromCart(item ,item.product_id.id, item.unit_id)"
            type="button"
            class="font-medium text-red-600 hover:text-red-500"
          >
            Remove
          </button>
        </div>
      </div>
    </div>
  </li>
</template>

<script>
import { useAuthStore } from '@/stores/auth'
import { useCartStore } from '@/stores/cart'
// import {UnitsStore} from "@/stores/units"
import { mapActions, mapState } from 'pinia'

export default {
  inject: ['Emitter'],
  data() {
    return {
      quantity: '',
      weigth: 'Kilo'
    }
  },

  props: ['item'],

  mounted() {
    console.log('itemm', this.item.quantity)
  },

  computed: {
    ...mapState(useCartStore, ['cart', 'cartItems'])
    // ...mapState(UnitsStore,["weigth"])
  },

  methods: {
    incrementQuantity() {
      this.quantity++
      this.updateBackendQuantity()
    },

    // start new function to remove from cart
    removeItemFromCart(product, id, unit) {
      this.removeFromCart(id, unit)
      product.quantity =1;
      setTimeout(() => {
        this.Emitter.emit('showDeletedMsg', `prodcut ${id}`)
      }, 1000)
    },
    // end new function to remove from cart

    decrementQuantity() {
      if (this.quantity > 0) {
        this.quantity--
        this.updateBackendQuantity()
      }
    },

    updateBackendQuantity() {
      const product_id = this.item.product_id.id
      this.updateQuantity(product_id, this.quantity)
    },

    watchQuantity() {
      this.quantity = this.item.quantity
    },

    ...mapActions(useCartStore, ['toggleCart', 'updateQuantity', 'removeFromCart'])
  },

  watch: {
    cartItems: {
      immediate: true,
      handler: 'watchQuantity',
      deep: true
    }
  }
}
</script>
