<template>
  <div class="sticky top-0 overflow-hidden">
    <!--Main Image with navigation-->
    <div
      class="relative flex justify-center mb-6 lg:mb-10 lg:h-96"
      ref="mainImageContainer"
      @touchstart="onTouchStart"
      @touchmove="onTouchMove"
    >
      <!--Previous Button-->
      <button
        @click.prevent="prevImage"
        class="absolute left-0 transform lg:ml-2 top-1/2 translate-1/2"
      >
        <i class="fas fa-chevron-left text-xl text-primary"></i>
      </button>
      <!--Main Image-->
      <img
        class="object-contain w-1/2 self-center max-h-96 lg:h-full"
        :src="images[mainImageIndex]"
      />
      <!--Next Button-->
      <button
        @click.prevent="nextImage"
        class="absolute right-0 transform lg:mr-2 top-1/2 translate-1/2"
      >
        <i class="fas fa-chevron-right text-xl text-primary"></i>
      </button>
    </div>
    <!--Small Images-->
    <div class="flex-wrap hidden -mx-2 md:flex">
      <div v-for="(image, index) in images" :key="index" class="w-1/2 p-2 sm:w-1/4">
        <button
          @click="changeMainImage(index)"
          class="block border border-gray-200 hover:border-primary"
        >
          <img class="object-contain w-full lg:h-28" :src="image"/>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SingleProductImages',
  data() {
    return { mainImageIndex: 0, startX: 0, startY: 0 }
  },
  props: ['images'],
  methods: {
    changeMainImage(index) {
      this.mainImageIndex = index
    },
    nextImage() {
      this.mainImageIndex = (this.mainImageIndex + 1) % this.images.length
    },
    prevImage() {
      this.mainImageIndex =
        (this.mainImageIndex - 1 + this.images.length) % this.images.length
    },
    onTouchStart(event) {
      this.startX = event.touches[0].clientX
      this.startY = event.touches[0].clientY
    },
    onTouchMove(event) {
      const deltaX = event.touches[0].clientX - this.startX
      const deltaY = event.touches[0].clientY - this.startY

      const absDeltaX = Math.abs(deltaX)
      const absDeltaY = Math.abs(deltaY)

      if (absDeltaX > absDeltaY) {
        if (absDeltaX > 30) {
          const direction = deltaX > 0 ? 1 : -1

          if (direction === 1) {
            this.prevImage()
          } else {
            this.nextImage()
          }

          event.preventDefault()
        }
      }
    }
  }
}
</script>
