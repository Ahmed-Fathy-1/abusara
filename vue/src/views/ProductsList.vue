<template>
  <BreadCrumb :breadcrumbItems="breadcrumbItems" class="px-32 py-5" />
  <section class="container my-5 rounded-md bg-white text-gray-700 py-5">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
        <div class="text-center">
          <h2 class="font-semibold text-xl lg:text-3xl">{{ category?.name }}</h2>
        </div>
        <div
          class="flex justify-between items-center lg:justify-center lg:items-center gap-2 flex-wrap"
        >
          <select
            v-model="sortBy"
            class="block py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-primary rounded"
          >
            <option value="" selected disabled>Sort by</option>
            <option value="1">Price low to high</option>
            <option value="2">Price high to low</option>
            <option value="3">A - Z</option>
            <option value="4">Z - A</option>
          </select>
          <select
            v-model="filterBy"
            class="block py-1.5 px-3 text-gray-800 border border-gray-300 transition duration-500 focus:outline-none focus:border-primary rounded"
          >
            <option value="" selected disabled>Filter by</option>
            <option value="1">Available Products</option>
          </select>
        </div>
      </div>

      <!--List Of Products-->
      <div class="mt-10 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-4 lg:mt-16">
        <GlobalCard v-for="(product, index) in paginatedProducts" :key="index" :product="product" />
      </div>

      <!--Pagination-->
      <div class="mt-5 flex justify-center">
        <nav aria-label="Page navigation example">
          <ul class="inline-flex -space-x-px text-sm">
            <li>
              <a
                @click="previousPage"
                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
                >Previous</a
              >
            </li>
            <!-- Dynamically generate pagination items -->
            <li v-for="page in pages" :key="page">
              <a
                @click="goToPage(page)"
                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
                :class="{ 'bg-gray-200 text-gray-900': page === currentPage }"
                >{{ page }}</a
              >
            </li>
            <li>
              <a
                @click="nextPage"
                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
                >Next</a
              >
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </section>
</template>

<script>
import { url } from '@/config'
import axios from 'axios'
import { computed, reactive } from 'vue'
import { useHead } from '@vueuse/head'


export default {
  name: 'HomeLatestProducts',
  data() {
    return {
      category: {},
      products: [],
      breadcrumbItems: [
        { text: 'Home', link: '/', showIcon: true },
        { text: 'Products List', link: '#' }
      ],
      sortBy: '',
      filterBy: '',
      currentPage: 1,
      itemsPerPage: 10,
      title: '',
      description: '',
      keyword: '',
      canonicalUrl: '',
      skemaMarkup: ``
    }
  },

  setup() {
    const siteData = reactive({
      title: '',
      description: '',
      keyword: '',
      canonicalUrl: '',
      skemamarkup: ``
    })

    const updateTitle = (title) => {
      siteData.title = title
      document.title = title
    }

    const updateDescription = (description) => {
      siteData.description = description
    }

    const updateKeywords = (keyword) => {
      siteData.keyword = keyword
    }

    const updateCanonicalUrl = (canonicalUrl) => {
      siteData.canonicalUrl = canonicalUrl
    }

    const updateskemamarkup = (skemamarkup) => {
      siteData.skemamarkup = skemamarkup
    }

    useHead({
      title: computed(() => siteData.title),
      meta: [
        {
          name: `description`,
          content: computed(() => siteData.description)
        },
        {
          name: 'keywords',
          content: computed(() => siteData.keyword)
        }
      ],
      links: [
        {
          rel: 'canonical',
          href: computed(() => siteData.canonicalUrl)
        }
      ],
      script: [
        {
          type: 'application/ld+json',
          innerHTML: computed(() => siteData.skemamarkup)
        }
      ]
    })

    return {
      siteData,
      updateTitle,
      updateDescription,
      updateKeywords,
      updateCanonicalUrl,
      updateskemamarkup
    }
  },

  computed: {
    filteredProducts() {
      let filtered = [...this.products]

      // Apply sorting
      if (this.sortBy === '1') {
        filtered.sort((a, b) => parseFloat(a.price) - parseFloat(b.price))
      } else if (this.sortBy === '2') {
        filtered.sort((a, b) => parseFloat(b.price) - parseFloat(a.price))
      } else if (this.sortBy === '3') {
        filtered.sort((a, b) => a.title.localeCompare(b.title))
      } else if (this.sortBy === '4') {
        filtered.sort((a, b) => b.title.localeCompare(a.title))
      }

      // Apply filtering
      if (this.filterBy === '1') {
        filtered = filtered.filter((product) => product.available)
      }

      return filtered
    },

    pages() {
      const totalProducts = this.filteredProducts.length
      const totalPages = Math.ceil(totalProducts / this.itemsPerPage)
      return Array.from({ length: totalPages }, (_, index) => index + 1)
    },

    paginatedProducts() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage
      const endIndex = startIndex + this.itemsPerPage
      return this.filteredProducts.slice(startIndex, endIndex)
    }
  },

  methods: {
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--
      }
    },

    nextPage() {
      const totalPages = this.pages.length
      if (this.currentPage < totalPages) {
        this.currentPage++
      }
    },

    goToPage(pageNumber) {
      this.currentPage = pageNumber
    },

    async fetchProducts(categoryId) {
      try {
        const response = await axios.get(`${url}/category/${categoryId}`)
        this.category = response.data.data.category
        this.products = response.data.data.products
        this.title = response.data.data.meta.title
        this.description = response.data.data.meta.description
        this.keyword = response.data.data.meta.keyword
        this.canonicalUrl = response.data.data.meta.canonical_url
        this.skemaMarkup = response.data.data.meta.schema_markup
        console.log()
      } catch (error) {
        console.log(error)
      }

      console.log(this.category)
      console.log(this.products)
    }
  },

  beforeRouteEnter(to, from, next) {
    const categoryId = to.params.id
    next(async (vm) => {
      await vm.fetchProducts(categoryId)
      vm.updateTitle(vm.title)
      console.log(vm.title)
      vm.updateDescription(vm.description)
      vm.updateKeywords(vm.keyword)
      vm.updateCanonicalUrl(vm.canonical_url)
      vm.updateskemamarkup(vm.skemaMarkup.split('\n').slice(1, 22).toString())
    })
  },

  beforeRouteUpdate(to, from, next) {
    const categoryId = to.params.id
    this.fetchProducts(categoryId)
    next()
  }
}
</script>
