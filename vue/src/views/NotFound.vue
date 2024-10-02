<template>
  <section class="bg-white w-screen h-screen flex justify-center items-center text-pretty">
    <div class="mx-auto max-w-screen-xl px-10">
      <div class="mx-auto max-w-screen-sm text-center">
        <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary">404</h1>
        <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl">
          Something's missing.
        </p>
        <p class="mb-4 text-lg font-light text-gray-500 text-pretty">
          Sorry, we can't find that page. <br />
          You'll find lots to explore on the home page.
        </p>
        <RouterLink
          to="/"
          href="#"
          class="inline-flex text-white bg-primary hover:bg-lime-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4"
          >Back to Homepage</RouterLink
        >
      </div>
    </div>
  </section>
</template>
