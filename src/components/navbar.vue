<template>
  <nav
    class="absolute top-0 left-0 w-full bg-transparent text-white py-4 px-6 z-50"
  >
    <div class="container mx-auto flex justify-between items-center">
      <!-- Logo -->
      <div class="flex items-center space-x-3">
        <img
          src="../../public/assets/icons/logo.png"
          alt="Logo"
          class="h-5 object-contain"
        />
      </div>

      <!-- Desktop Navigation Links (Hidden on Mobile) -->
      <div class="hidden md:flex space-x-6 text-[8px] md:text-sm">
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

      <!-- Profile & Actions -->
      <div class="flex items-center gap-2 md:gap-3 relative">
        <!-- Reserve Button -->
        <a
          class="flex rounded-full ring cursor-pointer hover:bg-black/10 duration-200 ring-white text-[8px] md:text-sm text-white tracking-widest p-2"
        >
          Reserver
        </a>

        <!-- Profile Icon (Dropdown Trigger) -->
        <div class="relative">
          <button
            @click="toggleDropdown"
            class="flex rounded-full bg-white p-2 cursor-pointer"
          >
            <img src="../../public/assets/icons/profile.svg" class="h-4" />
          </button>

          <!-- Dropdown Menu -->
          <transition name="fade">
            <div
              v-if="isDropdownOpen"
              class="absolute right-0 mt-3 w-48 bg-white text-black shadow-lg rounded-lg py-2 z-50"
            >
              <a href="/login" class="block px-4 py-2 hover:bg-gray-200"
                >Se connecter</a
              >
              <a href="/login" class="block px-4 py-2 hover:bg-gray-200"
                >Créer un compte</a
              >
            </div>
          </transition>
        </div>

        <!-- Mobile Menu (Hamburger Button) -->
        <div class="relative z-50">
          <button
            @click="toggleMenu"
            class="flex flex-col gap-1 cursor-pointer"
          >
            <div
              class="w-6 h-0.5 bg-white transition-all duration-300"
              :class="{ 'rotate-45 translate-y-1.5': isMenuOpen }"
            ></div>

            <div
              class="w-6 h-0.5 bg-white transition-all duration-300"
              :class="{ '-rotate-45 -translate-y-1.5': isMenuOpen }"
            ></div>
          </button>
        </div>
      </div>
    </div>

    <!-- Full-screen Mobile Menu with "X" to close -->
    <transition name="fade">
      <div
        v-if="isMenuOpen"
        class="fixed top-0 left-0 w-screen h-screen bg-white text-black flex flex-col space-y-6 text-xl z-50"
      >
        <!-- Close Button Container (Keeps the X Icon Aligned) -->
        <div class="w-full flex justify-end p-5 container mx-auto pr-10">
          <button @click="toggleMenu" class="p-3 cursor-pointer">
            <div
              class="w-8 h-0.5 bg-black rotate-45 translate-y-1.5 transition-all duration-300"
            ></div>
            <div
              class="w-8 h-0.5 bg-black opacity-0 transition-all duration-300"
            ></div>
            <div
              class="w-8 h-0.5 bg-black -rotate-45 -translate-y-1.5 transition-all duration-300"
            ></div>
          </button>
        </div>

        <!-- Menu Links -->
        <div
          class="flex flex-col items-center justify-center flex-grow space-y-6"
        >
          <a href="/" class="hover:text-gray-500">Home</a>
          <a href="#" class="hover:text-gray-500">About</a>
          <a href="#" class="hover:text-gray-500">Contact</a>
          <a href="/login" class="hover:text-gray-500">Se connecter</a>
        </div>
      </div>
    </transition>
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
