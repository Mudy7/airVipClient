<template>
  <div class="relative min-h-screen overflow-hidden">
    <!-- Full-Screen Video Container -->
    <div
      class="relative min-h-screen flex flex-col items-end justify-center text-white"
    >
      <!-- Background Video -->
      <div class="absolute inset-0">
        <video
          class="w-full h-full object-cover"
          loop
          muted
          playsinline
          autoplay
        >
          <source
            src="https://player.vimeo.com/external/563130035.hd.mp4?s=5bd311f698519ffa90aa5136b96d1e86aa78d107&profile_id=175"
            type="video/mp4"
          />
        </video>
      </div>

      <!-- Navbar (Fixed at Top) -->
      <Navbar class="w-full fixed top-0 left-0 z-20" />

      <!-- Content Wrapper -->
      <div class="relative z-10 w-full">
        <div class="container mx-auto px-4">
          <h1
            class="text-[25px] sm:text-[30px] md:text-[75px] md:leading-20 items-centers"
          >
            Redéfinir le Voyage <br />
            de Luxe
          </h1>
          <div class="mt-3 md:mt-10">
            <SearchBar />
          </div>
        </div>
      </div>
    </div>

    <!-- Allow Scrolling for Additional Content -->
    <div class="relative overflow-visible">
      <div class="container mx-auto p-10 text-center">
        <p class="text-xl text-black">More content goes here...</p>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from "../components/sidebar.vue";
import SearchBar from "../components/searchbar.vue";
import BottomNav from "../components/BottomNav.vue";
import Navbar from "../components/navbar.vue";
import dropDown from "../components/dropDown.vue";

export default {
  components: {
    Sidebar,
    SearchBar,
    BottomNav,
    Navbar,
    dropDown,
  },
};
</script>

<style></style>
