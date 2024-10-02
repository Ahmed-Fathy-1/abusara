<template>
  <section>
    <div
      class="relative w-full"
      @mouseover="showNavButtons = true"
      @mouseout="showNavButtons = false"
    >
      <carousel
        ref="myCarousel"
        :transition="500"
        :items-to-show="1"
        wrapAround
        pauseAutoplayOnHover
      >
        <slide v-for="banner in banners" :key="banner.id">
          <div class="carousel__item">
            <img class="object-cover banner__iamge w-full" :src="banner.image" />
            <div class="carousel__text  px-4 lg:px-16 text-start text-white text-balance">
              <h2 class="text-xl lg:text-5xl font-secondary mb-2 text-primary">
                {{ banner.title }}
              </h2>
              <p class="text-sm lg:text-xl text-balance" :class="`text-[${banner.textColor}]`">
                {{ banner.description }}
              </p>
              <RouterLink
                :to="`/products/${category[0].slug_url}`"
                class="bg-primary hover:bg-lime-600 p-2 rounded-md mt-4 text-xs lg:text-sm inline-block"
                >Order Now</RouterLink
              >
            </div>
          </div>
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

<style scoped>
.carousel__item {
  position: relative;
  max-height: calc(100vh - 121.333px);
  width: 100%;
  display: flex;
  align-items: center;
}

.carousel__item::before {
  content: '';
  width: 100%;
  height: 100%;
  background: rgb(0, 0, 0);
  background: linear-gradient(
    99deg,
    rgba(0, 0, 0, 0.6812850140056023) 40%,
    rgba(255, 255, 255, 0.20229341736694673) 100%
  );
  position: absolute;
}

.carousel__text {
  position: absolute;
}

/* .carousel__slide {
  
} */

.carousel__prev,
.carousel__next {
  fill: rgb(0, 0, 0);
  box-sizing: content-box;
  background-color: rgba(255, 255, 255, 0.29);
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

.banner__iamge {
  height: 100vh;
}
</style>

<script>
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import { RouterLink } from 'vue-router'

export default {
  name: 'App',
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
    RouterLink
  },
  props: ['banners', 'category'],
  data() {
    return {
      showNavButtons: false
    }
  },

  // mounted(){
  //   setTimeout(() => {
  //   console.log("banners", this.banners);

  //   }, 2000);
  // },

  methods: {
    next() {
      this.$refs.myCarousel.next()
    },
    prev() {
      this.$refs.myCarousel.prev()
    }
  }, 

}
</script>
