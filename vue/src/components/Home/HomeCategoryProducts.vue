<template>
  <section class="container my-5 rounded main__section">
    <div class="w-full">
      <h2 class="text-gray-800 text-center text-lg lg:text-xl py-1 rounded-t section__title">
        {{ category.name }}
      </h2>
      <div class="image">
        <img src="./../../assets/images/icons/knife (1).png" alt="..." />
      </div>
    </div>

    <div
      class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-6 gap-6 p-3"
    >
      <GlobalCard
        v-for="product in category.products"
        :product="product"
        class="w-full"
        :key="product.id"
      />
    </div>
  </section>
</template>

<script>
export default {
  name: 'HomeLatestProducts',
  props: ['category']
}
</script>

<style scoped>
.section__title {
  font-family: fantasy;
  font-size: 30px;
  margin-bottom: 35px;
  margin-top: 35px;
}

.image img {
  max-width: 40px;
  max-height: 40px;
}
.image {
  width: 100%;
  display: flex;
  justify-content: center;
  transform: translateY(-25px);
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
