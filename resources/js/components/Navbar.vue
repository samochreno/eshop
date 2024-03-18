<template>
  <Disclosure as="nav" class="bg-white shadow z-50" v-slot="{ open }">
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
      <div class="flex h-16 justify-between">
        <div class="flex px-2 lg:px-0">
          <a :href="props.homeHref" class="flex-shrink-0 flex items-center text-3xl font-semibold">{{ props.name }}</a>
          <div class="hidden lg:ml-12 lg:flex lg:space-x-8">
            <a
              v-for="page in props.pages"
              :href="page.href"
              :class="[page.isActive ? activePageAnchorClass : inactivePageAnchorClass]"
            >{{ page.name }}</a>
          </div>
        </div>
        <div class="flex space-x-2 items-center lg:hidden">
          <!-- Mobile menu button -->
          <cart></cart>

          <DisclosureButton
            class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
          >
            <span class="absolute -inset-0.5" />
            <span class="sr-only">Open main menu</span>
            <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>
        <div class="hidden lg:flex lg:items-center">
          <cart></cart>

          <!-- Profile dropdown -->
          <Menu as="div" class="relative ml-4 flex-shrink-0">
            <div>
              <a v-if="props.user == null" href="/sign-in" class="pl-1 pr-2 py-1 group relative flex rounded bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <span class="absolute -inset-1.5" />

                <UserIcon class="mr-1.5 inline-block aspect-square h-6 w-6 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                <span class="font-medium">Sign in</span>
              </a>
              <MenuButton v-else class="pl-1 pr-2 py-1 group relative flex rounded bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <span class="absolute -inset-1.5" />
                <span class="sr-only">Open user menu</span>

                <UserIcon class="mr-2 inline-block aspect-square h-6 w-6 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                <span class="font-medium">{{ props.user.name }}</span>
              </MenuButton>
            </div>
            <transition
              enter-active-class="transition ease-out duration-100"
              enter-from-class="transform opacity-0 scale-95"
              enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition ease-in duration-75"
              leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95"
            >
              <MenuItems
                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
              >
                <MenuItem v-slot="{ active }">
                  <a
                    v-if="props.user.isAdmin"
                    href="/admin"
                    :class="[
                      active ? 'bg-gray-100' : '',
                      'block px-4 py-2 text-sm text-gray-700',
                    ]"
                  >Dashboard</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a
                    href="/sign-out"
                    :class="[
                      active ? 'bg-gray-100' : '',
                      'block px-4 py-2 text-sm text-gray-700',
                    ]"
                  >Sign out</a>
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </div>

    <DisclosurePanel class="lg:hidden">
      <div class="space-y-1 pb-3 pt-2">
        <!-- Current: "bg-indigo-50 border-indigo-500 text-indigo-700", Default: "border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800" -->
        <DisclosureButton
          v-for="page in props.pages"
          as="a"
          :href="page.href"
          :class="[page.isActive ? activePageButtonClass : inactivePageButtonClass]"
          >{{ page.name }}</DisclosureButton
        >
      </div>
      <div v-if="props.user == null" class="border-t border-gray-200 py-3">
        <div class="space-y-1">
          <DisclosureButton
            as="a"
            href="/sign-in"
            class="group block px-4 py-2 text-base font-medium hover:bg-gray-100"
          >
              <UserIcon class="mr-1 inline-block aspect-square h-6 text-gray-400 group-hover:text-gray-600" aria-hidden="true" />
              <span class="text-gray-600 group-hover:text-gray-800">Sign in</span>
          </DisclosureButton>
        </div>
      </div>
      <div v-else class="border-t border-gray-200 pb-3 pt-4">
        <div class="flex items-center px-4">
          <div class="flex-shrink-0">
            <UserIcon class="inline-block aspect-square h-6 w-6 text-gray-500" aria-hidden="true" />
          </div>
          <div class="ml-3">
            <div class="text-base font-medium text-gray-800">
                {{ props.user.name }}
            </div>
            <div class="text-sm font-medium text-gray-500">{{ props.user.email }}</div>
          </div>
        </div>
        <div class="mt-3 space-y-1">
          <DisclosureButton
            v-if="props.user.isAdmin"
            as="a"
            href="/admin"
            class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
            >Dashboard</DisclosureButton
          >
          <DisclosureButton
            as="a"
            href="/sign-out"
            class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
            >Sign out</DisclosureButton
          >
        </div>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>

<script setup>
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  Popover,
  PopoverButton,
  PopoverPanel,
} from "@headlessui/vue";
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid";
import { UserIcon, Bars3Icon, ShoppingCartIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { ref } from 'vue';

const props = defineProps([
    'user',
    'name',
    'homeHref',
    'pages',
]);

const   activePageAnchorClass = ref('inline-flex items-center border-b-2 border-indigo-500  px-1 pt-1 text-sm font-medium text-gray-900');
const inactivePageAnchorClass = ref('inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700');

const   activePageButtonClass = ref('block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700');
const inactivePageButtonClass = ref('block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800');
</script>

