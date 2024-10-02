<template>
  <div class="grid grid-cols-4 gap-10 container my-5">
    <SideBar class="col-span-4 lg:col-span-1" />
    <section class="col-span-4 lg:col-span-3 px-5 w-full">
      <div class="flex flex-col gap-1">
        <h1 class="font-semibold text-2xl text-gray-700">Profile</h1>
      </div>
      <!--General Info-->
      <div class="flex flex-col my-5">
        <h2 class="font-semibold text-lg text-gray-700">General Info</h2>
        <div class="rounded-md mt-2 bg-white p-4">
          <form>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
              <div class="lg:col-span-1">
                <label for="first-name" class="block mb-2 text-sm font-medium text-gray-600"
                  >First Name</label
                >
                <input
                  type="text"
                  id="first-name"
                  class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
                  :value="getUser.first_name"
                  required
                />
              </div>

              <div class="lg:col-span-1">
                <label for="sec-name" class="block mb-2 text-sm font-medium text-gray-600"
                  >Second Name</label
                >
                <input
                  type="text"
                  id="sec-name"
                  class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
                  :value="getUser.last_name"
                  required
                />
              </div>

              <div class="lg:col-span-1 flex flex-col lg:justify-end">
                <button class="lg:float-end bg-primary text-white p-2 rounded-md text-sm w-full" type="submit">
                  UPDATE INFO
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!--Security Info-->
      <div class="flex flex-col my-5">
        <h2 class="font-semibold text-lg text-gray-700">Security Info</h2>
        <div class="rounded-md mt-2 bg-white p-4">
          <form>
            <div class="flex flex-col lg:flex-row lg:items-center gap-4">
              <div class="">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-600"
                  >Email</label
                >
                <input
                  type="email"
                  id="email"
                  class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
                  placeholder="aly.godfather.gm@gmail.com"
                  disabled
                />
              </div>
              <div class="">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-600"
                  >Password</label
                >
                <input
                  type="text"
                  id="password"
                  class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
                  placeholder="*********"
                  disabled
                />
              </div>
              <div class="">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-600"
                  >Phone no</label
                >
                <input
                  type="tel"
                  id="phone"
                  class="bg-gray-50 border border-gray-300 text-gray-600 focus:outline-primary text-sm rounded-md block w-full p-2"
                  placeholder="01552735663"
                  disabled
                />
              </div>
            </div>
          </form>
          <div class="flex flex-col lg:flex-row gap-4 my-5">
            <button
              @click="isPasswordModalOpen = true"
              class="border-2 p-2 border-primary text-primary hover:bg-primary hover:text-white rounded-md text-xs"
            >
              Change Password
            </button>
            <button
              @click="isPhoneModalOpen = true"
              class="border-2 p-2 border-primary text-primary hover:bg-primary hover:text-white rounded-md text-xs"
            >
              Change Phone Number
            </button>
            <button
              @click="isDeleteAccountModalOpen = true"
              class="text-red-500 hover:text-red-400 underline text-sm"
            >
              Delete Account
            </button>
          </div>
        </div>
        <AccountDeletionModal
          :open="isDeleteAccountModalOpen"
          @close="isDeleteAccountModalOpen = false"
        />
        <ChangePassword :open="isPasswordModalOpen" @close="isPasswordModalOpen = false" />
        <ChangePhone :open="isPhoneModalOpen" @close="isPhoneModalOpen = false" />
      </div>
    </section>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth'
import { mapActions, mapState } from 'pinia'

import SideBar from '@/components/account/SideBar.vue'
import AccountDeletionModal from '@/components/account/AccDeactivate.vue'
import ChangePassword from '@/components/account/ChangePassword.vue'
import ChangePhone from '@/components/account/ChangePhone.vue'

export default {
  name: 'ProfileView',
  components: {
    SideBar,
    AccountDeletionModal,
    ChangePassword,
    ChangePhone
  },
  data() {
    return {
      isDeleteAccountModalOpen: false,
      isPasswordModalOpen: false,
      isPhoneModalOpen: false
    }
  },
  computed: {
    ...mapState(useAuthStore, ['getUser'])
  },

}
</script>
