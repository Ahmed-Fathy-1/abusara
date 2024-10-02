<template>
  <header class="app-bar bg-white shadow">
    <div class="container px-[2rem]">
      <div class="py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center gap-4">
          <!-- Responsive Toggle Button -->
          <button
            @click="toggleNav"
            id="responsiveToggle"
            class="block md:hidden text-slate-600 lg:pl-2"
            type="button"
          >
            <i class="fas fa-bars text-2xl"></i>
          </button>
          <RouterLink to="/" class="text-xl lg:text-3xl xl:text-3xl font-bold text-primary"
            >BUTCHER
          </RouterLink>
        </div>

        <!-- Search in large -->
        <div class="relative" ref="searchContainer">
          <div
            class="bg-transparent mx-5 rounded-lg hidden items-center lg:flex border-gray-300 border py-2 px-1 w-96"
          >
            <input
              v-model="searchInput"
              @input="handleSearch"
              class="w-full outline-0 bg-transparent font-semibold text-sm px-4"
              type="text"
              placeholder="What are you looking for?"
            />
            <button @click.prevent="handleSearch" type="button" title="Search">
              <i class="fas fa-search text-gray-400 p-2"></i>
            </button>
          </div>

          <!-- Display search results -->
          <div
            v-if="searchResults.length > 0"
            class="lg:absolute left-4 w-96 bg-white rounded-md p-2 shadow-lg z-50 small__search"
          >
            <ul>
              <li
                v-for="result in searchResults"
                :key="result.id"
                @click="navigateToProduct(result.id, result.slug_url)"
                class="hover:bg-gray-100 p-1 rounded-md my-1 cursor-pointer transition duration-100"
              >
                {{ truncateName(result.name) }}
              </li>
            </ul>
          </div>
        </div>

        <!-- Content -->
        <div class="content">
          <ul class="ml-4 flex items-center justify-end gap-2">
            <!--Search in small-->
            <li id="small-search" class="block lg:hidden">
              <button
                v-if="!showSearchInput"
                @click="toggleSearchInput"
                type="button"
                title="Search"
              >
                <i class="fas fa-search text-slate-600 text-lg"></i>
              </button>
              <input
                v-if="showSearchInput"
                ref="smallSearchInput"
                @blur="toggleSearchInput"
                @input="handleSearch"
                class="w-32 outline-0 bg-transparent font-semibold text-sm px-4"
                type="text"
                v-model="searchInput"
                placeholder="Search..."
              />
            </li>

            <!-- Shopping Cart and Wishlist -->
            <li v-if="!showSearchInput">
              <div class="flex gap-2 lg:gap-4 lg:border-r border-slate-600 lg:pr-4">
                <button
                  v-if="userLoggedIn"
                  @click.prevent="toggleWishlist"
                  type="button"
                  class="flex text-slate-600 gap-1 justify-center items-center text-center hover:text-primary capitalize transition duration-300"
                >
                  <span class="hidden lg:block text-sm">Wishlist</span>
                  <div class="heart-icon">
                    <i class="fas fa-heart text-xl"></i>
                  </div>
                </button>
                <button
                  @click="toggleCart"
                  type="button"
                  class="relative flex text-slate-600 gap-1 justify-center items-center text-center hover:text-primary capitalize transition duration-300 group"
                >
                  <span class="hidden lg:block text-sm">Cart</span>
                  <div class="cart-icon">
                    <i class="fas fa-shopping-cart text-xl"></i>
                  </div>
                  <span
                    v-show="cartLength"
                    class="absolute flex justify-center items-center text-center left-4 lg:left-11 bottom-4 rounded-full bg-primary text-white text-[0.65rem] px-2 py-0.5 group-hover:scale-110"
                    >{{ cartLength }}</span
                  >
                </button>
              </div>
            </li>

            <!--Sign-in / SignUp-->
            <li class="lg:pr-2" v-if="!userLoggedIn">
              <button
                @click.prevent="toggleAuthModal"
                type="button"
                class="flex text-slate-600 gap-1 justify-center items-center text-center hover:text-primary capitalize transition duration-300"
              >
                <i class="fas fa-user text-xl"></i>
                <span class="hidden lg:block text-sm">Log in</span>
              </button>
            </li>

            <li v-if="userLoggedIn" class="lg:pr-2">
              <MyAccountModal />
            </li>
          </ul>
        </div>
      </div>

      <!--Shoping Cart Modal-->
      <ShoppingCart :open="isOpen" />

      <!--Wishlist Modal-->
      <WishList :open="wishlistOpened" />

      <!--Nav in Large screens-->
      <div class="header-nav">
        <span
          @click="$router.push('/')"
          style="cursor: pointer"
          class="d-flex align-center ga-4 home__link"
        >
          <v-icon class="home__icon">mdi-home</v-icon>
          <span>Home</span>
        </span>
        <nav class="py-2 flex gap-5 items-center">
          <template v-for="category in singleCatigory" :key="category.id">
            <RouterLink
              :to="`/products/${category.slug_url}`"
              class="hover:text-primary capitalize transition duration-300"
              >{{ category.name }}</RouterLink
            >
          </template>
        </nav>
      </div>

      <!--Nav in small screens-->
      <div
        v-if="showNav"
        @click="toggleNav"
        class="fixed top-0 right-0 z-40 h-screen w-screen p-4 bg-white"
      >
        <div @click.stop class="h-full w-full">
          <h5 class="inline-flex items-center mb-4 text-base font-semibold">Our Categories</h5>
          <button
            @click="toggleNav"
            type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center"
          >
            <svg
              class="w-3 h-3"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 14 14"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
              />
            </svg>
            <span class="sr-only">Close menu</span>
          </button>

          <div>
            <nav
              class="container py-4 flex flex-col gap-5 items-center bg-green-50 justify-around rounded h-full"
            >
              <template v-for="category in categories" :key="category.id">
                <RouterLink
                  :to="`/products/${category.slug_url}`"
                  class="hover:text-primary capitalize transition duration-300"
                  >{{ category.name }}</RouterLink
                ></template
              >
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { useCartStore } from '@/stores/cart'
import useModalStore from '@/stores/authModal'
import { useWishlistStore } from '@/stores/wishlist'
import { useAuthStore } from '@/stores/auth'
import { useCategoriesStore } from '@/stores/carigories'

