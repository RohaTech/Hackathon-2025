<script setup>
import { RouterView } from "vue-router";
import SidebarProvider from "@/layout/SidebarProvider.vue";
</script>

<template>
  <SidebarProvider>
    <RouterView />
  </SidebarProvider>
</template>
