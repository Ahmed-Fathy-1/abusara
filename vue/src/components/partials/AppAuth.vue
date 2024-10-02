<template>
  <div class="fixed z-10 inset-0 overflow-y-auto" id="modal" :class="hiddenClass">
    <div
      @click="modalVisibility = !modalVisibility"
      class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-800 opacity-75"></div>
      </div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

      <div
        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
        @click.stop
      >
        <div class="py-4 text-left px-6">
          <!--Title-->
          <div class="flex justify-between items-center pb-4">
            <p class="text-2xl font-bold">Your Account</p>
            <!-- Modal Close Button -->
            <div
              class="modal-close cursor-pointer z-50"
              @click.prevent="modalVisibility = !modalVisibility"
            >
              <i class="fas fa-times"></i>
            </div>
          </div>

          <!-- Tabs -->
          <ul class="flex flex-wrap mb-4">
            <li class="flex-auto text-center">
              <a
                @click.prevent="tab = 'login'"
                :class="{
                  'hover:text-white text-white bg-primary': tab === 'login',
                  'hover:text-primary': tab === 'register'
                }"
                class="block rounded py-3 px-4 transition"
                href="#"
                >Login</a
              >
            </li>
            <li class="flex-auto text-center">
              <a
                @click.prevent="tab = 'register'"
                :class="{
                  'hover:text-white text-white bg-primary': tab === 'register',
                  'hover:text-primary': tab === 'login'
                }"
                class="block rounded py-3 px-4 transition"
                href="#"
                >Register</a
              >
            </li>
          </ul>

          <!-- Login Form -->
          <LoginForm v-if="tab === 'login'" />
          <!-- Registration Form -->
          <RegisterForm v-else />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LoginForm from './LoginForm.vue'
import RegisterForm from './RegisterForm.vue'
import useModalStore from '@/stores/authModal'
import { mapState, mapWritableState } from 'pinia'
export default {
  name: 'AppAuth',
  components: {
    LoginForm,
    RegisterForm
  },
  data() {
    return {
      tab: 'login'
    }
  },
  computed: {
    ...mapState(useModalStore, ['hiddenClass']),
    ...mapWritableState(useModalStore, {
      modalVisibility: 'isOpen'
    })
  }
}
</script>

<style></style>
