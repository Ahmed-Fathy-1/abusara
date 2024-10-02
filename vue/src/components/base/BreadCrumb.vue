<template>
  <section class="flex justify-center lg:justify-start">
    <nav class="flex" aria-label="Breadcrumb">
      <ol>
        <li v-for="(item, index) in breadcrumbItems" :key="index" class="inline-flex">
          <router-link
            :to="item.link"
            class="text-sm text-ellipsis font-medium text-gray-700 hover:text-primary flex items-center "
          >
            <span v-if="item.showIcon">
              <svg
                class="w-3 h-3 me-2.5"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"
                />
              </svg>
            </span>
            {{ item.text }}
          </router-link>
          <span v-if="index < breadcrumbItems.length - 1" class="mx-1 text-gray-400">></span>
        </li>
      </ol>
    </nav>
  </section>
</template>


<script>
export default {
  name: 'BreadCrumb',
  props: {
    breadcrumbItems: {
      type: Array,
      required: true
    }
  }
}
</script>
