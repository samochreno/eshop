<template>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <h2 class="text-2xl font-semibold tracking-tight text-gray-900">All products</h2>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-x-4 gap-y-10 sm:gap-x-6 md:grid-cols-4 lg:gap-x-8">
                <div v-for="product in products" class="group relative">
                    <div
                        class="h-56 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:h-72 xl:h-80">
                        <img :src="product.imageUrl" class="h-full w-full object-cover object-center"/>
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700">
                        <a :href="product.href">
                            <span class="absolute inset-0"/>
                            {{ product.name }}
                        </a>
                    </h3>
                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ product.price }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps([
    'products'
]);
</script>
