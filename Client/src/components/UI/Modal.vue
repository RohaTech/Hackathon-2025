<script setup>
const props = defineProps({
  fullScreenBackdrop: {
    type: Boolean,
    default: false,
  },
});

defineEmits(["close"]);
</script>
<template>
  <div
    class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto overflow-x-hidden"
  >
    <div
      v-if="fullScreenBackdrop"
      class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
      aria-hidden="true"
      @click="$emit('close')"
    ></div>
    <slot name="body"></slot>
  </div>
</template>
