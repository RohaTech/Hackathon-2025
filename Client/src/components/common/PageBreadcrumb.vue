<script setup lang="ts">
import { defineProps } from "vue";

interface BreadcrumbProps {
  pageTitle: string;
}

defineProps<BreadcrumbProps>();
</script>
<template>
  <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <h2
      class="ark:text-white/90 text-xl font-semibold text-gray-800"
      x-text="pageTitle"
    >
      {{ pageTitle }}
    </h2>
    <nav>
      <ol class="flex items-center gap-1.5">
        <li>
          <RouterLink
            class="ark:text-gray-400 inline-flex items-center gap-1.5 text-sm text-gray-500"
            :to="{ name: 'Home' }"
          >
            Home
            <svg
              class="stroke-current"
              width="17"
              height="16"
              viewBox="0 0 17 16"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
                stroke=""
                stroke-width="1.2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </RouterLink>
        </li>
        <li class="ark:text-white/90 text-sm text-gray-800">
          {{ pageTitle }}
        </li>
      </ol>
    </nav>
  </div>
</template>
