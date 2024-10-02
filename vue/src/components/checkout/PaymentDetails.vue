<template>
  <section>
    <h2 class="text-gray-700 font-semibold text-xl">Payment Details</h2>
    <div class="border-gray-300 border rounded-md p-2 mt-5">
      <div class="grid grid-cols-2">
        <button
          @click="tab = 'card'"
          class="flex flex-col justify-center items-center hover:bg-slate-50 py-4"
          :class="{
            'text-primary': tab === 'card',
            'text-gray-600 hover:text-primary': tab === 'cod'
          }"
        >
          <span><i class="fas fa-credit-card text-xl"></i></span>
          <span>Debit / Credit Card</span>
        </button>
        <button
          @click="tab = 'cod'"
          class="flex flex-col justify-center items-center hover:bg-slate-50 py-4 text-gray-600"
          :class="{
            'text-primary': tab === 'cod',
            'text-gray-600 hover:text-primary': tab === 'card'
          }"
        >
          <span><i class="fas fa-money-bill text-xl"></i></span>
          <span>Cash On Delivery</span>
        </button>
      </div>

      <!--Cash On Delivery-->
      <div v-show="tab === 'cod'">
        <div class="flex justify-between items-center mt-5 px-1">
          <div>
            <span class="font-semibold text-gray-700">Cash On Delivery</span>
          </div>
          <div>
            <span class="text-xs text-white bg-green-500 p-1">Cash</span>
          </div>
        </div>
        <div>
          <button
            @click="Cod"
            class="mt-4 block w-full bg-primary text-white text-lg font-semibold rounded-md py-1 text-center hover:bg-lime-600 transition duration-300"
          >
            PLACE ORDER
          </button>
        </div>
      </div>

      <!--Card / Stripe Payment-->
      <div v-show="tab === 'card'">
        <div class="p-1 my-5">
          <div class="col-span-4">
            <div id="card-element"></div>
            <!-- Used to display form errors -->
            <div id="card-errors" role="alert" class="mt-2">{{ card_error }}</div>
          </div>
        </div>
        <div>
          <button
            @click="Online"
            class="w-full bg-primary text-white text-lg font-semibold rounded-md py-1 text-center hover:bg-lime-600 transition duration-300"
          >
            PLACE ORDER
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { url } from '@/config'
import axios from 'axios'
import { mapState, mapActions } from 'pinia'
import { useCartStore } from '@/stores/cart'
import { paymentStore } from '@/stores/payment'
import { useRouter } from 'vue-router'

export default {
  name: 'PaymentDetails',

  setup() {
    const usePaymentStore = paymentStore()
    const router = useRouter()

    const Online = () => {
      usePaymentStore.payOnline(router)
    }
    const Cod = () => {
      usePaymentStore.payCOD(router)
    }

    return { Online, Cod };

  },
  data() {
    return {
      tab: '',
      // onlineOrderId: '',
      // stripeKey:
      //   'pk_test_51NfHq4GMlC1CV659YL1B7Uzc5nAU2zBpj6vqj3qP34lR94dIFGuPlfEcwQF04C2kEPAwBNMeh4f0bC04OpSSrhQd00Ao40DeX8',
      stripe: '',
      elements: null,
      // card: null,
      card_error: ''
    }
  },

  props: ['costDetails'],

  computed: {
    ...mapState(useCartStore, ['cart']),
    ...mapState(paymentStore, [
      'paymentIntent',
      'paymentMethod',
      'clientSecret',
      'onlineOrderId',
      'card',
      'stripeKey'
    ])
  },

  created() {
    console.log('asd', this.cart)
  },

  methods: {
    ...mapActions(paymentStore, ['storeOrderDetails']),
    // async storeOrderDetails() {
    //   const token = sessionStorage.getItem('token')

    //   if (token) {
    //     // Note that 2 means Online Payment, from backend.

    //     const response = await axios.post(
    //       `${url}/checkout/orders/store`,
    //       {
    //         payment_method: 2
    //       },
    //       {
    //         headers: {
    //           Authorization: `Bearer ${token}`
    //         }
    //       }
    //     )

    //     const data = response.data.data

    //     console.log('srype data : ', data.id)
    //     console.log('payment method : ', data.payment_method)

    //     this.paymentMethod = data.payment_method

    //     this.onlineOrderId = data.id
    //     this.mountingStripe()
    //   }
    // },

    ...mapActions(paymentStore, ['mountingStripe']),

    // mountingStripe() {
    //   if (window.Stripe) {
    //     this.stripe = Stripe(this.stripeKey)

    //     this.elements = this.stripe.elements()

    //     this.card = this.elements.create('card', {
    //       hidePostalCode: true
    //     })

    //     this.card.on('change', (event) => {
    //       console.log(event)
    //       if (event.error) {
    //         this.card_error = event.error.message
    //       } else {
    //         this.card_error = ''
    //       }
    //     })

    //     this.card.mount('#card-element')
    //   }
    // },

    ...mapActions(paymentStore, ['payOnline']),
    // async payOnline() {
    //   try {
    //     const token = sessionStorage.getItem('token')

    //     if (token) {
    //       const response = await axios.post(
    //         `${url}/checkout/orders/stripe-payment/${this.onlineOrderId}`,
    //         {
    //           token
    //         }
    //       )
    //       const clientSecret = response.data.data.client_secret
    //       this.paymentIntent = response.data.data.payment_intent

    //       console.log('clientsecret: ', clientSecret)

    //       console.log('paymentIntent : ', this.paymentIntent)

    //       const data = await this.stripe.confirmCardPayment(clientSecret, {
    //         payment_method: {
    //           card: this.card
    //         }
    //       })

    //       if (data.error) {
    //         this.card_error = data.error.message
    //       } else {
    //         // Payment successful logic (if needed)
    //         this.$router.push(`/order-placement/${this.onlineOrderId}`)
    //       }
    //     }
    //   } catch (error) {
    //     console.log(error)
    //     this.card_error = 'An error occurred while processing your payment. Please try again later.'
    //   }
    // },

    ...mapActions(paymentStore, ['payCOD'])
    // async payCOD() {
    //   try {
    //     const token = sessionStorage.getItem('token')

    //     if (token) {
    //       const response = await axios.post(
    //         `${url}/checkout/orders/store`,
    //         {
    //           payment_method: 1
    //         },
    //         {
    //           headers: {
    //             Authorization: `Bearer ${token}`
    //           }
    //         }
    //       )

    //       const data = response.data.data
    //       console.log(data)

    //       //Navigating to Order Placement Route
    //       this.onlineOrderId = data.id
    //       this.$router.push(`/order-placement/${this.onlineOrderId}`)
    //     }
    //   } catch (error) {
    //     console.log(error)
    //   }
    // }
  },

  watch: {
    tab: function (newTab, oldTab) {
      if (newTab === 'card') {
        this.storeOrderDetails()
      }
      this.$emit('tabChanged', newTab)
    }
  }
}
</script>

<style scoped>
#card-errors {
  color: #fa755a;
}
</style>
