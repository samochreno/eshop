<template>
  <TransitionRoot class="fixed inset-0 z-[90]" :show="open">
    <TransitionChild
      enter="transition-opacity duration-75"
      enterFrom="opacity-0"
      enterTo="opacity-100"
      leave="transition-opacity duration-150"
      leaveFrom="opacity-100"
      leaveTo="opacity-0"
      class="fixed inset-0 top-0 bg-gray-500 bg-opacity-75"
    >
    </TransitionChild>

    <Dialog as="div" class="relative z-[100]" @close="open = false">
      <div class="fixed inset-0" />

      <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
          <div class="pointer-events-none fixed bottom-0 top-0 right-0 flex max-w-full pl-10 sm:pl-16">
            <TransitionChild
              as="template"
              enter="transform transition ease-in-out duration-500 sm:duration-600"
              enter-from="translate-x-full"
              enter-to="translate-x-0"
              leave="transform transition ease-in-out duration-500 sm:duration-600"
              leave-from="translate-x-0"
              leave-to="translate-x-full"
            >
              <DialogPanel class="pointer-events-auto w-screen max-w-2xl z-20">
                <form
                  action="/admin/products/create"
                  method="post"
                  enctype="multipart/form-data"
                  class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl"
                >
                  <input type="hidden" name="_token" :value="csrf()">

                  <div class="flex-1">
                    <!-- Header -->
                    <div class="bg-gray-50 px-4 py-6 sm:px-6">
                      <div class="flex items-start justify-between space-x-3">
                        <div class="space-y-1">
                          <DialogTitle class="text-base font-semibold leading-6 text-gray-900">Create a new product</DialogTitle>
                          <p class="text-sm text-gray-500">Get started by filling in the information below to create a new product.</p>
                        </div>
                        <div class="flex h-7 items-center">
                          <button type="button" class="relative text-gray-400 hover:text-gray-500" @click="open = false">
                            <span class="absolute -inset-2.5" />
                            <span class="sr-only">Close panel</span>
                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                          </button>
                        </div>
                      </div>
                    </div>

                    <!-- Divider container -->
                    <div class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">
                      <div class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                        <div>
                          <label for="name" class="block text-sm font-medium leading-6 text-gray-900 sm:mt-1.5">Name</label>
                        </div>
                        <div class="sm:col-span-2">
                          <input type="text" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                      </div>

                      <div class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                        <div>
                          <label for="description" class="block text-sm font-medium leading-6 text-gray-900 sm:mt-1.5">Description</label>
                        </div>
                        <div class="sm:col-span-2">
                          <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                      </div>

                      <div class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                        <div>
                          <label for="price" class="block text-sm font-medium leading-6 text-gray-900 sm:mt-1.5">Price</label>
                        </div>
                        <div class="sm:col-span-1">
                          <div
                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                          >
                            <span
                              class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"
                              >$</span
                            >
                            <input
                              type="text"
                              name="price"
                              id="price"
                              class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                              placeholder="9,999.99"
                            />
                          </div>
                        </div>
                      </div>

                      <div id="image-container" class="invisible absolute space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                        <div>
                          <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                        </div>
                        <div class="sm:col-span-2">
                          <div class="leading-6 flex items-center">
                              <button
                                @click="removeImage"
                                type="button"
                                class="-ml-1 w-7 h-7 text-gray-900 rounded-md border-solid border-gray-900/25 flex justify-center items-center"
                              >
                                <SmallXMarkIcon class="h-4 w-4" aria-hidden="true" />
                              </button>
                              <p id="image-name" class="block text-sm text-gray-600 font-semibold underline"></p>
                          </div>
                        </div>
                      </div>

                      <div id="upload-image-container" class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2 px-4 sm:px-6 sm:py-5">
                        <div class="col-span-full">
                          <label
                            for="upload-image"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Image</label
                          >
                          <div
                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
                          >
                            <div class="text-center">
                              <PhotoIcon
                                class="mx-auto h-12 w-12 text-gray-300"
                                aria-hidden="true"
                              />
                              <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label
                                  for="upload-image"
                                  class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500"
                                >
                                  <span>Upload an image</span>
                                  <input
                                    id="upload-image"
                                    name="image"
                                    type="file"
                                    class="sr-only"
                                    @change="uploadImage"
                                  />
                                </label>
                                <p class="pl-1">or drag and drop</p>
                              </div>
                              <p class="text-xs leading-5 text-gray-600">
                                PNG, JPG, JPEG
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Action buttons -->
                  <div class="flex-shrink-0 border-t border-gray-200 px-4 py-5 sm:px-6">
                    <div class="flex justify-end space-x-3">
                      <button type="button" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" @click="open = false">Cancel</button>
                      <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
                    </div>
                  </div>
                </form>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon as SmallXMarkIcon } from '@heroicons/vue/16/solid'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { PhotoIcon } from '@heroicons/vue/20/solid'

const props = defineProps([
    'products',
]);

const open = ref(false);

function csrf() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

window.addEventListener('opencreateproduct', () => {
    open.value = true;
});

function uploadImage(e) {
    if (e.target.files.length != 1) {
        e.target.value = null;
        return;
    }

    const name = e.target.files[0].name;
    const extension =
        name.substr(name.lastIndexOf('.') + 1, name.length).toLowerCase();

    if (
        extension != 'png' &&
        extension != 'jpg' &&
        extension != 'jpeg'
    ) {
        e.target.value = null;
        return;
    }

    const imageContainer       = document.getElementById('image-container');
    const uploadImageContainer = document.getElementById('upload-image-container');
    const imageName            = document.getElementById('image-name');

    imageContainer.classList.remove('invisible');
    imageContainer.classList.remove('absolute');

    uploadImageContainer.classList.add('invisible');
    uploadImageContainer.classList.add('absolute');

    imageName.textContent = e.target.files[0].name;
}

function removeImage(e) {
    const image                = document.getElementById('upload-image');
    const imageContainer       = document.getElementById('image-container');
    const uploadImageContainer = document.getElementById('upload-image-container');

    imageContainer.classList.add('invisible');
    imageContainer.classList.add('absolute');

    uploadImageContainer.classList.remove('invisible');
    uploadImageContainer.classList.remove('absolute');

    image.value = null;
}
</script>
