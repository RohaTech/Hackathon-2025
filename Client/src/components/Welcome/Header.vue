<script setup></script>

<template>
  <header
    class="flex py-2 px-4 lg:px-10 border-b border-gray-400 justify-between z-50"
  >
    <RouterLink
      :to="{ name: 'Welcome' }"
      class="font-black text-2xl text-[#2D479B] capitalize cursor-pointer hover:text-[#f3a21b]"
      >Qelemeda Payroll System
    </RouterLink>
    <RouterLink
      :to="{ name: 'Login' }"
      class="bg-[#2D479B] text-white hover:bg-[#f3a21b] w-fit px-4 py-1.5 rounded-sm flex justify-center items-center"
      >Login</RouterLink
    >
  </header>
</template>
