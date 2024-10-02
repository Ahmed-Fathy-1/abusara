<template>
  <section class="my-5 container bg-white py-5 px-3">
    <div class="w-full mb-3">
      <h2 class="text-gray-800 text-center text-lg lg:text-xl py-1 rounded-t">
        Our Top Categories
      </h2>
      <p class="text-center text-xs lg:text-base text-gray-400 text-balance">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ratione expedita maxime
        eveniet veniam libero ea nulla non vero voluptatum quibusdam dolores, praesentium atque
        velit tenetur nisi quaerat quisquam recusandae.
      </p>
    </div>
    <div class="flex justify-center">

    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
      <CategoryCard
        v-for="category in categories"
        :category="category"
        class="w-full"
        :key="category.title"
      />
    </div>
    </div>
  </section>
</template>

<script>
import CategoryCard from './CategoryCard.vue'

export default {
  name: 'HomeCategory',
  props: ['categories'],
  components: { CategoryCard }
}
</script>
