<template>
  <footer class="bg-footer footer">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8 footer__content">
      <div class="md:flex md:justify-between">
        <div class="mb-3 md:mb-0">
          <a class="text-xl lg:text-3xl font-secondary text-primary" href="/">Butcher</a>
        </div>
        <div class="grid grid-cols-2 gap-6 lg:gap-24 sm:grid-cols-3">
          <div class="hidden lg:block">
            <h2 class="mb-6 text-sm font-semibold text-white uppercase">Quick Links</h2>
            <ul class="text-gray-300 font-medium">
              <li v-for="category in categories" :key="category.id" class="mb-4">
                <RouterLink :to="`/products/${category.slug_url}`" class="hover:underline">{{
                  category.name
                }}</RouterLink>
              </li>
            </ul>
          </div>
          <div>
            <h2 class="mb-6 text-sm font-semibold text-white uppercase">Business Hours</h2>
            <ul class="text-gray-300 font-medium">
              <li class="mb-4">{{ footerData[0]?.key }} : {{ footerData[0]?.value }}</li>
            </ul>
          </div>
          <div>
            <h2 class="mb-6 text-sm font-semibold text-white uppercase text-center lg:text-start">
              Get in touch
            </h2>
            <div class="flex flex-col sm:flex-row gap-4 items-center lg:items-start">
              <!--Facebook-->
              <a
                href="#"
                target="_blank"
                class="text-center fill-white bg-[#4c68B1] py-4 px-5 rounded-md"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  height="16"
                  width="10"
                  viewBox="0 0 320 512"
                >
                  <path
                    d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"
                  />
                </svg>
              </a>
              <!--Call-->
              <a href="#" class="text-center fill-white bg-primary py-4 px-5 rounded-md">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  height="16"
                  width="16"
                  viewBox="0 0 512 512"
                >
                  <path
                    d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"
                  />
                </svg>
              </a>

              <!--Instagram-->
              <a href="#" class="text-center fill-white bg-[#784C9A] py-4 px-5 rounded-md">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  height="16"
                  width="14"
                  viewBox="0 0 448 512"
                >
                  <path
                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                  />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
        <span class="text-sm text-gray-300 sm:text-center"
          >© 2024
          <a href="https://aitech.net.au/" class="hover:underline hover:text-blue-400">AITech™</a>
          All Rights Reserved.
        </span>
        <div class="flex mt-4 sm:justify-center sm:mt-0">
          <!--Facebook-->
          <a href="#" class="text-gray-300 hover:text-white">
            <svg
              class="w-4 h-4"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 8 19"
            >
              <path
                fill-rule="evenodd"
                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                clip-rule="evenodd"
              />
            </svg>
            <span class="sr-only">Facebook page</span>
          </a>
          <!--Twitter-->
          <a href="#" target="_blank" class="text-gray-300 hover:text-white ms-5">
            <svg
              class="w-4 h-4"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 20 17"
            >
              <path
                fill-rule="evenodd"
                d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                clip-rule="evenodd"
              />
            </svg>
            <span class="sr-only">Twitter page</span>
          </a>
          <!-- LinkedIn link -->
          <a href="#" target="_blank" class="text-gray-300 hover:text-white ms-5">
            <svg
              fill="currentColor"
              class="w-4 h-4"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 448 512"
            >
              <path
                d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"
              />
            </svg>
            <span class="sr-only">LinkedIn profile</span>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'AppFooter',
  props: ['footerData', 'categories']
}
</script>

<style scoped>
.footer {
  background-image: url(./../assets/images/footer/banner-bg.jpg);
  background-size: cover;
  position: relative;
}

.footer::before {
  content: '';
  width: 100%;
  height: 100%;
  position: absolute;
  background-color: #000000d1;
}

.footer__content {
  position: relative;
}
</style>
