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
      <div class="flex items-center gap-3 relative">
        <!-- Reserve Button -->
        <a
          class="flex rounded-full ring cursor-pointer hover:bg-black/10 duration-200 ring-white text-sm text-white tracking-widest p-2"
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
              <a href="/register" class="block px-4 py-2 hover:bg-gray-200"
                >Créer un compte</a
              >
            </div>
          </transition>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      isDropdownOpen: false,
    };
  },
  methods: {
    toggleDropdown() {
      this.isDropdownOpen = !this.isDropdownOpen;
    },
    closeDropdown(event) {
      // Close dropdown only if clicking outside
      if (!this.$el.contains(event.target)) {
        this.isDropdownOpen = false;
      }
    },
  },
  mounted() {
    document.addEventListener("click", this.closeDropdown);
  },
  beforeUnmount() {
    document.removeEventListener("click", this.closeDropdown);
  },
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
