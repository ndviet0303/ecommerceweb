<template>
    <div>
        <label :for="name" class="block mb-2 text-sm font-medium text-gray-900 capitalize">{{ label }}</label>
        <input :type="type" :name="name" :placeholder="placeholder" :value="modelValue" @input="updateValue"
            :required="required"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    </div>
</template>
  
<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps(["label", "type", "name", "modelValue", "placeholder", "required"]);
const emits = defineEmits();

function updateValue(event) {
    // Khi giá trị của input thay đổi, chúng ta sẽ emit sự kiện update:modelValue để cập nhật giá trị của modelValue
    emits("update:modelValue", event.target.value);
}
</script>
  