<template>
    <div>
        <label :for="name" class="block mb-2 text-sm font-medium text-gray-900 capitalize">{{ label }}</label>
        <select :name="name" :value="modelValue" @input="updateValue" :required="required"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option v-for="(option, index) in options" :key="index" :value="option"> {{ Object.keys(options).find(key =>
                options[key] === option) }}</option>
        </select>
    </div>
</template>
  
<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps(["label", "name", "modelValue", "options", "required"]);
const emits = defineEmits();

function updateValue(event) {
    emits("update:modelValue", event.target.value);
}
</script>
  