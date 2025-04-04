<template>
  <NavBar />

  <main class="p-6 md:p-10">
    <!-- Title -->
    <div class="mb-4">
      <h1 class="text-2xl font-semibold text-start">
        Vol de {{ flightData?.aeroportDepart?.ville }} à
        {{ flightData?.aeroportArrive?.ville }}
      </h1>
      <ol class="text-sm flex gap-2 text-gray-600">
        <li>{{ flightData?.nb_place }} places</li>
        <li>•</li>
        <li>{{ flightData?.temps }} heures de trajet</li>
      </ol>
    </div>

    <!-- Top Section: Images + Price -->
    <div class="flex flex-col lg:flex-row gap-6 mt-6">
      <!-- Images -->
      <!-- Image Viewer -->
      <div class="w-full lg:w-[70%] flex flex-col gap-4">
        <!-- Main Image -->
        <div
          class="relative overflow-hidden rounded-lg shadow-md h-[435px] w-full"
        >
          <img
            :src="images[selectedIndex]"
            class="w-full h-full object-cover transition duration-300 ease-in-out"
          />
        </div>

        <!-- Thumbnails (Horizontal Below) -->
        <div class="flex gap-2 overflow-x-auto">
          <img
            v-for="(img, index) in images"
            :key="index"
            :src="img"
            class="w-25 h-25 object-cover rounded-lg cursor-pointer hover:border-primary flex-shrink-0"
            :class="{ 'border-primary border-2': index === selectedIndex }"
            @click="switchImage(index)"
          />
        </div>
      </div>

      <!-- Price Box -->
      <div
        class="w-full lg:w-[30%] bg-white p-4 shadow-lg rounded-lg text-start text-sm flex flex-col justify-between min-h-[460px]"
      >
        <div class="flex flex-col gap-5">
          <!-- Price + availability -->
          <div class="mb-4">
            <div class="flex justify-between items-center">
              <p class="text-gray-600 text-[20px] font-semibold">
                ${{ priceTotal }} CAD
              </p>
              <div class="flex gap-1 text-sm items-center">
                <span class="relative flex h-2 w-2">
                  <span
                    class="absolute inline-flex h-full w-full rounded-full opacity-75 animate-ping"
                    :class="
                      flightData?.disponibilite === 'Disponible'
                        ? 'bg-green-400'
                        : 'bg-red-400'
                    "
                  ></span>
                  <span
                    class="relative inline-flex rounded-full h-2 w-2"
                    :class="
                      flightData?.disponibilite === 'disponible'
                        ? 'bg-green-600'
                        : 'bg-red-600'
                    "
                  ></span>
                </span>
                <p
                  :class="
                    flightData?.disponibilite === 'disponible'
                      ? 'text-green-600'
                      : 'text-red-600'
                  "
                >
                  {{
                    flightData?.disponibilite === "disponible"
                      ? "Disponible"
                      : "Non disponible"
                  }}
                </p>
              </div>
            </div>
            <p class="text-sm mt-2">
              {{ formatDate(departureDate) }}
            </p>
          </div>

          <!-- Details -->
          <div class="flex justify-between text-md">
            <p>{{ flightData?.temps }} heures x ${{ flightData?.prix }}</p>
            <p>${{ price }}</p>
          </div>
          <div class="flex justify-between text-md">
            <p>Taxe</p>
            <p>${{ priceTax.toFixed(2) }}</p>
          </div>
          <hr class="border-t border-gray-200" />
          <div class="flex justify-between text-md font-semibold">
            <p>Total</p>
            <p>${{ priceTotal.toFixed(2) }}</p>
          </div>
        </div>

        <!-- Button pinned to bottom -->
        <button
          class="w-full mt-5 text-md py-3 rounded-xl text-white font-medium bg-primary hover:opacity-90 transition duration-300 cursor-pointer"
          @click="gotoPayment"
        >
          Réserver
        </button>
      </div>
    </div>

    <!-- Bottom Info Section -->
    <div class="mt-10 w-full bg-white p-5 shadow-lg rounded-lg text-start">
      <p class="text-gray-600 text-[24px] font-semibold mb-2">
        {{ capitalizeFirst(flightData?.avion.modele) }}
      </p>
      <ol class="text-sm flex gap-2 text-gray-600">
        <li>{{ flightData?.nb_place }} places</li>
        <li>•</li>
        <li>{{ flightData?.temps }} heures de trajet</li>
      </ol>
      <hr class="border-t border-gray-200 my-10" />
      <div class="flex flex-col gap-8 text-sm">
        <div class="flex gap-10 items-start">
          <img class="w-5 mt-1" src="/assets/icons/food.svg" alt="Food Icon" />
          <div class="flex flex-col">
            <span class="font-semibold">Restauration gastronomique</span>
            <span>Repas 5 étoiles sur mesure</span>
          </div>
        </div>
        <div class="flex gap-10 items-start">
          <img class="w-5 mt-1" src="/assets/icons/wifi.svg" alt="Food Icon" />
          <div class="flex flex-col">
            <span class="font-semibold"> Wi-Fi haut débit </span>
            <span>Restez connecté en tout temps</span>
          </div>
        </div>
        <div class="flex gap-10 items-start">
          <img class="w-5 mt-1" src="/assets/icons/car.svg" alt="Food Icon" />
          <div class="flex flex-col">
            <span class="font-semibold">Chauffeur privé inclus </span>
            <span>service de transport VIP vous attend à l’arrivée</span>
          </div>
        </div>
      </div>
      <hr class="border-t border-gray-200 my-10" />
      <p class="text-sm text-gray-600 mt-4">
        Voyager en jet privé, c’est bien plus qu’un simple déplacement : c’est
        une expérience de confort absolu, de gain de temps et d’intimité. Évitez
        les files d’attente, les retards et la foule — décollez à l’heure de
        votre choix, depuis des terminaux privés exclusifs. Offrez-vous un vol
        sur mesure, dans un espace luxueux et calme, pour arriver reposé,
        productif et prêt à profiter pleinement de votre destination.
      </p>
    </div>
  </main>
</template>

<script>
import NavBar from "../components/navbar2.vue";
import { get } from "../assets/utils/communications.js";

export default {
  name: "FlightDetail",
  components: {
    NavBar,
  },
  data() {
    return {
      images: [],
      selectedIndex: 0,
      flightData: null,
      price: 0,
      priceTotal: 0,
      priceTax: 0,
      fees: 1000,
      departureDate: null,
    };
  },
  mounted() {
    const id = this.$route.query.id;
    const departureDate = this.$route.query.departureDate;
    this.departureDate = departureDate;
    this.fetchFlight(id);
  },
  methods: {
    calculatePrice() {
      if (!this.flightData) return;
      this.price = this.flightData.prix * this.flightData.temps;
      this.priceTax = this.price * 0.15;
      this.priceTotal = this.price + this.priceTax;
    },
    capitalizeFirst(text) {
      if (!text) return "";
      return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString("fr-FR", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    },
    gotoPayment() {
      this.$router.push({
        path: "/payment",
        query: {
          volId: this.flightData.vol_id,
          departureDate: this.departureDate,
        },
      });
    },
    switchImage(index) {
      this.selectedIndex = index;
    },
    async fetchFlight(id) {
      try {
        const { body } = await get(`vols/${id}`);
        this.flightData = body;
        this.images = body.avion.images
          .sort((a, b) => a.orderIndex - b.orderIndex)
          .map((img) => img.url);
        this.calculatePrice();
      } catch (error) {
        console.error("Erreur lors du chargement du vol:", error);
      }
    },
  },
};
</script>

<style scoped>
/* Custom styles if needed */
</style>
