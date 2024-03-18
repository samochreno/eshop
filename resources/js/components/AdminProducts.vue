<template>
  <div class="px-4 sm:px-6 lg:px-8 mt-10">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Products</h1>
        <p class="mt-2 text-sm text-gray-700">
            A list of all products.
        </p>
      </div>
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <button
          @click="openCreate"
          type="button"
          class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >Create product</button>
      </div>
    </div>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr>
                <th
                  scope="col"
                  class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3"
                >
                  ID
                </th>
                <th
                  scope="col"
                  class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                  Name
                </th>
                <th
                  scope="col"
                  class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                  Price
                </th>
                <th
                  scope="col"
                  class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                  Description
                </th>
                <th
                  scope="col"
                  class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                  Image
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <tr
                v-for="product in props.products"
                class="even:bg-gray-50"
              >
                <td
                  class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3"
                >
                  {{ product.id }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden">
                  {{ product.name }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden">
                  {{ product.price }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden">
                  {{ product.description }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden">
                  {{ product.imageUrl }}
                </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                  <a
                    @click="openDelete(product.id)"
                    class="cursor-pointer text-red-600 hover:text-red-900"
                  >Delete<span class="sr-only">, {{ product.name }}</span></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps([
    'products',
]);

function openCreate() {
    window.dispatchEvent(new Event('opencreateproduct'));
}

function openDelete(productId) {
    window.dispatchEvent(new CustomEvent('opendeleteproduct', {
        detail: {
            productId: productId,
        }
    }));
}
</script>
