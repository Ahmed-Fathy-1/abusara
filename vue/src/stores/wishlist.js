import { defineStore } from 'pinia'
import axios from 'axios'
import { url } from '@/config'

export const useWishlistStore = defineStore('wishlist', {
  state: () => ({
    wishlist: [],
    wishlistOpened: false
  }),

  getters: {
    // wishlistIds() {
    //   return this.wishlist.map((product) => product.product.id)
    // },
    wishlistLength() {
      return this.wishlist.length
    }
  },

  actions: {
    toggleWishlist() {
      this.wishlistOpened = !this.wishlistOpened
    },

    async loadWishlist() {
      const token = sessionStorage.getItem('token')
      if (token) {
        try {
          const response = await axios.get(`${url}/favourites`, {
            headers: {
              Authorization: `Bearer ${token}`
            }
          })
          this.wishlist = response.data.data[0]
          // console.log("wishlist card :" , this.wishlist);
        } catch (error) {
          console.log(error)
        }
      }
    },

    async addToWishlist(id) {
      const token = sessionStorage.getItem('token')
      if (token) {
        // console.log(token)
        try {
          const response = await axios.post(`${url}/favourites/store/${id}`, { token })
          // console.log(response)
        } catch (error) {
          console.log(error)
          return
        }
        this.loadWishlist()
        console.log('wishlist lenght------------------------: ', this.wishlist)
        this.toggleWishlist()
      }
    },

    async removeFromWishlist(id) {
      const token = sessionStorage.getItem('token')

      if (token) {
        try {
          const response = await axios.delete(`${url}/favourites/delete/${id}`, {
            headers: {
              Authorization: `Bearer ${token}`
            }
          })
          // console.log(response)
        } catch (error) {
          console.log(error)
          return
        }
        this.loadWishlist()
      }
    }
  }
})
