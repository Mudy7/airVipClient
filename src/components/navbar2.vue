<template>
  <div>
    <!-- NAVBAR WRAPPER (Always Above Everything) -->
    <div class="relative z-50">
      <nav
        :class="[
          'w-full bg-white text-black py-4 px-4 transition-shadow duration-300',
          showSearch ? '' : 'shadow',
        ]"
      >
        <div
          class="container mx-auto flex items-center justify-between relative"
        >
          <!-- Logo -->
          <div class="flex items-center cursor-pointer">
            <img
              src="../../public/assets/icons/logo.png"
              alt="Logo"
              class="h-5 object-contain"
              @click="$router.push('/')"
            />
          </div>

          <!-- Navigation Links -->
          <div
            class="absolute left-1/2 transform -translate-x-1/2 hidden md:flex space-x-6 text-sm"
          >
            <a href="/" class="tracking-widest hover:text-primary">Home</a>
            <a href="#" class="tracking-widest hover:text-primary">About</a>
            <a href="#" class="tracking-widest hover:text-primary">Contact</a>
          </div>

          <!-- Actions -->
          <div class="flex items-center gap-3">
            <!-- Search Button -->
            <button
              @click="toggleSearch"
              class="p-2 hover:bg-gray-100 rounded-full transition cursor-pointer"
            >
              <img
                src="../../public/assets/icons/search.svg"
                alt="Search"
                class="h-4 w-4"
              />
            </button>

            <!-- Profile Dropdown -->
            <div class="relative">
              <button
                @click="toggleDropdown"
                class="flex rounded-full bg-gray-200 p-2 cursor-pointer"
              >
                <img
                  src="../../public/assets/icons/profile.svg"
                  class="h-4 w-4"
                />
              </button>

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
          </div>
        </div>
      </nav>
    </div>

    <!-- OVERLAY (Below Nav) -->
    <transition name="fade">
      <div
        v-if="showSearch"
        class="fixed inset-0 bg-black/30 z-40"
        @click.self="closeSearch"
      ></div>
    </transition>

    <!-- DROPDOWN SEARCHBAR -->
    <transition name="slide-fade">
      <div
        v-if="showSearch"
        class="absolute left-0 w-full bg-white shadow-lg z-40"
        :style="{ top: `${navHeight}px` }"
      >
        <div class="container mx-auto py-4">
          <SearchBar />
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import SearchBar from "./searchbarSolid.vue";

export default {
  components: {
    SearchBar,
  },
  data() {
    return {
      isDropdownOpen: false,
      showSearch: false,
      navHeight: 0,
    };
  },
  methods: {
    toggleDropdown() {
      this.isDropdownOpen = !this.isDropdownOpen;
    },
    toggleSearch() {
      this.showSearch = !this.showSearch;
    },
    closeSearch() {
      this.showSearch = false;
    },
    closeDropdown(event) {
      if (!this.$el.contains(event.target)) {
        this.isDropdownOpen = false;
      }
    },
  },
  mounted() {
    document.addEventListener("click", this.closeDropdown);
    this.$nextTick(() => {
      const nav = this.$el.querySelector("nav");
      this.navHeight = nav?.offsetHeight || 64;
    });
  },
  beforeUnmount() {
    document.removeEventListener("click", this.closeDropdown);
  },
};
</script>

<style scoped>
/* Dropdown Fade */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Slide + Fade Search */
.slide-fade-enter-active {
  transition: all 0.4s ease;
}
.slide-fade-enter-from {
  opacity: 0;
  transform: translateY(-20px);
}
.slide-fade-leave-active {
  transition: all 0.3s ease;
}
.slide-fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>
