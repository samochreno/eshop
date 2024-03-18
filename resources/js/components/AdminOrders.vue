<template>
    <div class="px-4 sm:px-6 lg:px-8 mt-10">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Order
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    A list of all the orders.
                </p>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                >
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
                                    Email
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Address
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    City
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Region
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Postal code
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Total
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                ></th>
                                <th
                                    scope="col"
                                    class="relative py-3.5 pl-3 pr-4 sm:pr-3"
                                >
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr
                                v-for="order in props.orders"
                                class="even:bg-gray-50"
                            >
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3"
                                >
                                    {{ order.id }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden"
                                >
                                    {{ order.email }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden"
                                >
                                    {{ order.address }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden"
                                >
                                    {{ order.city }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden"
                                >
                                    {{ order.region }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden"
                                >
                                    {{ order.zip }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden"
                                >
                                    {{ order.total }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden flex items-center justify-center"
                                >
                                    <button :data-tooltip-target="'tooltip-' + order.id" data-tooltip-placement="left" type="button" class="h-6 w-6">
                                      <InformationCircleIcon class="h-full w-full" aria-hidden="true" />
                                    </button>

                                    <div :id="'tooltip-' + order.id" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        <span v-html="order.items.split('\n').join('<br />')"></span>
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
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
import {
  InformationCircleIcon,
} from '@heroicons/vue/24/outline'
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';

const props = defineProps(["orders"]);

onMounted(() => {
  initFlowbite();
});
</script>
