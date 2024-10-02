<template>
  <div
    v-if="login_show_alert"
    class="text-white text-center font-bold p-4 mb-4"
    :class="login_alert_variant"
  >
    {{ login_alert_msg }}
  </div>
  <vee-form @submit="customSignIn" :validation-schema="loginSchema">
    <!-- Email -->
    <div class="mb-3 flex flex-col">
      <label class="inline-block mb-2">Email</label>
      <vee-field
        name="email"
        type="email"
        autocomplete="off"
        class="block w-full py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-black rounded"
      />
      <ErrorMessage class="text-red-600" name="email" />
    </div>
    <!-- Password -->
    <div class="mb-3 flex flex-col">
      <label class="inline-block mb-2">Password</label>
      <vee-field
        name="password"
        type="password"
        autocomplete="off"
        class="block w-full py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-black rounded"
      />
      <ErrorMessage class="text-red-600" name="password" />
    </div>

    <!-- Remember me  & Forgot Password-->
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-3">
      <div class="flex items-center">
        <vee-field name="remember" type="checkbox" value="1" class="w-4 h-4 mr-2 rounded" />
        <label for="remember" class="text-gray-800">Remember me</label>
      </div>
      <div>
        <router-link
          @click="modalVisibility = false"
          to="/forgot-password"
          class="text-primary hover:underline hover:cursor-pointer hover:text-lime-600"
        >
          Forgot your password?</router-link
        >
      </div>
    </div>

    <!-- Submit button -->
    <button
      type="submit"
      class="block w-full bg-primary text-white py-1.5 px-3 rounded transition hover:bg-primary"
      :disabled="login_in_submission"
    >
      Submit
    </button>
  </vee-form>
</template>

<script>
import useModalStore from '@/stores/authModal'
import { useAuthStore } from '@/stores/auth'
import { useCartStore } from '@/stores/cart'
import { mapActions, mapState, mapWritableState } from 'pinia'

export default {
  name: 'LoginForm',
  data() {
    return {
      loginSchema: {
        email: 'required|email',
        password: 'required|min:8|max:100'
      },
      login_in_submission: false,
      login_show_alert: false,
      login_alert_variant: 'bg-blue-500',
      login_alert_msg: 'Please wait! We are logging you in.'
    }
  },
  computed: {
    ...mapState(useModalStore, ['hiddenClass']),
    ...mapWritableState(useModalStore, {
      modalVisibility: 'isOpen'
    }),
    ...mapState(useAuthStore, ['userLoggedIn'])
  },
  methods: {
    ...mapActions(useCartStore, ['loadCart', 'saveGuestCartToUser']),
    ...mapActions(useAuthStore, ['signIn']),
    async customSignIn(values) {
      const email = values.email
      const password = values.password

      this.login_in_submission = true
      this.login_show_alert = true
      this.login_alert_variant = 'bg-blue-500'
      this.login_alert_msg = 'Please wait! We are logging you in.'

      try {
        await this.signIn(email, password)
        await this.saveGuestCartToUser()
        await this.loadCart()
      } catch (err) {
        this.login_in_submission = false
        this.login_alert_variant = 'bg-red-500'
        this.login_alert_msg = `${err}`
        return
      }

      this.login_alert_variant = 'bg-green-500'
      this.login_alert_msg = 'Success! You are now logged in.'

      window.location.reload()
    }
  }
}
</script>
