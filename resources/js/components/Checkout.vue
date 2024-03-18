<template>
  <div class="bg-white">
    <!-- Background color split screen for large screens -->
    <div
      class="fixed left-0 top-0 hidden h-full w-1/2 bg-white lg:block"
      aria-hidden="true"
    />
    <div
      class="fixed right-0 top-0 hidden h-full w-1/2 bg-gray-50 lg:block"
      aria-hidden="true"
    />

    <div
      class="relative mx-auto grid max-w-7xl grid-cols-1 gap-x-16 lg:grid-cols-2 lg:px-8 xl:gap-x-48"
    >
      <h1 class="sr-only">Order information</h1>

      <section
        aria-labelledby="summary-heading"
        class="bg-gray-50 px-4 pb-10 pt-16 sm:px-6 lg:col-start-2 lg:row-start-1 lg:bg-transparent lg:px-0 lg:pb-16"
      >
        <div class="mx-auto max-w-lg lg:max-w-none">
          <h2 id="summary-heading" class="text-lg font-medium text-gray-900">
            Order summary
          </h2>

          <ul
            role="list"
            class="divide-y divide-gray-200 text-sm font-medium text-gray-900"
          >
            <li
              v-for="item in cart.items"
              class="flex items-start space-x-4 py-6"
            >
              <img
                :src="item.product.imageUrl"
                class="h-20 w-20 flex-none rounded-md object-cover object-center"
              />
              <div class="flex-auto space-y-1">
                <h3>{{ item.product.name }}</h3>
              </div>
              <div class="flex-none h-full flex flex-col">
                <p class="w-full text-right text-base font-medium">{{ item.total }}</p>
                <div class="mt-4">
                  <div class="relative flex items-center max-w-[8rem]">
                    <button @click="remove(item.product.id)" type="button" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-9 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                      <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                      </svg>
                    </button>
                    <input @change="(e) => changeCount(e, item.product.id)" type="text" class="bg-gray-50 border-x-0 border-gray-300 h-9 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5" placeholder="999" :value="item.quantity"/>
                    <button @click="add(item.product.id)" type="button" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-9 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                      <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </li>
          </ul>

          <dl class="hidden lg:block pt-6 text-sm font-medium text-gray-900">
            <div class="flex items-center justify-between border-t border-gray-200 pt-6">
              <dt class="text-base">Total</dt>
              <dd class="text-base">{{ cart.total }}</dd>
            </div>
          </dl>

          <div class="fixed inset-x-0 bottom-0 flex flex-col-reverse text-sm font-medium text-gray-900 lg:hidden">
            <div
              class="relative z-10 border-t border-gray-200 bg-white px-4 sm:px-6"
            >
              <div class="mx-auto max-w-lg">
                <div
                  class="flex w-full items-center py-6 font-medium"
                >
                  <span class="mr-auto text-base">Total</span>
                  <span class="mr-2 text-base">$361.80</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <form
        id="checkout-form"
        @submit="submit"
        :action="props.action"
        method="post"
        class="px-4 pb-36 pt-16 sm:px-6 lg:col-start-1 lg:row-start-1 lg:px-0 lg:pb-16"
      >
       <input type="hidden" name="_token" :value="csrf()">

       <input id="cart" type="hidden" name="cart">
        <div class="mx-auto max-w-lg lg:max-w-none">
          <section v-if="props.user == null" aria-labelledby="contact-info-heading">
            <h2
              id="contact-info-heading"
              class="text-lg font-medium text-gray-900"
            >
              Contact information
            </h2>

            <div class="mt-6">
              <label
                for="email-address"
                class="block text-sm font-medium text-gray-700"
                >Email address</label
              >
              <div class="mt-1">
                <input required
                  type="email"
                  id="email-address"
                  name="email"
                  autocomplete="email"
                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
              </div>
            </div>
          </section>

          <section aria-labelledby="shipping-heading" class="mt-10">
            <h2 id="shipping-heading" class="text-lg font-medium text-gray-900">
              Shipping address
            </h2>

            <div class="mt-6 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-3">
              <div class="sm:col-span-3">
                <label
                  for="address"
                  class="block text-sm font-medium text-gray-700"
                  >Address</label
                >
                <div class="mt-1">
                  <input required
                    type="text"
                    id="address"
                    name="address"
                    autocomplete="street-address"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                  />
                </div>
              </div>

              <div>
                <label
                  for="city"
                  class="block text-sm font-medium text-gray-700"
                  >City</label
                >
                <div class="mt-1">
                  <input required
                    type="text"
                    id="city"
                    name="city"
                    autocomplete="address-level2"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                  />
                </div>
              </div>

              <div>
                <label
                  for="region"
                  class="block text-sm font-medium text-gray-700"
                  >State / Province</label
                >
                <div class="mt-1">
                  <input required
                    type="text"
                    id="region"
                    name="region"
                    autocomplete="address-level1"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                  />
                </div>
              </div>

              <div>
                <label
                  for="postal-code"
                  class="block text-sm font-medium text-gray-700"
                  >Postal code</label
                >
                <div class="mt-1">
                  <input required
                    type="text"
                    id="postal-code"
                    name="zip"
                    autocomplete="postal-code"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                  />
                </div>
              </div>
            </div>
          </section>

          <div class="mt-10 border-t border-gray-200 pt-6 flex">
            <div class="flex-grow flex flex-col space-y-3">
                <p v-for="error in props.errors" class="w-full text-red-500 text-sm">{{ error }}</p>
            </div>
            <button
              type="submit"
              class="float-right w-full h-fit rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:order-last sm:ml-6 sm:w-auto"
            >Order</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive, onMounted } from 'vue';

const props = defineProps([
    'errors',
    'user',
    'homeHref',
    'action',
]);

function csrf() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

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

function remove(productId) {
    window.removeFromCart(productId);

    if (cart.items.length == 0) {
        window.location.href = props.homeHref;
    }
}

function changeCount(e, productId) {
    window.changeCartProductCount(productId, e.target.value);

    if (cart.items.length == 0) {
        window.location.href = props.homeHref;
    }
}

function submit() {
    document.getElementById('cart').value = JSON.stringify(parseCart());
    clearCart();
}
</script>
