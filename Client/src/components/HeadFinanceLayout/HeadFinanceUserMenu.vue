<script setup>
import {
  UserCircleIcon,
  ChevronDownIcon,
  LogoutIcon,
  SettingsIcon,
  InfoCircleIcon,
} from "@/components/UI/Icons";
import { RouterLink } from "vue-router";
import { ref, onMounted, onUnmounted } from "vue";
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();

const dropdownOpen = ref(false);
22;
const dropdownRef = ref(null);

const menuItems = [
  { href: "/", icon: UserCircleIcon, text: "Edit profile" },
  { href: "/", icon: SettingsIcon, text: "Account settings" },
  { href: "/", icon: InfoCircleIcon, text: "Support" },
];

const fallbackImage =
  "https://res.cloudinary.com/dqxy77qks/image/upload/v1747340223/4b42ed27-d4d8-4205-b44b-595b7060097d.png";

const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value;
};

const closeDropdown = () => {
  dropdownOpen.value = false;
};

const signOut = () => {
  authStore.logout();
  closeDropdown();
};

const handleClickOutside = (event) => {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    closeDropdown();
  }
};

onMounted(() => {
  document.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener("click", handleClickOutside);
});
</script>

<template>
  <div class="relative" ref="dropdownRef">
    <button
      class="ark:text-gray-400 flex items-center text-gray-700"
      @click.prevent="toggleDropdown"
    >
      <span class="mr-3 h-11 w-11 overflow-hidden rounded-full">
        <img :src="fallbackImage" alt="User" />
      </span>

      <span class="mr-1 block text-theme-sm font-medium"
        >{{ authStore.user?.name }}
      </span>

      <ChevronDownIcon :class="{ 'rotate-180': dropdownOpen }" />
    </button>

    <!-- Dropdown Start -->
    <div
      v-if="dropdownOpen"
      class="ark:bg-gray-dark ark:border-gray-800 absolute right-0 mt-[17px] flex w-[260px] flex-col rounded-2xl border border-gray-200 bg-white p-3 shadow-theme-lg"
    >
      <div>
        <span
          class="ark:text-gray-400 block text-theme-sm font-medium text-gray-700"
        >
          {{ authStore.user.name }}
        </span>
        <span
          class="ark:text-gray-400 mt-0.5 block text-theme-xs text-gray-500"
        >
          {{ authStore.user.email }}
        </span>
      </div>

      <ul
        class="ark:border-gray-800 flex flex-col gap-1 border-b border-gray-200 pb-3 pt-4"
      >
        <li v-for="item in menuItems" :key="item.href">
          <RouterLink
            :to="item.href"
            class="ark:text-gray-400 ark:hover:bg-white/5 ark:hover:text-gray-300 group flex items-center gap-3 rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700"
          >
            <!-- SVG icon would go here -->
            <component
              :is="item.icon"
              class="ark:group-hover:text-gray-300 text-gray-500 group-hover:text-gray-700"
            />
            {{ item.text }}
          </RouterLink>
        </li>
      </ul>
      <button
        @click="signOut"
        class="ark:text-gray-400 ark:hover:bg-white/5 ark:hover:text-gray-300 group mt-3 flex items-center gap-3 rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700"
      >
        <LogoutIcon
          class="ark:group-hover:text-gray-300 text-gray-500 group-hover:text-gray-700"
        />
        Sign out
      </button>
    </div>
    <!-- Dropdown End -->
  </div>
</template>
