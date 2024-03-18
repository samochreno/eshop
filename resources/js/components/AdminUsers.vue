<template>
  <div class="px-4 sm:px-6 lg:px-8 mt-10">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Customers</h1>
        <p class="mt-2 text-sm text-gray-700">
          A list of all the customers.
        </p>
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
                  Email
                </th>
                <th
                  scope="col"
                  class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                  Role
                </th>
                <th
                  scope="col"
                  class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                  First name
                </th>
                <th
                  scope="col"
                  class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                  Last name
                </th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <tr
                v-for="user in props.users"
                class="even:bg-gray-50"
              >
                <td
                  class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3"
                >
                  {{ user.id }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden">
                  {{ user.email }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                  {{ user.isAdmin ? 'Admin' : 'Customer' }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden">
                  {{ user.firstName }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-48 text-ellipsis overflow-hidden">
                  {{ user.lastName }}
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
    'users',
]);
</script>
