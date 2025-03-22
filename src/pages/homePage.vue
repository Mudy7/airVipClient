<template>
  <div class="relative">
    <!-- Image Container (With Extra Padding) -->
    <div
      class="relative h-[80vh] pb-20 flex flex-col items-center justify-center text-white"
    >
      <!-- Background Image -->
      <div class="absolute inset-0">
        <img
          src="https://assets.gulfstream.aero/thedotcom/images/aircraft/g800/v_g800_a_mkt_006_PROD.jpg"
          alt="Background"
          class="w-full h-full object-cover"
        />
      </div>

      <!-- Navbar (Fixed at Top) -->
      <NavBar class="w-full fixed top-0 left-0 z-20" />

      <!-- Content (Title + Search) -->
      <div class="relative z-10 flex flex-col items-center">
        <!-- Text (Title) -->
        <h1 class="text-5xl font-bold">Voyager en Luxe</h1>
      </div>

      <!-- Search Bar Positioned at Bottom, Overlapping -->
      <div
        class="absolute bottom-[-55px] left-1/2 transform -translate-x-1/2 z-10 w-full px-4"
      >
        <SearchBar />
      </div>
    </div>

    <!-- Content Section Below Image -->
    <div class="p-10 text-center">
      <p class="text-xl text-black">More content goes here...</p>
    </div>
  </div>
</template>

<script>
import Sidebar from "../components/sidebar.vue";
import SearchBar from "../components/searchbar.vue";
import BottomNav from "../components/BottomNav.vue";
import Searchbar from "../components/searchbar.vue";
import NavBar from "../components/NavBar.vue";
export default {
  components: {
    Sidebar,
    SearchBar,
    BottomNav,
    NavBar,
  },
};
</script>

<style></style>
