<template>
  <BreadCrumb :breadcrumbItems="breadcrumbItems" class="px-32 py-5" />
  <section class="container bg-white my-5">
    <div class="py-10">
      <div class="max-w-6xl px-4 mx-auto">
        <div class="flex flex-wrap mb-24 -mx-4 items-center">
          <div class="w-full px-4 mb-8 md:w-1/2 md:mb-0">
            <ProductImages v-if="product.images" :images="product.images" />
          </div>
          <div class="w-full px-4 md:w-1/2">
            <ProductInfo v-if="product" :product="product" />
          </div>
        </div>
      </div>
      <div class="px-2 mx-auto">
        <SimilarProducts v-if="relatedProducts" :relatedProducts="relatedProducts" />
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios'
import { url } from '@/config'
import ProductImages from '@/components/SingleProduct/ProductImages.vue'
import ProductInfo from '@/components/SingleProduct/ProductInfo.vue'
import SimilarProducts from '@/components/SingleProduct/SimilarProducts.vue'
import { useMetaStore } from '@/stores/seo'
import { mapState, mapActions } from 'pinia'
import { computed, reactive } from 'vue'
import { useHead } from '@vueuse/head'

export default {
  name: 'Single Product',
  computed: {
    ...mapState(useMetaStore, [
      'description',
      'keyword',
      'title',
      'canonical_url',
      'schema_markup',
      'product',
      'breadcrumbItems',
      'relatedProducts'
    ])
  },

  setup() {
    const metastore = useMetaStore()
    const siteData = reactive({
      title: '',
      description: '',
      keyword: '',
      canonicalUrl: ''
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
      ]
    })

    return {
      siteData,
      updateTitle,
      updateDescription,
      updateKeywords,
      updateCanonicalUrl
    }
  },

  components: {
    ProductImages,
    ProductInfo,
    SimilarProducts
  },

  methods: {
    ...mapActions(useMetaStore, ['fetchProduct'])
  },

  beforeRouteEnter(to, from, next) {
    next((vm) => {
      const productId = to.params.id
      vm.fetchProduct(productId).then(() => {
        vm.updateTitle(vm.title)
        vm.updateDescription(vm.description)
        vm.updateKeywords(vm.keyword)
        vm.updateCanonicalUrl(vm.canonical_url)
      })
    })
  },
  beforeRouteUpdate(to, from, next) {
    const productId = to.params.id
    this.fetchProduct(productId).then(() => {
      this.updateTitle(this.title)
      this.updateDescription(this.description)
      this.updateKeywords(this.keywords)
      this.updateCanonicalUrl(this.canonical_url) // Update canonical URL
      console.log('second title: ', this.title)
      next()
    })
  },

  mounted() {
    console.log('Canonical URL: ', this.siteData)
  }
}
</script>
