<template>
  <section>
    <h2 class="text-gray-700 font-semibold text-xl">Order Summary</h2>
    <div class="border-gray-300 border rounded-md p-2 mt-5 mb-2">
      <h3 class="text-gray-700 font-medium mb-2">Order Details</h3>
      <div class="flex justify-between text-gray-600 text-sm pb-1">
        <p>Sub total</p>
        <p>{{ cart.total_cost }} AUD</p>
      </div>

      <div v-if="cart.discount" class="flex justify-between text-gray-600 text-sm">
        <p>Discount</p>
        <p class="text-primary">-{{ cart.discount }} AUD</p>
      </div>

      <hr class="border-gray-300 opacity-40 border-1 my-2" />

      <div class="flex justify-between">
        <h4 class="text-sm">Total</h4>

        <p class="font-semibold">{{ cart.subtotal_price }} AUD</p>
      </div>
    </div>
    <div class="flex items-center justify-between gap-2 mb-5">
      <div>
        <input
          type="text"
          id="first_name"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-lime-600 focus:border-primary focus:outline-primary inline w-full p-2"
          placeholder="Discount Coupon"
          required
          v-model="coupon.coupon"
        />
        <p class="text-red-600 text-xs ps-1">{{ couponErrMsg }}</p>
      </div>
      <div>
        <button
          @click="handleCoupone"
          class="text-white bg-primary p-2 rounded-md text-center text-sm"
        >
          Apply
        </button>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from 'pinia'
import { useCartStore } from '@/stores/cart'
import axios from 'axios'
import { url } from '@/config'
export default {
  name: 'OrderSummary',
  props: ['costDetails', 'selectedPayment'],

  data() {
    return {
      coupon: {
        coupon: null
      },
      couponErrMsg: null
    }
  },

  mounted() {
    console.log(this.cart)
  },

  methods: {
    handleCoupone() {
      const token = sessionStorage.getItem('token')

      // console.log(this.coupon.coupon)

      axios
        .post(`${url}/checkout/coupon/enter`, this.coupon, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        .then((response) => {
          // console.log(response)
        })
        .catch((error) => {
          this.couponErrMsg = error.response.data.message
        })
    }
  },

  computed: {
    ...mapState(useCartStore, ['cart'])
  }
}
</script>
