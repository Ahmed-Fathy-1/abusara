// cartStore.js
import { defineStore } from 'pinia'
import axios from 'axios'
import { url } from '@/config'

export const useCartStore = defineStore('cart', {
  state: () => ({
    isOpen: false,
    cart: JSON.parse(localStorage.getItem('guestCart')) || [],
    userLoggedIn: false,
    guestCartDetailsAPI: JSON.parse(localStorage.getItem('guestCartDetailsAPI')) || []
  }),

  getters: {
    cartLength() {
      const token = sessionStorage.getItem('token')
      if (token) {
        return this.cartItems.length || 0
      } else {
        return this.cartItems.length || 0
      }
    },

    carLenghtDetails() {
      if (token) {
        return this.cart.length
      } else {
        return this.cart.length || 0
      }
    },

    cartItems() {
      const token = sessionStorage.getItem('token')
      if (token) {
        return this.cart.cart_details || []
      } else {
        return this.cart
      }
    }
  },

  actions: {
    toggleCart() {
      this.isOpen = !this.isOpen
    },

    // get cart data
    async loadCart() {
      const token = sessionStorage.getItem('token')

      try {
        if (token) {
          const response = await axios.get(`${url}/cart`, {
            headers: {
              Authorization: `Bearer ${token}`
            }
          })

          const cart = response.data.data

          this.cart = cart
          this.userLoggedIn = true
        } else {
          this.userLoggedIn = false
        }
      } catch (error) {
        console.error('Error loading cart:', error.response ? error.response.data : error)
      }
    },

    // add to cart
    async addToCart(product, id, unitId, quant) {
      const token = sessionStorage.getItem('token')

      try {
        if (token) {
          this.userLoggedIn = true
          // console.log('id:', id)
          // console.log('unitId:', unitId)
          // console.log('Quantity:', quant)
          const response = await axios.post(
            `${url}/cart/add/${id}`,
            {
              unit_id: unitId,
              quantity: quant
            },
            {
              headers: {
                Authorization: `Bearer ${token}`
              }
            }
          )
          await this.loadCart()
        } else {
          const productIdAndQuantity = { product_id: id, quantity: 1, unit_id: unitId }
          this.guestCartDetailsAPI.push(productIdAndQuantity)

          this.cart.push({ product_id: product, quantity: 1, unit_id: unitId })

          this.userLoggedIn = false
          this.syncLocalStorageCart()
        }
      } catch (error) {
        console.error('Error loading cart:', error.response ? error.response.data : error)
      }
    },

    // remove item from cart
    async removeFromCart(id, unitId) {
      const token = sessionStorage.getItem('token')
      console.log('omar:', token)
      console.log('removed id :', id)
      console.log('removed unitId :', unitId)
      try {
        if (token) {
          this.userLoggedIn = true
          const response = await axios.delete(`${url}/cart/delete`, {
            data: {
              product_id: id,
              unit_id: unitId
            },
            headers: {
              Authorization: `Bearer ${token}`
            }
          })

          await this.loadCart()
          console.log('item is deleted frpm cart', this.cart)
        } else {
          const indexToRemove = this.cart.findIndex((item) => item.product_id.id === id)

          if (indexToRemove !== -1) {
            this.cart.splice(indexToRemove, 1)
            this.guestCartDetailsAPI.splice(indexToRemove, 1)
            console.log(this.guestCartDetailsAPI)
            this.syncLocalStorageCart()

            // if (this.cart.length === 0) {
            //   window.location.reload() // Reload the window
            // }
          }
        }
      } catch (error) {
        console.error('Error loading cart:', error.response ? error.response.data : error)
      }
    },

    // update the quantity
    async updateQuantity(id, quantity, unitId) {
      const token = sessionStorage.getItem('token')
      console.log('ljk;sdjjjjjjjjjjjjjjjjjjjjjjjjjj:', quantity)

      try {
        if (token) {
          this.userLoggedIn = true
          const response = await axios.post(`${url}/cart/add/${id}`, {
            token,
            product_id: id,
            unit_id: unitId,
            quantity: quantity
          })

          console.log('from cart ', response.data.data)
          await this.loadCart()
        } else {
          const indexToUpdate = this.cart.findIndex((item) => item.product_id.id === id)
          if (quantity === 0) {
            this.removeFromCart(id)
          }
          if (indexToUpdate !== -1) {
            this.cart[indexToUpdate].quantity = quantity
            this.guestCartDetailsAPI[indexToUpdate].quantity = quantity
            this.syncLocalStorageCart()
          }
        }
      } catch (error) {
        console.error('Error loading cart:', error.response ? error.response.data : error.message)
      }
    },

    // to save the guest cart after login
    async saveGuestCartToUser() {
      const token = sessionStorage.getItem('token')
      console.log('this is guest cart responce:::::::', this.$state.guestCartDetailsAPI)
      // if (this.$state.guestCartDetailsAPI) {
      //   return
      // }
      if (token) {
        try {
          const requestData = {
            token: token,
            cart_details: this.guestCartDetailsAPI
          }
          console.log('Request Data:', requestData) // Log the request data

          const response = await axios.post(`${url}/cart/cart-storage`, requestData)

          console.log('Response from server:', response)

          this.userLoggedIn = true
          localStorage.removeItem('guestCart')
          localStorage.removeItem('guestCartDetailsAPI')
        } catch (error) {
          console.log(error)
        }
      }
    },

    // to set guest cart in local storage
    async syncLocalStorageCart() {
      localStorage.setItem('guestCart', JSON.stringify(this.cart))
      localStorage.setItem('guestCartDetailsAPI', JSON.stringify(this.guestCartDetailsAPI))
    }
  }
})
