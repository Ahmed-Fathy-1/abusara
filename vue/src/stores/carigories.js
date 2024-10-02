import { defineStore } from 'pinia'
import axios from 'axios'
import { url } from '@/config'

export const useCategoriesStore = defineStore('useCategoriesStore', {
  state: () => ({
    singleCatigory: []
  }),

  actions: {
    getSingleCatigory() {
      const allcatigories = `${url}/category`
      axios
        .get(allcatigories)
        .then((response) => {
          this.singleCatigory = response.data.data
        })
        .catch((error) => {
          console.log(error)
        })
    }
  }
})
