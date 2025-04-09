<template>
    <div class="relative min-h-screen overflow-hidden">

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

        <Navbar class="w-full fixed top-0 left-0 z-20" />







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




<style>

</style>