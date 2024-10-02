<template>
  <section class="mb-5">
    <div class="">
      <h2 class="text-gray-700 font-semibold text-xl">Your Order</h2>
      <div class="border-gray-300 border rounded-md px-2 py-4 sm:px-6 mt-5">
        <div
          v-for="order in cartItems"
          :key="order.id"
          class="flex rounded-md bg-white items-center border border-l-4 border-l-primary shadow-sm pl-6 mb-3"
        >
          <img
            class="m-2 h-24 w-28 rounded-md object-cover object-center"
            :src="order.product_id.images[0]"
            alt=""
          />
          <div class="flex w-full flex-col px-4 py-4">
            <span class="font-semibold text-xl capitalize text-gray-700">{{
              order.product_id.name
            }}</span>
            <span class="text-gray-600">{{ order.product_id.category_id.name }}</span>
            <span class="text-gray-600">Qty: {{ order.quantity }}</span>
          </div>
          <div class="flex flex-col items-center pr-6">
            <p class="font-semibold text-primary text-2xl">{{ order.sub_total }}</p>
            <p>AUD</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'ay 7aga',
  props: ['cartItems']
}
</script>
