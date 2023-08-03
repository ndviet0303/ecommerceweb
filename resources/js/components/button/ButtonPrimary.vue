<template>
    <button @click="onClick" :class="classes" :disabled="disabled"
        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
        {{ label }}
    </button>
</template>
  
<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps(["label", "onClick", "classes", "disabled"]);
const emits = defineEmits();
</script>