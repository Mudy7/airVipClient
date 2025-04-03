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
            <a v-if="isAdmin" href="/manager" class="tracking-widest hover:text-primary text-sm">Manager</a>
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
                <img src="../../public/assets/icons/profile.svg" class="h-4 w-4" />
              </button>

              <!-- Dropdown Menu -->
              <transition name="fade">
                <div
                  v-if="isDropdownOpen"
                  class="absolute right-0 mt-3 w-48 bg-white text-black shadow-lg rounded-lg py-2 z-50"
                >
                  <div v-if="isAuthenticated" class="centered-div">
                    <button @click="logout" class="block px-4 py-2 hover:bg-gray-200">
                      Se déconnecter
                    </button>
                    <a href="/profil" class="block px-4 py-2 hover:bg-gray-200">
                      Profil
                    </a>
                  </div>
                  <div v-else>
                    <a href="/login" class="block px-4 py-2 hover:bg-gray-200">
                      Se connecter
                    </a>
                    <a href="/login" class="block px-4 py-2 hover:bg-gray-200">
                      Créer un compte
                    </a>
                  </div>
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
        isAuthenticated: false, // Ajout de la gestion de l'authentification
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
      logout() {
        localStorage.removeItem("token");
        localStorage.removeItem("role");
        localStorage.removeItem("userId");
        this.isAuthenticated = false;
        this.isAdmin = false;
        this.$router.push("/login");
      },
      checkAuth() {
        const token = localStorage.getItem("token");
        const role = localStorage.getItem("role"); // Stocke le rôle dans le localStorage lors de la connexion
        const userId = localStorage.getItem("userId");
        this.isAuthenticated = !!token;
        this.isAdmin = role === "admin";
      },
    },
    mounted() {
      document.addEventListener("click", this.closeDropdown);
      
      this.$nextTick(() => {
        const nav = this.$el.querySelector("nav");
        this.navHeight = nav?.offsetHeight || 64;
      });

      this.checkAuth();
      window.addEventListener("storage", this.checkAuth); // Mise à jour si `localStorage` change
    },
    beforeUnmount() {
      document.removeEventListener("click", this.closeDropdown);
      window.removeEventListener("storage", this.checkAuth);
    },
    watch: {
      "$route"() {
        this.checkAuth();
      },
    },
  };
</script>



<style scoped>
.centered-div {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

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
