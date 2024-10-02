import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { useMetaStore } from '@/stores/seo'

// Pages
import HomeView from '@/views/HomeView.vue'
import SingleProductView from '@/views/SingleProductView.vue'
import OrdersView from '@/views/OrdersView.vue'
import ProfileView from '@/views/ProfileView.vue'
import ForgotPasswordView from '@/views/ForgotPassword.vue'
import ProductsListView from '@/views/ProductsList.vue'
import CheckOutView from '@/views/CheckOut.vue'
import WholeSaleRegister from '@/views/WholeSaleRegister.vue'
import OrderPlacementView from '@/views/OrderPlacement.vue'
import NotFoundView from '@/views/NotFound.vue'
import axios from 'axios'
import { url } from '@/config'

const routes = [
  {
    name: 'HomeView',
    path: '/',
    component: HomeView,
    meta: {
      title: 'Checkout',
      description: 'Learn more about our company and team.'
    }
  },
  {
    name: 'SingleProductView',
    path: '/product/:number/:id',
    component: SingleProductView,
    meta: {
      title: 'Checkout',
      description: 'Learn more about our company and team.'
    }
  },

  // {
  //   name: 'OrdersViewVue',
  //   path: '/my-orders',
  //   component: OrdersView,
  //   meta: {
  //     requiresAuth: true,
  //     title: 'My Orders'
  //   }
  // },

  {
    name: 'OrdersViewVue',
    path: '/my-orders',
    component: OrdersView,
    meta: {
      requiresAuth: true,
      title: 'My Orders',
      description: 'Learn more about our company and team.'
    }

    // beforeEnter: async (to, from, next) => {
    //   const token = sessionStorage.getItem('token');
    //   try {
    //     const response = await axios.get(`${url}/checkout/orders`, {
    //       headers: {
    //         Authorization: `Bearer ${token}`
    //       }
    //     });
    //     if (response.status === 200) {
    //       // Store the fetched data in the route's meta field
    //       to.meta.ordersData = response.data.data;
    //       next();
    //     } else {
    //       next('/my-profile');
    //     }
    //   } catch (error) {
    //     console.error('Error fetching data:', error);
    //     next('/my-profile');
    //   }
    // }
  },

  {
    name: 'ProfileView',
    path: '/my-profile',
    component: ProfileView,
    meta: {
      requiresAuth: true,
      title: 'My Profile',
      description: 'Learn more about our company and team.'
    }
  },
  {
    name: 'ForgotPasswordView',
    path: '/forgot-password',
    component: ForgotPasswordView,
    meta: {
      title: 'My Profile',
      description: 'Learn more about our company and team.'
    }
  },
  {
    name: 'ProductsList',
    path: '/products/:id',
    component: ProductsListView,
    meta: {
      title: 'My Profile',
      description: 'Learn more about our company and team.'
    }
  },
  {
    name: 'CheckOut',
    path: '/checkout/',
    component: CheckOutView,
    meta: {
      requiresAuth: true,
      title: 'Checkout',
      description: 'Learn more about our company and team.'
    }
  },
  {
    name: 'WholesaleRegister',
    path: '/wholesale-register',
    component: WholeSaleRegister,
    meta: {
      title: 'Wholesale Register',
      description: 'Learn more about our company and team.'
    }
  },
  {
    name: 'OrderPlacement',
    path: '/order-placement/:id',
    component: OrderPlacementView,
    meta: {
      requiresAuth: true,
      title: 'Order Placement',
      description: 'Learn more about our company and team.'
    }
  },
  {
    name: 'NotFoundView',
    path: '/:catchAll(.*)',
    component: NotFoundView,
    meta: {
      title: 'Order Placement',
      description: 'Learn more about our company and team.'
    }
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    }
    if (to.hash) {
      return {
        el: to.hash,
        behavior: 'smooth'
      }
    }
    return { top: 0 }
  },
  linkExactActiveClass: 'text-primary'
})

// router.beforeEach((to, from, next) => {
//   const hasTitle = to.meta && to.meta.title
//   document.title = hasTitle ? `RM Food | ${to.meta.title}` : 'RM Food'
//   if (!to.meta.requiresAuth) {
//     next()
//     return
//   }

//   const store = useAuthStore()
//   // const metastore = useMetaStore()

//   if (store.isAuthenticated) {
//     next()
//   } else {
//     next({ name: 'HomeView' })
//   }
// })

export default router
