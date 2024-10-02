<template>
  <aside class="w-full h-fit bg-white shadow rounded-md py-5 px-4">
    <div class="flex flex-col">
      <div class="hidden lg:flex flex-col">
        <span class="text-gray-700 pb-1">Hello, {{ user.name }}</span>
      </div>
      <hr class="my-5 border border-gray-200 hidden lg:block" />

      <div class="lg:flex lg:flex-col text-gray-600 lg:w-full">
        <ul class="grid grid-cols-2 lg:flex lg:flex-col gap-2 lg:w-full">
          <li class="col-span-1 flex justify-center lg:justify-start lg:w-full">
            <RouterLink
              to="/my-orders"
              class="flex items-center gap-2 hover:text-white hover:bg-primary rounded-md px-2 py-1 transition duration-300 active:text-white active:bg-primary w-full justify-center lg:justify-start"
              href="#"
            >
              <span><i class="fas fa-clipboard text-xl lg:w-full"></i></span>
              <span>Orders</span>
            </RouterLink>
          </li>
          <li class="col-span-1 flex justify-center lg:justify-start">
            <RouterLink
              to="/my-profile"
              class="flex items-center gap-2 hover:text-white hover:bg-primary rounded-md px-2 py-1 transition duration-300 active:text-white active:bg-primary w-full justify-center lg:justify-start"
              href="#"
            >
              <span><i class="fas fa-user text-xl"></i></span>
              <span>Profile</span>
            </RouterLink>
          </li>
        </ul>
      </div>

      <hr class="my-5 border border-gray-200 hidden lg:block" />

      <button
        @click="logOut"
        class="text-start text-gray-500 hover:text-primary transition duration-300 hidden lg:block"
      >
        Sign Out
      </button>
    </div>
  </aside>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const auth = useAuthStore()
const user = auth.getUser
const logOut = async () => {
  try {
    auth.signOut()
    router.push('/')
  } catch (error) {
    console.log(error)
    return
  }
}
</script>
