<template>
  <!-- Cart -->
  <Popover class="p-2 flow-root text-sm lg:relative">
    <PopoverButton :disabled="cart.items.length == 0" class="group -m-2 flex items-center p-2 rounded">
      <ShoppingCartIcon
        class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
        aria-hidden="true"
      />
      <span
        class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800"
        >{{ cart.items.length }}</span
      >
      <span class="sr-only">items in cart, view cart</span>
    </PopoverButton>
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <PopoverPanel
        v-slot="{ close }"
        class="absolute inset-x-0 top-16 mt-px bg-white pb-6 shadow-lg sm:px-2 lg:left-auto lg:right-0 lg:top-full lg:-mr-1.5 lg:mt-3 lg:w-80 lg:rounded-lg lg:ring-1 lg:ring-black lg:ring-opacity-5"
      >
        <h2 class="sr-only">Shopping Cart</h2>

        <div class="mx-auto max-w-2xl px-4">
          <ul role="list" class="divide-y divide-gray-200">
            <li
              v-for="item in cart.items"
              class="flex flex-col py-6 space-y-4"
            >
              <div class="flex flex-row items-center">
                <img
                  :src="item.product.imageUrl"
                  class="h-16 w-16 flex-none rounded-md border border-gray-200 object-cover"
                />
                <div class="ml-4 flex-auto">
                  <h3 class="font-medium text-gray-900">
                    <a :href="item.product.href">{{ item.product.name }}</a>
                  </h3>
                </div>
              </div>
              <div class="ml-auto">
                <div class="relative flex items-center max-w-[8rem]">
                  <button @click="remove(item.product.id, close)" type="button" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-9 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                    <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                    </svg>
                  </button>
                  <input @change="(e) => changeCount(e, item.product.id, close)" type="text" class="bg-gray-50 border-x-0 border-gray-300 h-9 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5" placeholder="999" :value="item.quantity"/>
                  <button @click="add(item.product.id)" type="button" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-9 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                    <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                  </button>
                </div>
              </div>
            </li>
          </ul>

          <a
            href="/checkout"
            type="submit"
            class="block w-full rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 text-center"
          >Checkout</a>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>

<script setup>
import {
  Popover,
  PopoverButton,
  PopoverPanel,
} from "@headlessui/vue";
import { ShoppingCartIcon } from "@heroicons/vue/24/outline";
import { reactive, onMounted } from 'vue';

const cart = reactive({
    items: Number,
    total: Number,
});

onMounted(() => {
    window.fetchCartDetails();
});

window.addEventListener('cartdetails', (e) => {
    Object.assign(cart, e.detail.data);
});

window.addEventListener('cartchange', (e) => {
    window.updateCartDetails(cart);
});

function add(productId) {
    window.addToCart(productId);
}

function remove(productId, closePopover) {
    window.removeFromCart(productId);

    if (cart.items.length == 0) {
        closePopover();
    }
}

function changeCount(e, productId, closePopover) {
    window.changeCartProductCount(productId, e.target.value);

    if (cart.items.length == 0) {
        closePopover();
    }
}
</script>
