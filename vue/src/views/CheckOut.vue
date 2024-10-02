<template>
  <section class="container my-5 bg-white p-5">
    <div class="grid lg:grid-cols-12 gap-10">
      <div class="lg:col-span-8">
        <ShippingAddress
          :selectedAddress="selectedAddress"
          @address-selected="handleSelectedAddress"
        />

        <OrdersList :cartItems="cartItems" />

        <PaymentDetails @tabChanged="handleTabChange" />
      </div>
      <div class="lg:col-span-4">
        <OrderSummary :costDetails="costDetails" :selectedPayment="selectedPayment" />
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios'
import { url } from '@/config'

import { useCartStore } from '@/stores/cart'
import { mapState } from 'pinia'

import OrderSummary from '@/components/checkout/OrderSummary.vue'
import OrdersList from '@/components/checkout/OrdersList.vue'
import PaymentDetails from '@/components/checkout/PaymentDetails.vue'
import ShippingAddress from '@/components/checkout/ShippingAddress.vue'
// import DeliveryMethod from '@/components/checkout/DeliveryMethod.vue'

export default {
  name: 'CheckOut',
  data() {
    return {
      selectedAddress: '',
      // costDetails: '',
      // shippingMethods: [],
      selectedMethod: null,
      selectedPayment: null,
      stripe: ''
    }
  },

  components: {
    OrderSummary,
    ShippingAddress,
    PaymentDetails,
    OrdersList
    // DeliveryMethod
  },

  computed: {
    ...mapState(useCartStore, ['cartItems'])
  },

  methods: {
    // async handleMethodSelected(methodCode) {
    //   const token = sessionStorage.getItem('token')

    //   if ((token, methodCode)) {
    //     try {
    //       const response = await axios.post(
    //         `${url}/checkout/delivery/cost`,
    //         {
    //           code: methodCode
    //         },
    //         {
    //           headers: {
    //             Authorization: `Bearer ${token}`
    //           }
    //         }
    //       )
    //       this.costDetails = response.data.data
    //       console.log('cost details', this.costDetails)
    //     } catch (error) {
    //       console.log(error)
    //     }
    //   }
    //   console.log(methodCode)
    // },

    // async fetchMethods() {
    //   const token = sessionStorage.getItem('token')
    //   if (token) {
    //     try {
    //       const response = await axios.get(`${url}/checkout/delivery`, {
    //         headers: {
    //           Authorization: `Bearer ${token}`
    //         }
    //       })

    //       this.shippingMethods = response.data.data
    //     } catch (error) {
    //       console.error(error)
    //     }
    //   }
    // },

    async handleSelectedAddress(selectedAddress) {
      this.selectedAddress = selectedAddress

      if (selectedAddress) {
        await this.SyncSelectedAddress(selectedAddress)
        // await this.fetchMethods()
      }
      // console.log(this.selectedAddress)
    },

    async SyncSelectedAddress(selectedAddress) {
      const token = sessionStorage.getItem('token')

      const id = selectedAddress.id

      if (token) {
        try {
          const response = await axios.post(`${url}/checkout/address/select/${id}`, {
            token
          })
          // console.log('Sync Address' + response.data.data)
        } catch (error) {
          console.log(error)
        }
      }
    },

    handleTabChange(value) {
      this.selectedPayment = value
      console.log(value)
    }
  }
}
</script>
