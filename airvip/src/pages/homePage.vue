<template>
  <Sidebar />
  <SearchBar />
  <div class="flex flex-col items-center justify-center">
    <h1 class="text-4xl font-bold text-primary">Air vip</h1>
    <p class="text-lg text-gray-700">ceci est la page d'acceuil, A faire</p>
  </div>
</template>

<script>
import Sidebar from "../components/sidebar.vue";
import SearchBar from "../components/searchbar.vue";
export default {
  components: {
    Sidebar,
    SearchBar,
  },
};
</script>

<style>
#app {
  width: 100vw !important;
  height: 100vh !important;
}
</style>
