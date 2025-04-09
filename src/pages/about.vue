<template>
  <div class="relative min-h-screen overflow-hidden">

    <!-- Background Video -->
    <div class="absolute inset-0 z-0">
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

    <!-- Image au-dessus du fond vidéo -->
    <img
      class="plane-image"
      src="https://aeroaffaires.fr/wp-content/uploads/2018/08/king-air-90-aircraft-1700x860-c-center.webp"
      alt="Ma super image"
    />
    

    <!-- Boîte blanche avec texte -->
    <div class="info-box">
      <h2 class="text-xl font-bold mb-2">Air VIP</h2>
      <br>
      <p class="text-base">Nous sommes fier de vous offrir les meilleurs services de vols privés depuis plus de 30 ans. Air VIP est une compagnie situé à Montréal dont ses service s'étant sur l'entiereté du globe.
      </p>
      <br>
      <p class="text-base">Vous pouvez réserver le vol qui vous intéresse en fonction du parcourt que vous désirez. Nous tenons à vous donner une expérience inoubliable. Il n'y aura que vous et vos invité dans votre avion, votre intimité est nécessaire à votre confort.
      </p>
    </div>






    <!-- Navbar -->
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


.plane-image {
  position: absolute;
  top: 47%; /* Centrage vertical */
  right: 0;
  transform: translateY(-50%);
  width: 42%; /* Réduction de la taille */
  z-index: 10;
  border-radius: 10px; /* Pour l’esthétique */
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Pour bien se détacher du fond */
  margin-right: 80px;
}

.info-box {
  position: absolute;
  top: 47%;
  left: 0;
  transform: translateY(-50%);
  width: 40%;
  background-color: white;
  padding: 2rem;
  border-radius: 10px;
  z-index: 10;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
  margin-left: 80px;
}





</style>