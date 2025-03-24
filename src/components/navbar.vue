<template>
  <nav
    class="fixed top-0 left-0 w-full bg-transparent text-white py-4 px-4 z-50"
  >
    <div class="container mx-auto flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center cursor-pointer">
        <img
          src="../../public/assets/icons/logo.png"
          alt="Logo"
          class="h-5 object-contain"
          @click="$router.push('/')"
        />
      </div>

      <!-- Navigation Links (Centered) -->
      <div
        class="absolute left-1/2 transform -translate-x-1/2 hidden md:flex space-x-6 text-sm"
      >
        <a href="#" class="text-white tracking-widest hover:text-gray-300"
          >Home</a
        >
        <a href="#" class="text-white tracking-widest hover:text-gray-300"
          >About</a
        >
        <a href="#" class="text-white tracking-widest hover:text-gray-300"
          >Contact</a
        >
      </div>

      <!-- Profile & Actions (Right) -->
      <div class="flex items-center gap-3">
        <a
          class="flex rounded-full ring cursor-pointer hover:bg-black/10 duration-200 ring-white text-sm text-white tracking-widest p-2"
        >
          Reserver
        </a>
        <button
          @click="toggleDropdown"
          class="flex rounded-full bg-white p-2 cursor-pointer"
        >
          <img src="../../public/assets/icons/profile.svg" class="h-4" />
        </button>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from "vue";

const isDropdownOpen = ref(false);
const isMenuOpen = ref(false);

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};
</script>

<style>
/* Smooth fade animation */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease, transform 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>
