<template>
  <div>
    <Menu ref="userMenu" as="div" class="relative inline-block text-left z-10">
      <div>
        <MenuButton
          class="flex text-slate-600 gap-1 justify-center items-center text-center hover:text-primary capitalize transition duration-300"
        >
          <div class="user-icon">
            <i class="fas fa-user text-xl"></i>
          </div>
          <span class="text-sm">{{ auth.user.name }}</span>
        </MenuButton>
      </div>

      <transition
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0"
      >
        <MenuItems
          class="absolute right-0 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
        >
          <div class="px-1 py-1">
            <div>
              <router-link to="/my-orders">
                <MenuButton
                  class="flex w-full items-center justify-center rounded-md px-2 py-1 text-sm hover:text-primary bg-white"
                >
                  Orders
                </MenuButton>
              </router-link>
            </div>

            <MenuItem>
              <router-link to="/my-profile">
                <MenuButton
                  class="flex w-full items-center justify-center rounded-md px-2 py-1 text-sm hover:text-primary"
                >
                  Profile
                </MenuButton>
              </router-link>
            </MenuItem>
          </div>

          <div class="px-1 py-2">
            <button
              @click.prevent="logOut"
              class="flex justify-center items-center text-center w-full text-slate-500 text-xs hover:text-primary"
            >
              Sign Out
            </button>
          </div>
        </MenuItems>
      </transition>
    </Menu>
  </div>
</template>

<script setup>
import { useAuthStore } from '@/stores/auth'
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'

const auth = useAuthStore()
// console.log(auth.user)
const logOut = async () => {
  await auth.signOut()
}
</script>

<style scoped>
/* .user-icon {
  width: 30px;
  height: 30px;
  border: 1px solid ;
  border-radius: 50%;
} */
</style>
