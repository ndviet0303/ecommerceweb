<template>
    <button @click="onClick" :class="classes" :disabled="disabled"
        class="focus:outline-none text-white  font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">
        {{ label }}
    </button>
</template>
  
<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps(["label", "onClick", "classes", "disabled"]);
const emits = defineEmits();
</script>