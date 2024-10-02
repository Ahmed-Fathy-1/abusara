<template>
  <div>
    <AppHeader :categories="categories" v-if="!isNotFound" />

    <router-view v-slot="{ Component }">
      <transition>
        <component :is="Component" />
      </transition>
    </router-view>

    <!-- success message -->
    <v-snackbar v-model="bar" location="right top" timeout="2000" color="#008000">
      <div class="message d-flex align-center">
        <v-icon class="me-2">mdi-checkbox-marked-circle-outline</v-icon>
        <span>{{ itemTitle }} has added to cart successfully!</span>
      </div>
    </v-snackbar>

    <!-- delete message -->
    <v-snackbar v-model="bar2" location="right top" timeout="2000" color="#ab0c0c">
      <div class="message d-flex align-center">
        <v-icon class="me-2">mdi-close-circle-outline</v-icon>
        <span>{{ itemTitle }} has deleted from cart successfully!</span>
      </div>
    </v-snackbar>

    <AppAuth />
    <AppFooter :footerData="footerData" :categories="categories" v-if="!isNotFound" />
  </div>
</template>

<script>
export default {
  inject: ['Emitter'],
  data: () => ({
    bar: false,
    bar2: false,
    itemTitle2: '',
    itemTitle: ''
  }),
  mounted() {
    // success message
    this.Emitter.on('showMsg', (data) => {
      this.itemTitle = data
      this.bar = true
    })

    // delete message
    this.Emitter.on('showDeletedMsg', (data) => {
      this.itemTitle2 = data
      this.bar2 = true
    })
  }
}
</script>

<script setup>
import AppHeader from '@/components/AppHeader.vue'
import AppFooter from './components/AppFooter.vue'
import AppAuth from './components/partials/AppAuth.vue'

import { useWishlistStore } from './stores/wishlist'
import { useCartStore } from './stores/cart'

import { useRoute } from 'vue-router'
import { ref, onMounted, computed } from 'vue'

import axios from 'axios'
import { url } from '@/config'

const cart = useCartStore()
cart.loadCart()

const wishlist = useWishlistStore()
wishlist.loadWishlist()

const categories = ref([])
const footerData = ref([])

const route = useRoute()
// console.log(route)
const isNotFound = computed(() => route.name === 'NotFoundView')

onMounted(() => {
  const cachedCategories = sessionStorage.getItem('categories')
  if (cachedCategories) {
    categories.value = JSON.parse(cachedCategories)
  } else {
    useCategoriesAPI()
  }

  const cachedFooterData = sessionStorage.getItem('footerData')
  if (cachedFooterData) {
    footerData.value = JSON.parse(cachedFooterData)
  } else {
    useFooterAPI()
  }

  console.log("asd",cart.cartItems)
})

async function useCategoriesAPI() {
  try {
    const response = await axios.get(`${url}/category`)
    categories.value = response.data.data
    console.log(categories.value)

    sessionStorage.setItem('categories', JSON.stringify(categories.value))
  } catch (error) {
    console.error(error)
  }
}

async function useFooterAPI() {
  try {
    const response = await axios.get(`${url}/footer`)
    footerData.value = response.data.data
    console.log(footerData.value)

    sessionStorage.setItem('footerData', JSON.stringify(footerData.value))
  } catch (error) {
    console.error(error)
  }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
