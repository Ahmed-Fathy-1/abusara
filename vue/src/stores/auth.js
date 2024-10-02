import { defineStore } from 'pinia'
import axios from 'axios'
import { url } from '@/config'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    userLoggedIn: JSON.parse(sessionStorage.getItem('userLoggedIn')) || false,
    token: sessionStorage.getItem('token') || '',
    user: JSON.parse(sessionStorage.getItem('user')) || {}
  }),

  getters: {
    isAuthenticated() {
      return this.userLoggedIn
    },

    getToken() {
      return this.token
    },

    getUser() {
      return this.user
    },

    userType() {
      return this.user.user_type
    }
  },

  actions: {
    // SignIN
    async signIn(email, password) {
      console.log('Starting signIn method')
      try {
        const response = await axios.post(`${url}/auth/login`, {
          email,
          password
        })
        const data = response.data.data

        this.token = data.token
        this.user = data
        this.userLoggedIn = true

        sessionStorage.setItem('userLoggedIn', JSON.stringify(this.userLoggedIn))
        sessionStorage.setItem('token', this.token)
        sessionStorage.setItem('user', JSON.stringify(this.user))
      } catch (error) {
        const message = error.response.data.message
        throw new Error(message)
      }
    },

    // SignOut fn
    signOut() {
      this.user = {}
      this.token = ''
      this.userLoggedIn = false

      // clear the session storage
      sessionStorage.removeItem('userLoggedIn')
      sessionStorage.removeItem('token')
      sessionStorage.removeItem('user')

      window.location.reload()
    },

    async accountRegister(values) {
      try {
        const response = await axios.post(`${url}/auth/register`, values)
      } catch (error) {
        const message = error.response.data.message
        throw new Error(message)
      }
    }

    // async wholesaleRegister(values) {
    //   try {
    //     const response = await axios.post(`${url}/auth/vendor/register`, values)
    //     console.log(response)
    //     await this.signIn(values.email, values.password)
    //   } catch (error) {
    //     const message = error.response.data.message
    //     throw new Error(message)
    //   }
    // }
  }
})
