<template>
  <section>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl text-primary font-secondary"> RM Foods </a>
      <div class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md sm:p-8">
        <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-600 md:text-2xl">
          Forgot your Password?
        </h2>
        <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" action="#">
          <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-500"
              >Your email</label
            >
            <input
              type="email"
              name="email"
              id="email"
              class="bg-gray-50 border border-gray-300 focus:outline-primary text-gray-600 sm:text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
              placeholder="name@email.com"
              required=""
            />
          </div>

          <button
            type="submit"
            class="w-full text-white bg-primary hover:bg-lime-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
          >
            Reset passwod
          </button>
        </form>
      </div>
    </div>
  </section>
</template>

<script></script>
