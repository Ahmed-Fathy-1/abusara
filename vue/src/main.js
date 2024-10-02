import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import VeeValidatePlugin from './includes/validation'
import App from './App.vue'
import router from './router'
import colors from 'vuetify/util/colors'
// import { useMeta } from 'vue-meta'

//Emitter config
import mitt from 'mitt'
const Emitter = mitt()

//vueusehead config
import { createHead } from '@vueuse/head'
const head = createHead()

// Vuetify
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
  theme: {
    themes: {
      light: {
        colors: {
          primary: '#88b06a',
          secondary: colors.red.lighten4
        }
      }
    }
  }
})

import { GlobalComponents } from './includes/_globals'

const app = createApp(App)
app.use(head)
app.use(router)
app.use(GlobalComponents)
app.use(createPinia())
app.use(createPinia())
app.use(VeeValidatePlugin)
app.use(vuetify)
app.provide('Emitter', Emitter)
app.mount('#app')
