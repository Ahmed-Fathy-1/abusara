import { defineStore } from 'pinia'
import { url } from '@/config'
import axios from 'axios'
import { useCartStore } from './cart'

export const paymentStore = defineStore('paymentStore', {
  state: () => ({
    paymentIntent: '',
    paymentMethod: '',
    clientSecret: '',
    onlineOrderId: '',
    card: null,
    stripeKey:
      'pk_test_51NfHq4GMlC1CV659YL1B7Uzc5nAU2zBpj6vqj3qP34lR94dIFGuPlfEcwQF04C2kEPAwBNMeh4f0bC04OpSSrhQd00Ao40DeX8'
  }),

  actions: {
    async storeOrderDetails() {
      const token = sessionStorage.getItem('token')

      if (token) {
        // Note that 2 means Online Payment, from backend.

        const response = await axios.post(
          `${url}/checkout/orders/store`,
          {
            payment_method: 2
          },
          {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }
        )

        const data = response.data.data

        console.log('srype data : ', data.id)
        console.log('payment method : ', data.payment_method)

        this.paymentMethod = data.payment_method

        this.onlineOrderId = data.id
        this.mountingStripe()
      }
    },

    mountingStripe() {
      if (window.Stripe) {
        this.stripe = Stripe(this.stripeKey)

        this.elements = this.stripe.elements()

        this.card = this.elements.create('card', {
          hidePostalCode: true
        })

        this.card.on('change', (event) => {
          console.log(event)
          if (event.error) {
            this.card_error = event.error.message
          } else {
            this.card_error = ''
          }
        })

        this.card.mount('#card-element')
      }
    },

    async payOnline(router) {
      try {
        const token = sessionStorage.getItem('token')

        if (token) {
          const response = await axios.post(
            `${url}/checkout/orders/stripe-payment/${this.onlineOrderId}`,
            {
              token
            }
          )
          this.clientSecret = response.data.data.client_secret
          this.paymentIntent = response.data.data.payment_intent

          console.log('clientsecret: ', this.clientSecret)

          console.log('paymentIntent : ', this.paymentIntent)

          const data = await this.stripe.confirmCardPayment(this.clientSecret, {
            payment_method: {
              card: this.card
            }
          })

          if (data.error) {
            this.card_error = data.error.message
          } else {
            const cartStore = useCartStore()
            // const router = useRouter()
            // Payment successful logic (if needed)
            router.push(`/order-placement/${this.onlineOrderId}`)
            cartStore.loadCart()
          }
        }
      } catch (error) {
        console.log(error)
        this.card_error = 'An error occurred while processing your payment. Please try again later.'
      }
    },

    async payCOD(router) {
      try {
        const token = sessionStorage.getItem('token')

        if (token) {
          const response = await axios.post(
            `${url}/checkout/orders/store`,
            {
              payment_method: 1
            },
            {
              headers: {
                Authorization: `Bearer ${token}`
              }
            }
          )

          const data = response.data.data
          console.log(data)

          //Navigating to Order Placement Route
          this.onlineOrderId = data.id
          router.push(`/order-placement/${this.onlineOrderId}`)
        }
      } catch (error) {
        console.log(error)
      }
    }
  }
})
