<template>
  <div>
    <HomeCarousel :banners="banners" :category="singleCatigory" />
    <HomeBestOffers :bestOffers="bestOffers" />
    <!-- <HomeCategory :categories="categories"/> -->
    <HomeCategoryProducts v-for="category in categories" :key="category.id" :category="category" />
  </div>
</template>

<script>
import axios from 'axios'
import { url } from '@/config'

import HomeCarousel from '@/components/Home/HomeCarousel.vue'
import HomeCategory from '@/components/Home/HomeCategory.vue'
import HomeBestOffers from '@/components/Home/HomeBestOffers.vue'
import HomeCategoryProducts from '@/components/Home/HomeCategoryProducts.vue'
import { useCategoriesStore } from '@/stores/carigories'
import { mapState, mapActions } from 'pinia'
import { computed, reactive } from 'vue'
import { useHead } from '@vueuse/head'

export default {
  name: 'HomeView',
  components: {
    HomeCarousel,
    HomeCategory,
    HomeBestOffers,
    HomeCategoryProducts
  },

  data() {
    return {
      banners: [],
      title: '',
      description: '',
      keyword: '',
      canonicalUrl: '',
      skemaMarkup: ``,
      categories: [],
      bestOffers: []
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
    ...mapState(useCategoriesStore, ['singleCatigory'])
  },

  beforeRouteEnter(to, from, next) {
    next(async (vm) => {
      await vm.fetchData()
      vm.updateTitle(vm.title)
      console.log(vm.title)
      vm.updateDescription(vm.description)
      vm.updateKeywords(vm.keyword)
      vm.updateCanonicalUrl(vm.canonical_url)
      vm.updateskemamarkup(vm.skemaMarkup.split('\n').slice(1, 22).toString())
    })
  },

  methods: {
    ...mapActions(useCategoriesStore, ['getSingleCatigory']),

    async fetchData() {
      const bannersCategoriesUrl = `${url}/banner`
      await axios
        .get(bannersCategoriesUrl)
        .then((response) => {
          this.banners = response.data.data.banners
          this.title = response.data.data.meta.title
          this.description = response.data.data.meta.description
          this.keyword = response.data.data.meta.keyword
          this.canonicalUrl = response.data.data.meta.canonical_url
          this.skemaMarkup = response.data.data.meta.schema_markup
          console.log(this.skemaMarkup.split('\n').slice(1, 22))
          console.log('banner title : ', this.title)
          this.categories = response.data.data.categoriesProducts
          this.bestOffers = response.data.data.offers
        })
        .catch((error) => {
          console.log(error)
        })
    }
  }
}
</script>
