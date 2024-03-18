<script setup>
import { ref } from 'vue';

const props = defineProps({
    products: Array,
});

const columnCount = ref(calculateColumnCount());

window.addEventListener('resize', () => {
    columnCount.value = calculateColumnCount();
});

function calculateColumnCount() {
    if (window.innerWidth > 1450) {
        return 4;
    }

    if (window.innerWidth > 1150) {
        return 3;
    }

    if (window.innerWidth > 800) {
        return 2;
    }

    return 1;
}

function isRight(index) {
    return (index - columnCount.value + 1) % columnCount.value == 0;
}

function isBottom(index) {
    const remainder = props.products.length % columnCount.value;
    return index >= (props.products.length - remainder);
}

function getGridStyle() {
    return {
        display: 'grid',
        gridTemplateColumns: 'repeat(' + columnCount.value + ', minmax(0, 1fr))',
    };
}

function getGridProductStyle(index) {
    let value = '';

    value += isRight (index) ? '0' : '-1px';
    value += ' ';
    value += isBottom(index) ? '0' : '-1px';
    value += ' ';
    value += 'var(--color-detail-soft)';
    value += ' ';
    value += 'inset';

    return { boxShadow: value };
}
</script>

<template>
    <div :style="getGridStyle()" class="cn screen grid">
        <article
            v-for="(product, index) in props.products"
            :style="getGridProductStyle(index)"
            class="h-fit p-6 flex flex-col"
        >
            <a :href="product.url" class="w-full flex-grow flex flex-col">
                <div class="aspect-square bg-tertiary rounded-xl"></div>

                <div class="h-28">
                    <span class="block mt-6 mb-2 text-md font-semibold hover:underline">{{ product.name }}</span>
                    <span class="block text-left text-sm">{{ product.category }}</span>
                </div>
            </a>
            <div class="h-10 flex-center">
                <a :href="product.url" class="flex-grow text-lg font-semibold">{{ product.price }}</a>
                <button class="button flex-center text-sm">
                    <span class="material-symbols-rounded h-full mr-1">add_shopping_cart</span>
                    Add to cart
                </button>
            </div>
        </article>
    </div>
</template>
