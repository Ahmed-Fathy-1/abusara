<template>
  <div class="grid grid-cols-4 gap-10 container my-5">
    <SideBar class="hidden lg:block col-span-1" />
    <section class="col-span-4 lg:col-span-3 px-5 w-full">
      <!--In Progress-->
      <div class="flex flex-col my-5" v-if="pendingOrders.length > 0">
        <h2 class="font-semibold text-lg text-gray-700">In Progress</h2>
        <!--Orders-->
        <ul>
          <li
            v-for="(order, index) in paginatedPendingOrders"
            :key="order.id"
            class="rounded-md mt-2 bg-white p-4"
          >
            <div class="mb-3 flex justify-between items-center border-b">
              <h2 class="text-xl text-gray-700 font-semibold pb-2">Order: {{ index + 1 }}</h2>
              <h2 class="my-2 text-xl">
                <span class="text-primary font-bold">{{ order.total }} AUD</span>
              </h2>
            </div>
            <!--Products-->
            <ul>
              <li
                v-for="item in order.order_details"
                :key="item.id"
                class="flex rounded-md bg-white items-center border border-l-4 border-l-primary shadow-sm pl-6 mb-3"
              >
                <img
                  class="m-2 h-24 w-28 rounded-md object-cover object-center"
                  :src="item.product_id?.images[0]"
                  alt=""
                />

                <div class="flex w-full flex-col px-4 py-4">
                  <span class="font-semibold text-lg capitalize text-gray-700">{{
                    item.product_id?.name
                  }}</span>
                  <span class="text-gray-600">{{ item.product_id?.category_id?.name }}</span>
                  <span class="text-gray-600">Qty: {{ item.quantity }}</span>
                </div>

                <div class="flex flex-col items-center pr-6">
                  <p class="font-semibold text-primary text-xl">{{ item.price }}</p>
                  <p>AUD</p>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

      <!--Completed-->
      <div class="flex flex-col my-5" v-if="completedOrders.length > 0">
        <h2 class="font-semibold text-lg text-gray-700">Completed</h2>
        <!--Orders-->
        <ul>
          <li
            v-for="(order, index) in paginatedCompletedgOrders"
            :key="order.id"
            class="rounded-md mt-2 bg-white p-4 opacity-80"
          >
            <div class="mb-3 flex justify-between items-center border-b">
              <h2 class="text-xl text-gray-700 font-semibold pb-2">Order: {{ index + 1 }}</h2>
              <h2 class="my-2 text-xl">
                <span class="text-primary font-bold">{{ order.total }} AUD</span>
              </h2>
            </div>
            <!--Products-->
            <ul>
              <li
                v-for="item in completedOrders.order_details"
                :key="item.id"
                class="flex rounded-md bg-white items-center border border-l-4 border-l-primary shadow-sm pl-6 mb-3"
              >
                <img
                  class="m-2 h-24 w-28 rounded-md object-cover object-center"
                  :src="item.product_id.images[0]"
                  alt=""
                />

                <div class="flex w-full flex-col px-4 py-4">
                  <span class="font-semibold text-xl capitalize text-gray-700">{{
                    item.product_id.name
                  }}</span>
                  <span class="text-gray-600">{{ item.product_id.category_id.name }}</span>
                  <span class="text-gray-600">Qty: {{ item.quantity }}</span>
                </div>

                <div class="flex flex-col items-center pr-6">
                  <p class="font-semibold text-primary text-2xl">{{ item.product_id.price }}</p>
                  <p>AUD</p>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

      <!--Pagination-->
      <div class="mt-5 flex justify-center">
        <nav aria-label="Page navigation example">
          <ul class="inline-flex -space-x-px text-sm">
            <li>
              <a
                @click="previousPage"
                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
                >Previous</a
              >
            </li>
            <!-- Dynamically generate pagination items -->
            <li v-for="page in pages" :key="page">
              <a
                @click="goToPage(page)"
                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
                :class="{ 'bg-gray-200 text-gray-900': page === currentPage }"
                >{{ page }}</a
              >
            </li>
            <li>
              <a
                @click="nextPage"
                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
                >Next</a
              >
            </li>
          </ul>
        </nav>
      </div>
    </section>
  </div>
</template>

<script>
import { url } from '@/config'
import axios from 'axios'

import SideBar from '@/components/account/SideBar.vue'
export default {
  name: 'OrdersView',

  data() {
    return {
      orders: [],
      currentPage: 1,
      itemsPerPage: 6
    }
  },

  components: {
    SideBar
  },

  created() {
    this.fetchOrders()
  },

  computed: {
    pages() {
      const totalOrders = this.orders.length
      const totalPages = Math.ceil(totalOrders / this.itemsPerPage)
      return Array.from({ length: totalPages }, (_, index) => index + 1)
    },

    paginatedPendingOrders() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage
      const endIndex = startIndex + this.itemsPerPage
      return this.pendingOrders.slice(startIndex, endIndex)
    },

    paginatedCompletedgOrders() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage
      const endIndex = startIndex + this.itemsPerPage
      return this.completedOrders.slice(startIndex, endIndex)
    },

    pendingOrders() {
      return this.orders.filter((order) => order.delivery_status === 1)
    },

    shippedOrders() {
      return this.orders.filter((order) => order.delivery_status === 2)
    },

    completedOrders() {
      return this.orders.filter((order) => order.delivery_status === 3)
    }
  },

  methods: {
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--
      }
    },

    nextPage() {
      const totalPages = this.pages.length
      if (this.currentPage < totalPages) {
        this.currentPage++
      }
    },

    goToPage(pageNumber) {
      this.currentPage = pageNumber
    },

    async fetchOrders() {
      const token = sessionStorage.getItem('token')
      if (token) {
        try {
          const response = await axios.get(`${url}/checkout/orders`, {
            headers: {
              Authorization: `Bearer ${token}`
            }
          })

          this.orders = response.data.data

          console.log('all orders', this.orders)
        } catch (error) {
          console.log(error)
        }
      }
    }
  }
}
</script>
