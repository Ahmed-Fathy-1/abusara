<template>
  <div class="lg:pl-20">
    <div class="mb-6">
      <span class="px-2.5 py-0.5 text-xs text-primary bg-lime-50 rounded-xl">{{
        product?.category_id?.name
      }}</span>
      <h2
        class="max-w-xl my-2 text-xl font-semibold leading-loose tracking-wide text-gray-700 md:text-2xl"
      >
        {{ product.name }}
      </h2>
      <!-- Add a checkbox input and a label element before the paragraph -->

      <p class="text-balance description text-sm text-gray-500">
        {{ product.description }}
      </p>
      <input type="checkbox" class="expand-btn appearance-none p-0 block" />

      <div class="price__content">
        <div>
          <p
            class="text-2xl font-semibold text-gray-700 mt-4"
            v-for="pr in product.prices"
            :key="pr.id"
          >
          <div v-if="weigth == pr.unit">
            <span
              >{{ pr.price }} <span class="text-primary">AUD</span></span
            >
            <span v-if="pr.discount" class="ml-3 text-base font-normal text-gray-500">${{
              pr.discount
            }} off</span>
          </div>
          </p>
        </div>

        <select
          class="unit__sellect block py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-primary rounded"
          v-model="weigth"
        >
          <option v-for="unit in product.prices" :key="unit.id" :value="unit.unit">
            {{ unit.unit }}
          </option>
        </select>
      </div>

      <!-- <p class="inline-block text-2xl font-semibold text-gray-700 mt-4">
        <span v-if="userType === 'RETAILCLIENT' || userType === undefined"
          >{{ product.prices[0].price }} <span class="text-primary">AUD</span>
        </span>
        <span v-else>{{ product.wholesale_price }} AUD</span>
        <span v-else>{{ product.prices[0].price }} AUD</span>
        <span class="ml-3 text-base font-normal text-gray-500 line-through">{{
          product.discountPrice
        }}</span>
      </p> -->
    </div>
    <!-- <div class="py-6 mb-6 border-t border-b border-gray-200">
      <p class="mt-2 text-sm text-primary">
        Free Shipping
        <span class="text-gray-600">For orders more than 500 EGP</span>
      </p>
    </div> -->
    <div class="mb-6 border-t border-gray-200"></div>
    <div class="flex mb-6 items-center">
      <div>
        <button
          @click="toggleProductInWishlist(product.id)"
          class="flex items-center justify-center w-full h-10 p-2 mr-4 text-gray-700 border border-gray-300 lg:w-11 hover:text-gray-50 hover:bg-primary rounded-md"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-heart"
            viewBox="0 0 16 16"
          >
            <path
              d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"
            ></path>
          </svg>
        </button>
      </div>

      <div v-if="!isProductInCart(product.id)" v-for="pr in product.prices" :key="pr.id" >
        <button
        v-if="weigth == pr.unit"
        @click="addItemToCart(product ,product.id, pr.unit_id , quantity)"
        class="w-full px-4 py-3 text-center text-white bg-primary hover:bg-lime-600 rounded-md"
        :disabled="addingToCart"
      >
        <i class="fas fa-cart-plus pr-2"></i>
        {{ buttonText }}
      </button>
      </div>

      <div v-else class="relative flex flex-row w-full h-10 bg-transparent rounded-lg">
        <div v-for="pr in product.prices" :key="pr.id">
          <button
          v-if="weigth == pr.unit"
          @click="decrementQuantity(pr.unit_id)"
          class="w-20 h-full text-gray-600 bg-gray-100 border-r rounded-l outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-300"
        >
          <span class="m-auto text-2xl font-thin">-</span>
        </button>
        </div>
        <input
          min="1"
          type="number"
          class="flex items-center w-full justify-center font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-100 outline-none focus:outline-none text-md hover:text-black"
          v-model="quantity"
        />
        <div v-for="pr in product.prices" :key="pr.id">
          <button
          v-if="weigth == pr.unit"
          @click="incrementQuantity(pr.unit_id)"
          class="w-20 h-full text-gray-600 bg-gray-100 border-l rounded-r outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-300"
        >
          <span class="m-auto text-2xl font-thin">+</span>
        </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import { useAuthStore } from '@/stores/auth'
import { useWishlistStore } from '@/stores/wishlist'
import { useCartStore } from '@/stores/cart'
// import {UnitsStore} from "@/stores/units"
import { mapActions, mapState } from 'pinia'

export default {
  name: 'ProductInfo',
  data() {
    return {
      quantity: 1,
      addingToCart: false,
      buttonText: 'Add to cart',
      isProductFav: '',
      weigth: "Kilo"
    }
  },

  props: ['product'],
  computed: {
    // ...mapState(useAuthStore, ['userType']),
    ...mapState(useCartStore, ['cart', "cartItems"]),
    // ...mapState(UnitsStore, ["weigth"]),
    ...mapState(useWishlistStore, ['wishlistIds']),
    // defaultWeigth () {
    //   this.weigth = product.prices[0].unit;
    //   return this.weigth
    // }
  },
  methods: {
    ...mapActions(useWishlistStore, ['addToWishlist', 'loadWishlist', 'removeFromWishlist']),
    ...mapActions(useCartStore, ['addToCart', 'toggleCart', 'updateQuantity']),
    // isProductInWishlist(id) {
    //   return this.wishlistIds.includes(id)
    // },

    // start wishlist function

    toggleProductInWishlist(id) {
      this.addToWishlist(id)
      console.log('omaaaaaaaaaaaaaar')
    },

    // end wishlist function

    incrementQuantity(unitId) {
      this.quantity++
      console.log('Quantity from increase: ' + this.quantity)
      this.updateBackendQuantity(unitId)
    },
    decrementQuantity(unitId) {
      if (this.quantity > 0) {
        this.quantity--
        this.updateBackendQuantity(unitId)
      }
    },
    updateBackendQuantity(unitId) {
      const product_id = this.product.id
      this.updateQuantity(product_id, this.quantity, unitId)
    },
    isProductInCart(id) {
      if (Array.isArray(this.cartItems)) {
        const cartItem = this.cartItems.find((item) => item.product_id.id === id)
        if (cartItem) {
          this.quantity = cartItem.quantity
          return true
        }
      }
      return false
    },
    addItemToCart(product ,id, unitId, quant) {
      this.addToCart(product ,id, unitId, quant)
      this.toggleCart()
    }
  },

  mounted() {
    console.log('this is the unit:::::', this.weigth);
  }
}
</script>

<style scoped>
.description {
  overflow: hidden;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 5;
  text-overflow: ellipsis;
}

.expand-btn::before {
  content: 'See more';
  color: rgb(134, 134, 134);
  font-size: 10px;
  text-decoration: underline;
  cursor: pointer;
  transition: all 500ms;
}

.expand-btn:hover::before {
  color: rgb(188, 188, 188);
}

.expand-btn:checked::before {
  content: 'Collapse';
  color: rgb(134, 134, 134);
  font-size: 10px;
  text-decoration: underline;
  cursor: pointer;
  transition: all 300ms;
}

.expand-btn:checked:hover::before {
  color: rgb(188, 188, 188);
}

.description:has(+ .expand-btn:checked) {
  -webkit-line-clamp: unset;
}

.price__content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.unit__sellect {
  padding: 2px;
  margin-top: 15px;
}
</style>
