<template>
  <router-link :to="`/products/${category.id}`" class="text-decoration-none">
    <div
      class="w-32 h-40 rounded overflow-hidden shadow-lg bg-white cursor-pointer hover:bg-gray-100 transition duration-300 hover:scale-105"
    >
      <div class="w-full h-3/4">
        <img class="w-full h-full object-contain" :src="category.image" alt="Category Image" />
      </div>
      <div class="px-4 py-2">
        <div class="font-semibold text-center text-gray-700 text-lg line-clamp-2">
          {{ category.name }}
        </div>
      </div>
    </div>
  </router-link>
</template>

<script>
export default {
  name: 'CategoryCard',
  props: ['category']
}
</script>
