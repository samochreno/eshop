<template>
  <main
    class="grid h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8"
  >
    <div class="text-center">
      <h1
        class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl"
      >
        Order successful
      </h1>
      <p class="mt-6 text-base leading-7 text-gray-600">
        Order successfully placed. You will receive an email confirmation shortly.
      </p>
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <a
          href="/home"
          class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
          >Home</a
        >
        <a
          href="/contact"
          class="text-sm font-semibold text-gray-900"
          >Contact<span aria-hidden="true"> &rarr;</span></a
        >
      </div>
    </div>
  </main>
</template>
