<template>
  <main class="container bg-white my-5 rounded-md p-5">
    <section class="flex justify-between items-center">
      <div>
        <h1 class="text-lg lg:text-2xl font-semibold text-gray-700">
          Your Order Was Successfully Placed
        </h1>
        <div class="flex gap-4 mt-4">
          <router-link to="/my-orders">
            <button
              class="border-primary border-2 rounded-md py-1 px-2 text-gray-600 hover:bg-primary hover:text-gray-50 transition duration-300"
            >
              See All Orders
            </button>
          </router-link>

          <router-link to="/">
            <button class="text-gray-600 hover:text-primary transition duration-300">
              Continue Shopping
            </button>
          </router-link>
        </div>
      </div>

      <div class="hidden lg:block">
        <img src="/Order.png" class="object-cover max-w-56" alt="" />
      </div>
    </section>

    <section class="my-5">
      <h2 class="font-semibold text-lg text-gray-700">Delivery to</h2>
      <div class="flex mt-2 p-2 border-gray-300 border rounded-md gap-5 items-center">
        <div>
          <svg
            fill="gray"
            width="20"
            height="30"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 384 512"
          >
            <path
              d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"
            />
          </svg>
        </div>
        <div class="flex flex-col gap-1">
          <p class="text-gray-500 font-medium">{{ user.name }}</p>

          <p class="text-gray-600 font-medium">
            {{ orderSummary.address?.details }}, {{ orderSummary.address?.state }},
            {{ orderSummary.address?.city }}
          </p>

          <p class="text-gray-500 font-medium">{{ orderSummary.address?.post_code }}</p>
          <p class="text-gray-500 font-medium">{{ user.mobile }}</p>
        </div>
      </div>
    </section>

    <section class="my-5">
      <h2 class="font-semibold text-lg text-gray-700">Delivery details</h2>
      <div class="flex mt-2 p-2 border-gray-300 border rounded-md gap-5 items-center">
        <div>
          <svg
            fill="gray"
            width="20"
            height="30"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 512"
          >
            <path
              d="M112 0C85.5 0 64 21.5 64 48V96H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 272c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 48c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 240c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 208c8.8 0 16 7.2 16 16s-7.2 16-16 16H64V416c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H112zM544 237.3V256H416V160h50.7L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"
            />
          </svg>
        </div>

        <div class="flex flex-col gap-1">
          <p class="text-gray-600 font-semibold">
            Delivery Status:
            <span class="font-normal" v-if="orderSummary.delivery_status == 1">In Progress</span>
            <span class="font-normal" v-if="orderSummary.delivery_status == 2">Is Shipping</span>
            <span class="font-normal" v-if="orderSummary.delivery_status == 3">Dilevered</span>
          </p>

          <p class="text-gray-600 font-semibold">
            Payment Method:
            <span class="font-normal" v-if="orderSummary.payment_method == 1"
              >Cash On Delivery</span
            >
            <span class="font-normal" v-if="orderSummary.payment_method == 2">Online Payment</span>
          </p>
          <!-- <p class="text-gray-600 font-medium">Shipping Fees: {{ orderSummary.shipping_cost }}</p> -->
          <p class="text-primary font-bold mt-2 text-lg">Total: {{ orderSummary.total }}</p>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import { useCartStore } from '@/stores/cart'
import axios from 'axios'
import { url } from '@/config'
import { mapActions } from 'pinia'
import { paymentStore } from '@/stores/payment'
import { mapState } from 'pinia'

export default {
  name: 'OrderPlacement',

  data() {
    return {
      orderSummary: {},
      user: ''
    }
  },
  computed: {
    ...mapState(paymentStore, ['paymentIntent', 'paymentMethod'])
  },

  created() {
    this.fetchOrderSummary()
    this.loadCart()

    this.user = JSON.parse(sessionStorage.getItem('user'))
  },

  methods: {
    async fetchOrderSummary() {
      const token = sessionStorage.getItem('token')

      if (token) {
        try {
          const orderId = this.$route.params.id
          console.log('orderid:', orderId)
          const response = await axios.get(
            `${url}/checkout/orders/summery/${orderId}?payment_intent=${this.paymentIntent}`,
            {
              headers: {
                Authorization: `Bearer ${token}`
              }
            }
          )

          this.orderSummary = response.data.data
        } catch (error) {
          console.log(error)
        }
      }
    },

    ...mapActions(useCartStore, ['loadCart'])
  }
}
</script>
