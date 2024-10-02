<template>
  <section class="mb-5">
    <h2 class="text-gray-700 font-semibold text-xl">Shipping Method</h2>
    <div class="border-gray-300 border rounded-md px-2 py-4 sm:px-6 mt-5">
      <div class="grid grid-cols-2">
        <div
          class="col-span-1 flex justify-center text-center hover:bg-slate-100 hover:text-primary cursor-pointer gap-6"
          v-for="method in shippingMethods"
          :key="method.code"
          :class="{ 'text-primary': method_code === method.code }"
          @click="selectMethod(method.code)"
        >
          <input class="hidden" type="radio" name="delivery_method" :value="method.code" />
          <label :for="method.id" class="flex justify-center flex-col items-center cursor-pointer">
            <i class="fas fa-truck text-xl"></i>
            <p class="font-semibold">{{ method.name }}</p>
            <p>Price: {{ method.price }}</p>
          </label>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'DeliveryMethod',
  data() {
    return {
      method_code: '',
    }
  },
  props: ['selectedMethod', 'shippingMethods'],
  methods: {
    selectMethod(methodCode) {
      this.method_code = methodCode
      this.$emit('method-selected', methodCode)
    }
  }
}
</script>
