<script setup>
import { ref } from 'vue';

const props = defineProps({
    error: String,

    width: String,
    title: String,

    submitText: String,
    submitUrl: String,

    otherText: String,
    otherUrl: String,
});
</script>

<template>
    <div class="screen-center">
        <div :style="'width: ' + props.width" class="cn px-24">
            <h1 class="mb-12">{{ props.title }}</h1>
            <form :action="props.submitUrl" method="POST" class="h-fit flex-center flex-col">
                <slot></slot>

                <p v-if="error" class="mt-6 mb-6 text-sm text-danger">{{ props.error }}</p>
                <div v-else class="h-12 flex-center"></div>

                <button class="button rounded-full px-6 py-2.5">{{ props.submitText }}</button>
            </form>
            <div class="h-fit mt-4 flex-center">
                <a :href="props.otherUrl" class="hyperlink">{{ props.otherText }}</a>
            </div>
        </div>
    </div>
</template>
