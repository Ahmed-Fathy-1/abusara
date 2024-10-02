<template>
  <article class="rounded-lg flex flex-col border border-gray-100 bg-white shadow-md main__article">
    <RouterLink
      :to="`/product/${product.id}/${product.slug_url ? product.slug_url : product.new_redirection}`"
      class="relative flex h-40 w-full overflow-hidden rounded-lg justify-center link__img"
      :style="{
        'background-image': 'url(' + product.images[0] + ')',
        'background-repeat': 'no-repeat',
        'background-size': 'cover'
      }"
    >
      <div v-if="product.prices[0].discount">
        <div
        class="offer__text absolute top-0 left-0 m-2 rounded-full px-2 text-center text-sm font-medium text-white"
      >
        ${{ product.prices[0].discount }} <br />
        <div class="off">off</div>
      </div>
      <div class="offer-image">
        <img src="./../../assets/images/icons/offer-number.svg" alt="..." />
      </div>
      </div>
    </RouterLink>

    <div class="mt-4 px-5 pb-5 flex flex-col items-center">
      <RouterLink :to="`/products/${product.id}`">
        <h5 class="text-sm text-center lg:text-base text-gray-600 trauncated__title">
          {{ truncatedTitle }}
        </h5>
      </RouterLink>
      <!-- <p class="pt-2 text-gray-600">{{ product.description }}</p> -->
      <div class="mt-2 mb-5 flex items-center justify-center">
        <p>
          <!-- <span
            v-if="userType === 'RETAILCLIENT' || userType === undefined"
            class="text-lg lg:text-xl font-bold text-primary"
            >{{ product.retailPrice }} AUD</span
          >
          <span
            v-else-if="userType === 'WHOLESALECLIENT'"
            class="text-lg lg:text-xl font-bold text-primary"
          >
            {{ product.wholesale_price }}
          </span> -->

          <div class="text-sm text-gray-500 line-through descount__price">{{ product.price }}</div>

          <span class="text-lg lg:text-3xl font-bold text-primary">
            {{ Math.ceil(product.prices[0].price) - Math.ceil(product.prices[0].discount) }}
          <span class="aud">AUD</span>
          </span
          >

          <!-- <span
            v-if="product.discount"
            class="text-sm text-gray-500 line-through ps-1"
            :key="product.oldPrice"
          >
            {{ product.price }}</span
          > -->
        </p>
      </div>

      <RouterLink :to="`/product/${product.id}/${product.slug_url ? product.slug_url : product.new_redirection}`">
        <button
        :disabled="addingToCart"
        class="flex items-center justify-center rounded-md bg-primary w-40 py-2.5 text-center text-xs lg:text-sm lg:font-medium text-white hover:bg-lime-600 transition duration-300"
        key="cart-button"
      >
        <transition name="fade">
          <div class="d-flex align-center">
            <v-icon class="pe-4">mdi-eye-arrow-left-outline</v-icon>
            <span class="button-text" :key="buttonText">{{ buttonText }}</span>
          </div>
        </transition>
      </button>
      </RouterLink>

      <!-- <div v-else class="relative flex flex-row w-full h-10 bg-transparent rounded-lg">
        <button
          @click="decrementQuantity"
          class="w-20 h-full text-gray-600 bg-gray-100 border-r rounded-l outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-300"
        >
          <span class="m-auto text-2xl font-thin">-</span>
        </button>
        <input
          min="1"
          type="number"
          class="flex items-center w-full justify-center font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-100 outline-none focus:outline-none text-md hover:text-black"
          v-model="quantity"
        />
        <button
          @click="incrementQuantity"
          class="w-20 h-full text-gray-600 bg-gray-100 border-l rounded-r outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-300"
        >
          <span class="m-auto text-2xl font-thin">+</span>
        </button>
      </div> -->
    </div>
  </article>
</template>

<script>
import { useAuthStore } from '@/stores/auth'
import { useCartStore } from '@/stores/cart'
import { mapActions, mapState } from 'pinia'
import { RouterLink } from 'vue-router'

export default {
  name: 'GlobalCard',
  inject: ['Emitter'],
  data() {
    return {
      addingToCart: false,
      quantity: '',
      buttonText: 'Show Details'
    }
  },

  props: ['product'],

  mounted() {
    // console.log('one product from global card', this.product)
  },

  computed: {
    ...mapState(useAuthStore, ['userType']),
    ...mapState(useCartStore, ['cart', 'cartItems']),

    truncatedTitle() {
      const maxLength = 11
      return this.product.name.length > maxLength
        ? this.product.name.substring(0, maxLength) + '...'
        : this.product.name
    }
  },

  methods: {
    incrementQuantity() {
      this.quantity++
      this.updateBackendQuantity()
    },

    decrementQuantity() {
      if (this.quantity > 0) {
        this.quantity--
        this.updateBackendQuantity()
      }
    },

    updateBackendQuantity() {
      const product_id = this.product.id
      this.updateQuantity(product_id, this.quantity)
    },

    isProductInCart(id) {
      const token = sessionStorage.getItem('token')

      if (token) {
        if (this.cartItems.length) {
          const cartItem = this.cartItems.find((item) => item.product_id.id === id)

          // console.log(cartItem)
          if (cartItem) {
            this.quantity = cartItem.quantity
            return true
          }
        }
        return false
      } else {
        if (this.cartItems.length) {
          const cartItem = this.cartItems.find((item) => item.product_id === id)

          if (cartItem) {
            this.quantity = cartItem.quantity
            return true
          }
        }
        return false
      }
    },

    ...mapActions(useCartStore, ['addToCart', 'toggleCart', 'updateQuantity']),

    addItemToCart(id, product) {
      this.addToCart(id, product)
      this.toggleCart()
      setTimeout(() => {
        this.Emitter.emit('showMsg', product.name)
      }, 1000)
    }
  },

  watch: {
    cartItems: {
      immediate: true,
      handler: 'isProductInCart',
      deep: true
    }
  }
}
</script>

<style scoped>
.main__article {
  padding: 10px;
}
.object-contain {
  -o-object-fit: contain;
  object-fit: contain;
  width: 90%;
  height: 150px;
  border-radius: 15px;
  margin-top: 10px;
}

.offer-image img {
  max-width: 62px;
  max-height: 62px;
  position: absolute;
  z-index: 1;
  left: 3px;
  top: 7px;
  padding: 3px;
}

.offer__text {
  color: #000;
  z-index: 3;
  color: #b10b0b;
  font-weight: bold;
  transform: translate(11px, 3px);
}

.trauncated__title {
  /* font-size: 22px; */
  /* font-weight: bold; */
}

.off {
  transform: translateY(-5px);
}

.offer-image img {
  animation: fade-out 2s linear infinite;
}

.descount__price {
  text-align: left;
  color: #ea0909;
  transform: translateY(10px);
}

.aud {
  font-size: 1rem;
}

@keyframes fade-out {
  0%,
  100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.2);
  }
}
</style>
