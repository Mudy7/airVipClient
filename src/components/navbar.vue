<script setup></script>

<template>
  <nav
    class="absolute top-0 left-0 w-full bg-transparent bg-opacity-50 text-white py-4 px-6"
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

      <!-- Navigation Links -->
      <div class="flex space-x-6">
        <a href="#" class="text-white font-bold hover:text-gray-300">Home</a>
        <a href="#" class="text-white font-bold hover:text-gray-300">About</a>
        <a href="#" class="text-white font-bold hover:text-gray-300">Contact</a>
      </div>
    </div>
  </nav>
</template>