import { mapStores } from 'pinia'
import { mapState, mapActions } from 'pinia'

import ShoppingCart from '@/components/partials/ShoppingCart.vue'
import WishList from './partials/WishList.vue'
import MyAccountModal from './MyAccountModal.vue'
import SerchInput from '@/components/partials/SearchInput.vue'
import { RouterLink } from 'vue-router'
import axios from 'axios'
import { url } from '@/config'

export default {
  components: {
    ShoppingCart,
    WishList,
    MyAccountModal,
    SerchInput
  },
  data() {
    return {
      showNav: false,
      showSearchInput: false,
      // singleCatigory: [],
      // Search Logic
      searchInput: '',
      searchResults: [],
      searched: false
    }
  },

  props: ['categories'],

  methods: {
    toggleNav() {
      this.showNav = !this.showNav
    },

    // getSingleCatigory() {
    //   const allcatigories = `${url}/category`
    //   axios
    //     .get(allcatigories)
    //     .then((response) => {
    //       this.singleCatigory = response.data.data
    //     })
    //     .catch((error) => {
    //       console.log(error)
    //     })
    // },

    toggleSearchInput() {
      this.showSearchInput = !this.showSearchInput
      if (this.showSearchInput) {
        this.$nextTick(() => {
          this.$refs.smallSearchInput.focus()
        })
      }
    },

    ...mapActions(useCartStore, ['toggleCart']),
    ...mapActions(useWishlistStore, ['toggleWishlist']),
    ...mapActions(useCategoriesStore, ['getSingleCatigory']),

    toggleAuthModal() {
      this.modalStore.isOpen = !this.modalStore.isOpen
    },

    async handleSearch() {
      if (this.searchInput.trim() === '') {
        // If search query is empty, hide the search results modal
        this.searchResults = []
        return
      }
      try {
        const response = await axios.get(
          `${url}/products/search/filter?product_name=${this.searchInput}`
        )

        // Limit the number of search results to 5
        this.searchResults = response.data.data.slice(0, 5)
      } catch (error) {
        console.error('Error occurred during search:', error)
      }
    },

    truncateName(name) {
      const maxLength = 30
      if (name.length > maxLength) {
        return name.slice(0, maxLength) + '...'
      } else {
        return name
      }
    },

    navigateToProduct(id, slug_url) {
      this.searchResults = []
      this.searchInput = ''

      this.$router.push(`/product/${id}/${slug_url}`)
    },

    hideSearchResults(event) {
      if (!this.$refs.searchContainer.contains(event.target)) {
        this.searchResults = []
      }
    }
  },

  computed: {
    ...mapState(useCartStore, ['isOpen', 'cartLength']),
    ...mapState(useWishlistStore, ['wishlistOpened']),
    ...mapStores(useModalStore),
    ...mapState(useAuthStore, ['userLoggedIn']),
    ...mapState(useCategoriesStore, ['singleCatigory'])
  },

  beforeMount() {
    this.getSingleCatigory()
  }
}
</script>

<style scoped>
.header-nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-bottom: 10px;
  padding-top: 5px;
  border-top: 1px solid #ddd;
}

.home__link {
  display: flex;
  gap: 2;
  align-items: center;
}

.home__icon {
  color: #475569;
}

.home__link:hover {
  transition: all 0.5s ease;
  color: #88b06a;
}

@media (max-width: 992px) {
  .header-nav {
    display: none;
  }
}

/* .serach-result {
  position: absolute;
  top: 50px;
  left: 0;
  width: 100%;
  background-color: red;
  margin: 8px;
  padding: 16px;
  z-index: 100;
  border-radius: 8px;
}

.serach-result::before {
  content: '';
  background-color: white;
  width: 100vw;
  height: 100vh;
} */

/* .cart-icon , .heart-icon {
  width: 30px;
  height: 30px;
  border:1px solid;
  border-radius: 50%;
} */

@media (max-width: 767px) {
  .small__search {
    position: absolute;
    transform: translate(-192px, 45px);
  }
}
</style>
