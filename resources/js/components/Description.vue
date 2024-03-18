<template>
  <div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl">
        <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            Project description
        </h2>
        <p class="mt-8 text-lg leading-8 text-gray-600">
          This project was a long-time dream come true for me. I've always wanted to dive into the world of e-commerce, so when the opportunity came up for a school project, I jumped on it.
        </p>
        <p class="mt-4 text-lg leading-8 text-gray-600">
          Building this e-shop website was like bringing my own little online marketplace to life. It was a wild ride from start to finish, full of creative bursts.
        </p>
        <p class="mt-4 text-lg leading-8 text-gray-600">
          This project wasn't just about getting a good grade; it was about fulfilling a passion I've had for ages.
        </p>
      </div>
      <div class="mt-24 mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            Database models
        </h2>
        <p class="mt-4 text-lg leading-8 text-gray-600">
            Description of the database models used for this project.
        </p>
      </div>
      <div
        class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3"
      >
        <article v-for="post in posts" class="flex flex-col items-start">
          <div class="relative w-full">
            <img
              :src="post.imageUrl"
              class="aspect-square w-full rounded-2xl bg-gray-100 object-cover"
            />
            <a
              :href="post.imageUrl"
              target="_blank"
              class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"
            />
          </div>
          <div class="max-w-xl pt-10">
            <div class="group relative">
              <h3
                class="text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600"
              >
                <p>
                  <span class="absolute inset-0" />
                  {{ post.title }}
                </p>
              </h3>
              <p class="mt-4 line-clamp-3 text-sm leading-6 text-gray-600">
                {{ post.description }}
              </p>
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
</template>

<script setup>
const posts = [
  {
    title: 'Conceptual model',
    description: 'This is the conceptual model of the database.',
    imageUrl: '/images/conceptual-model.png',
  },
  {
    title: 'Logical model',
    description: 'This is the logical model of the database.',
    imageUrl: '/images/logical-model.png',
  },
  {
    title: 'Physical model',
    description: 'This is the physical model of the database.',
    imageUrl: '/images/physical-model.png',
  },
];
</script>
