<template>
  <section class="container my-5 rounded" v-if="bestOffers.length > 0">
    <div class="w-full">
      <h2 class="text-gray-800 text-center text-lg lg:text-xl py-1 rounded-t offers__tite">
        Our Best Offers
      </h2>
      <div class="image">
        <img src="./../../assets/images/icons/knife (1).png" alt="..." />
      </div>
    </div>

    <div
      class="py-3 px-3"
      @mouseover.prevent="showNavButtons = true"
      @mouseout="showNavButtons = false"
    >
      <carousel ref="myCarousel" v-bind="settings" :breakpoints="breakpoints">
        <slide clsss="carousel__item" v-for="(offer, index) in bestOffers" :key="offer.id">
          <GlobalCard :product="offer" />
        </slide>
        <template #addons>
          <button v-show="showNavButtons" class="carousel__prev" @click="prev">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              height="24"
              width="24"
              viewBox="0 0 320 512"
            >
              <path
                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"
              />
            </svg>
          </button>
          <button v-show="showNavButtons" class="carousel__next" @click="next">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              height="24"
              width="24"
              viewBox="0 0 320 512"
            >
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

export default {
  name: 'HomeBestOffers',
  components: {
    Carousel,
    Slide
  },
  props: ['bestOffers'],
  data() {
    return {
      settings: {
        itemsToShow: 2
      },
      breakpoints: {
        // 375: {
        //   itemsToShow: 1
        // },
        641: {
          itemsToShow: 1
        },
        1024: {
          itemsToShow: 5,
          snapAlign: 'center'
        },
        1280.999999: {
          itemsToShow: 4,
          snapAlign: 'center'
        }
      },
      showNavButtons: false
    }
  },
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
.carousel__slide[data-v-c3b4c60e] {
  margin-inline: 1.4rem;
}
.offers__tite {
  font-family: fantasy;
  font-size: 30px;
  margin-bottom: 20px;
}
.carousel__item {
  width: 100%;
}

.carousel__slide {
  /* margin-inline: 1.2rem; */
  padding: 0rem;
}
.carousel__slide[data-v-c3b4c60e] {
  margin-inline: 1.4rem;
}

@media (min-width: 800px) {
  .carousel__slide {
    /* margin-inline: 0.5rem; */
  }
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

.image img {
  max-width: 40px;
  max-height: 40px;
}
.image {
  width: 100%;
  display: flex;
  justify-content: center;
  transform: translateY(-15px);
  position: relative;
}

.image::before {
  content: '';
  position: absolute;
  width: 60px;
  height: 1px;
  background-color: #000;
  top: 50%;
  transform: translateX(50px);
}
.image::after {
  content: '';
  position: absolute;
  width: 60px;
  height: 1px;
  background-color: #000;
  top: 50%;
  transform: translateX(-50px);
}
</style>
