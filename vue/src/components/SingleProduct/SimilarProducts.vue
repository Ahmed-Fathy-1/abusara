<template>
  <section>
    <div class="w-full">
      <h3 class="text-gray-800 font-medium text-lg lg:text-xl py-2 border-b border-gray-300 text-center lg:text-start px-2">
        Similar Products
      </h3>
    </div>

    <div class="py-3" @mouseover="showNavButtons = true" @mouseout="showNavButtons = false">
      <carousel ref="myCarousel" v-bind="settings" :breakpoints="breakpoints">
        <slide clsss="carousel__item" v-for="(product, index) in relatedProducts" :key="index">
          <GlobalCard :product="product" />
        </slide>
        <template #addons>
          <button v-show="showNavButtons" class="carousel__prev" @click="prev">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 320 512">
              <path
                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"
              />
            </svg>
          </button>
          <button v-show="showNavButtons" class="carousel__next" @click="next">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 320 512">
              <path
                d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"
              />
            </svg>
          </button>
        </template>
      </carousel>
    </div>
  </section>
</template>

<script>
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide } from 'vue3-carousel'

import image1 from '@/assets/images/products/01.jpg'
import image2 from '@/assets/images/products/02.jpg'
import image3 from '@/assets/images/products/03.jpg'
import image4 from '@/assets/images/products/04.jpg'

export default {
  name: 'ProductSimilarProducts',
  components: {
    Carousel,
    Slide
  },
  data() {
    return {

      settings: {
        itemsToShow: 1,
        snapAlign: 'center'
      },
      breakpoints: {
        641: {
          itemsToShow: 2,
          snapAlign: 'center'
        },
        1024: {
          itemsToShow: 3,
          snapAlign: 'center'
        },
        1280.999999: {
          itemsToShow: 5,
          snapAlign: 'center'
        }
      },
      showNavButtons: false
    }
  },
  props: ['relatedProducts'],
  methods: {
    next() {
      this.$refs.myCarousel.next()
    },
    prev() {
      this.$refs.myCarousel.prev()
    }
  }
}
</script>

<style scoped>
.carousel__item {
  padding: 0;
}

.carousel__slide {
  padding: 0;
}
.carousel__prev,
.carousel__next {
  fill: rgb(0, 0, 0);
  box-sizing: content-box;
  background-color: rgba(166, 166, 166, 0.29);
  padding: 0.5rem;
  border-radius: 50%;
  transform-origin: center center;
  transition: all 0.3s ease;
  transform: translateY(0);
}
.carousel__prev:hover,
.carousel__next:hover {
  background-color: rgba(255, 255, 255, 0.7);
  transform: translateY(0) scale(1.2);
}
</style>
