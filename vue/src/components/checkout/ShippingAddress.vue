<template>
  <section class="mb-5">
    <h2 class="text-gray-700 font-semibold text-xl">Shipping Address</h2>

    <div
      v-if="currentAddresses.length === 0"
      class="flex flex-col flex-start lg:flex-row lg:justify-between lg:items-center"
    >
      <p class="text-gray-600">You don't have a current stored address!</p>
      <button @click="showForm = true" class="text-primary text-start hover:text-lime-600">
        Add a new one
      </button>
    </div>

    <!--Current Addresses-->
    <div class="border-gray-300 border rounded-md p-2 mt-5" v-if="currentAddresses.length > 0">
      <h3 class="pl-0 p-3 text-lg font-semibold text-gray-600">Please Select Your Address</h3>
      <div
        v-for="address in currentAddresses"
        :key="address.id"
        class="border border-l-4 border-l-primary rounded-md border-gray-200 p-2 flex gap-4 mb-3"
        :class="[
          {
            'border-primary': address.id === selectedAddressId,
            'opacity-70': address.id !== selectedAddressId
          }
        ]"
      >
        <input
          type="radio"
          :value="address.id"
          v-model="selectedAddressId"
          name="current_address"
          @change="saveSelectedAddress"
        />
        <label :for="address.id">
          <p>
            <span class="text-primary text font-semibold p-3">Name:</span>
            {{ user?.name }}
          </p>
          <p>
            <span class="text-primary text font-semibold p-3">Address:</span>
            {{ address.details }}, {{ address.city }}, {{ address.state }}
          </p>
          <p>
            <span class="text-primary text font-semibold p-3">Postal Code:</span>
            {{ address.post_code }}
          </p>
          <p><span class="text-primary text font-semibold p-3">Contact:</span> {{ user.mobile }}</p>
          <!-- <p>
            <span class="text-primary text-lg font-semibold p-3">State:</span> {{ address.state }}
          </p>
          <p>
            <span class="text-primary text-lg font-semibold p-3">City:</span> {{ address.city }}
          </p> -->
        </label>
      </div>
      <div class="flex">
        <button
          class="mt-4 text-primary hover:text-lime-600 transition duration-300 text-end"
          @click="showForm = !showForm"
        >
          <span v-show="showForm === false">Add a new address</span>
        </button>
      </div>
    </div>

    <!--Adding new address-->
    <div v-show="showForm" class="border-gray-300 border rounded-md p-2 mt-5">
      <div class="flex items-start justify-between border-b pb-4">
        <h3 class="pl-0 p-3 text-lg font-semibold text-gray-600">Please Enter Your Address</h3>
        <button
          class="mt-4 text-primary hover:text-lime-600 transition duration-300 text-end"
          @click="showForm = !showForm"
        >
          <span
            class="bg-slate-100 p-2 rounded font-semibold text-red-600 text-lg hover:bg-slate-200 transition"
            >Cancel</span
          >
        </button>
      </div>
      <vee-form @submit="submitAddress" :validation-schema="addressSchema">
        <div class="grid gap-6 mb-6 md:grid-cols-2 p-1">
          <!--Street Address-->
          <div class="col-span-2">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-600"
              >Street Address</label
            >
            <vee-field
              name="address"
              type="text"
              id="address"
              class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
              placeholder="Address"
              required
            />
            <ErrorMessage class="text-red-600" name="address" />
          </div>

          <!--State-->
          <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-600" for="state">State</label>
            <vee-field
              as="select"
              class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
              name="state"
              id="state"
            >
              <option
                v-for="state in states"
                :key="state.name"
                :value="state.code"
                class="capitalize"
              >
                {{ state.name }}
              </option>
            </vee-field>
            <ErrorMessage class="text-red-600" name="state" />
          </div>

          <!--City-->
          <div class="col-span-2 lg:col-span-1">
            <label class="block mb-2 text-sm font-medium text-gray-600" for="city">City</label>
            <vee-field
              class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
              name="city"
              type="text"
              placeholder="Enter a city"
            />
            <ErrorMessage class="text-red-600" name="city" />
          </div>

          <!--Postal Code-->
          <div class="col-span-2 lg:col-span-1">
            <label class="block mb-2 text-sm font-medium text-gray-600" for="post_code"
              >Postal Code</label
            >
            <vee-field
              class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
              min="1"
              type="number"
              name="post_code"
              placeholder="Enter a Postal Code"
            />
            <ErrorMessage class="text-red-600" name="post_code" />
          </div>

          <div>
            <button
              type="submit"
              class="bg-primary text-white text-center p-2 rounded-md text-sm hover:bg-lime-600 transition duration-300"
            >
              Submit Address
            </button>
          </div>
        </div>
      </vee-form>
    </div>
  </section>
</template>

<script>
import axios from 'axios'
import { url } from '@/config'
export default {
  name: 'ShippingAddress',

  props: ['selectedAddress'],

  data() {
    return {
      states: [
        { name: 'New South Wales', code: 'NSW' },
        { name: 'Victoria', code: 'VIC' },
        { name: 'Queensland', code: 'QLD' },
        { name: 'South Australia', code: 'SA' },
        { name: 'Western Australia', code: 'WA' },
        { name: 'Tasmania', code: 'TAS' },
        { name: 'Australian Capital Territory', code: 'ACT' },
        { name: 'Northern Territory', code: 'NT' }
      ],

      showForm: false,

      addressSchema: {
        address: 'required',
        state: 'required',
        city: 'required',
        post_code: 'required'
      },

      currentAddresses: '',

      selectedAddressId: null,

      user: ''
    }
  },

  mounted() {
    this.fetchAddress()

    this.user = JSON.parse(sessionStorage.getItem('user'))
    console.log(this.user)
  },

  methods: {
    saveSelectedAddress() {
      const selectedAddress = this.currentAddresses.find(
        (address) => address.id === this.selectedAddressId
      )
      this.$emit('address-selected', selectedAddress)
    },

    async fetchAddress() {
      const token = sessionStorage.getItem('token')
      if (token) {
        const response = await axios.get(`${url}/checkout/address`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.currentAddresses = response.data.data
        // console.log(response.data.data)
      }
    },

    async submitAddress(values) {
      const token = sessionStorage.getItem('token')
      // console.log(values)

      if (token) {
        try {
          const response = await axios.post(
            `${url}/checkout/address/store`,
            {
              address: values.address,
              state: values.state,
              city: values.city,
              post_code: values.post_code
            },
            {
              headers: {
                Authorization: `Bearer ${token}`
              }
            }
          )

          // console.log(response)
        } catch (error) {
          console.error(error)
          return
        }
      }
      this.fetchAddress()
    }
  }
}
</script>
