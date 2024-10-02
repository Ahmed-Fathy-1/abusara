<template>
  <div
    v-if="reg_show_alert"
    :class="reg_alert_variant"
    class="text-white text-center font-bold p-4 rounded mb-4"
  >
    {{ reg_alert_msg }}
  </div>

  <vee-form :validation-schema="schema" :initial-values="userData" @submit="register">
    <!-- First Name -->
    <div class="mb-3 flex flex-col">
      <label class="inline-block mb-2">Name</label>
      <vee-field
        name="name"
        type="text"
        class="block w-full py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-black rounded"
      />

      <ErrorMessage class="text-red-600" name="name" />
    </div>

    <!--Second Name-->
    <!-- <div class="mb-3 flex flex-col">
      <label class="inline-block mb-2">Last Name</label>
      <vee-field
        name="last_name"
        type="text"
        class="block w-full py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-black rounded"
      />
      <ErrorMessage class="text-red-600" name="last_name" />
    </div> -->

    <!-- Email -->
    <div class="mb-3 flex flex-col">
      <label class="inline-block mb-2">Email</label>
      <vee-field
        name="email"
        type="email"
        class="block w-full py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-black rounded"
      />
      <ErrorMessage class="text-red-600" name="email" />
    </div>
    <!-- Phone Number -->
    <div class="mb-3 flex flex-col">
      <label class="inline-block mb-2">Phone Number</label>
      <vee-field
        name="mobile"
        type="tel"
        class="block w-full py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-black rounded"
      />
      <ErrorMessage class="text-red-600" name="mobile" />
    </div>
    <!-- Password -->
    <div class="mb-3 flex flex-col">
      <label class="inline-block mb-2">Password</label>
      <vee-field name="password" :bails="false" v-slot="{ field, errors }">
        <input
          autocomplete="new-password"
          type="password"
          class="block w-full py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-black rounded"
          v-bind="field"
        />
        <div class="text-red-600" v-for="error in errors" :key="error">
          {{ error }}
        </div>
      </vee-field>
    </div>
    <!-- Confirm Password -->
    <div class="mb-3 flex flex-col">
      <label class="inline-block mb-2">Confirm Password</label>
      <vee-field
        name="password_confirmation"
        type="password"
        class="block w-full py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-black rounded"
      />
      <ErrorMessage class="text-red-600" name="password_confirmation" />
    </div>
    <!-- Country -->
    <div class="mb-3 flex flex-col">
      <label class="inline-block mb-2">Country</label>
      <vee-field
        name="country"
        as="select"
        class="block w-full py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-black rounded"
      >
        <option value="Egypt">Egypt</option>
        <option value="Palastine">Palastine</option>
        <option value="Norway">Norway</option>
      </vee-field>
      <ErrorMessage class="text-red-600" name="country" />
    </div>

    <!-- TOS -->
    <!-- <div class="mb-3">
      <vee-field name="term_condition" type="checkbox" value="1" class="w-4 h-4 mr-2 rounded" />
      <label class="inline-block">
        I accept the
        <a href="#" class="hover:text-primary hover:underline">Terms And Services</a></label
      >
      <ErrorMessage class="text-red-600 block" name="term_condition" />
    </div> -->

    <button
      :disabled="reg_in_submission"
      type="submit"
      class="block w-full bg-primary text-white py-1.5 px-3 rounded transition hover:bg-lime-600"
    >
      Submit
    </button>
  </vee-form>
</template>

<script>
import { useAuthStore } from '@/stores/auth'
import { useCartStore } from '@/stores/cart'
import { mapActions, mapState } from 'pinia'
export default {
  name: 'RegisterForm',
  data() {
    return {

      //Schema for Form Validation
      schema: {
        name: 'required|min:3|max:30|alpha',
        // last_name: 'required|min:3|max:30|alpha',
        email: 'required|email|',
        mobile: 'required|',
        password: 'required|min:6|max:249|excluded:password',
        password_confirmation: 'passwords_mismatch:@password',
        // country: 'required',
        // term_condition: 'term_condition'
      },

      userData: {
        country: 'Egypt'
      },

      reg_in_submission: false,
      reg_show_alert: false,
      reg_alert_variant: 'bg-blue-500',
      reg_alert_msg: 'Please wait! Your account is being created.'
    }
  },

  methods: {
    ...mapActions(useAuthStore, ['accountRegister', 'signIn']),
    ...mapActions(useCartStore, ['saveGuestCartToUser']),

    async register(values) {
      this.reg_show_alert = true
      this.reg_in_submission = true
      this.reg_alert_variant = 'bg-blue-500'
      this.reg_alert_msg = 'Please wait! Your account is being created.'

      try {
        await this.accountRegister(values)
        await this.signIn(values.email, values.password)
        await this.saveGuestCartToUser()

        // window.location.reload()
      } catch (err) {
        this.reg_in_submission = false
        this.reg_alert_variant = 'bg-red-500'
        this.reg_alert_msg = `${err}`
        return
      }
      this.reg_alert_variant = 'bg-green-500'
      this.reg_alert_msg = 'Success! You now have an Account'
    }
  }
}
</script>
