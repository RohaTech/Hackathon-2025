<script setup>
import UserHeading from "@/components/UserLayout/UserHeading.vue";
</script>

<template>
  <UserHeading />
  <div class="min-h-[calc(100vh-200px)]"><slot></slot></div>
</template>
