import { defineStore } from 'pinia'
import axios from 'axios'
import { url } from '@/config'

export const useMetaStore = defineStore('metaStore', {
  state: () => ({
    title: '',
    canonical_url: '',
    keyword: '',
    description: '',
    schema_markup: '',
    product: {},
    relatedProducts: [],
    breadcrumbItems: [
      { text: 'Home', link: '/', showIcon: true },
      { text: '', link: '' },
      { text: '', link: '' }
    ]
  }),
  actions: {
    async fetchProduct(productId) {
      try {
        const response = await axios.get(`${url}/products/${productId}`)
        this.description = response.data.data.meta.description
        this.title = response.data.data.meta.title
        this.keyword = response.data.data.meta.keyword
        this.canonical_url = response.data.data.meta.canonical_url
        console.log(this.canonical_url);
        console.log('product title : ', this.title)
        this.product = response.data.data.product
        this.relatedProducts = response.data.data.simmilerProducts
        console.log(this.product)
        this.breadcrumbItems[1].text = this.product.category_id.name
        this.breadcrumbItems[1].link = `/products/${this.product.category_id.id}`
        this.breadcrumbItems[2].text = this.product.name
      } catch (error) {
        console.log(error)
      }
    }
  }
})
