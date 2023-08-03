<template>
    <div>
        <label :for="name" class="block mb-2 text-sm font-medium text-gray-900">{{ label }}</label>
        <textarea :name="name" :value="modelValue" @input="updateValue" :required="required"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            rows="4"></textarea>
    </div>
</template>
  
<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps(["label", "name", "modelValue", "required"]);
const emits = defineEmits();

function updateValue(event) {
    emits("update:modelValue", event.target.value);
}
</script>
  