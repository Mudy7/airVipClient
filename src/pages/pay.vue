<template>
  <NavBar />

  <main class="p-6 md:p-10">
    <!-- Title -->
    <h1 class="text-2xl font-semibold text-start mb-6">
      Paiement pour le Vol de {{ flightData?.aeroportDepart?.ville }} à
      {{ flightData?.aeroportArrive?.ville }}
    </h1>

    <!-- Content Section -->
    <div class="flex flex-col lg:flex-row gap-6 text-start">
      <!-- Payment Form (Left) -->
      <div class="w-full lg:w-[70%] bg-white p-6 shadow-lg rounded-lg">
        <h2 class="text-lg font-semibold mb-4">Informations de paiement</h2>

        <form @submit.prevent="handleSubmit" class="space-y-4">
          <div>
            <label class="block mb-1 text-sm font-medium">Nom complet</label>
            <input
              type="text"
              v-model="payment.name"
              required
              class="w-full border border-gray-300 p-2 rounded-md"
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium"
              >Numéro de carte</label
            >
            <input
              type="text"
              v-model="payment.cardNumber"
              required
              class="w-full border border-gray-300 p-2 rounded-md"
            />
          </div>

          <div class="flex gap-4">
            <div class="w-1/2">
              <label class="block mb-1 text-sm font-medium">Expiration</label>
              <input
                type="text"
                v-model="payment.expiry"
                required
                placeholder="MM/AA"
                class="w-full border border-gray-300 p-2 rounded-md"
              />
            </div>
            <div class="w-1/2">
              <label class="block mb-1 text-sm font-medium">CVC</label>
              <input
                type="text"
                v-model="payment.cvc"
                required
                class="w-full border border-gray-300 p-2 rounded-md"
              />
            </div>
          </div>

          <button
            type="submit"
            class="bg-primary text-white py-3 px-6 rounded-xl hover:opacity-90 transition w-full mt-4"
          >
            Confirmer le paiement
          </button>
        </form>
      </div>

      <!-- Price Box (Right) -->
      <div
        class="w-full lg:w-[30%] bg-white p-4 shadow-lg rounded-lg text-start text-sm flex flex-col justify-between min-h-[360px]"
      >
        <div class="flex flex-col gap-5">
          <!-- Flight Info -->
          <div class="mb-4">
            <h3 class="text-lg font-semibold mb-2">
              Vol de {{ flightData?.aeroportDepart?.ville }} à
              {{ flightData?.aeroportArrive?.ville }}
            </h3>
            <img
              :src="flightData?.avion?.images?.[0]?.url"
              alt="Avion"
              class="rounded-lg w-full h-40 object-cover my-5"
            />

            <p class="text-sm">Départ prévu : {{ formattedDate }}</p>
          </div>

          <!-- Price Breakdown -->
          <div class="flex justify-between text-md">
            <p>Sous-total</p>
            <p>${{ price }}</p>
          </div>
          <div class="flex justify-between text-md">
            <p>Taxe</p>
            <p>${{ tax.toFixed(2) }}</p>
          </div>
          <hr class="border-t border-gray-200" />
          <div class="flex justify-between text-md font-semibold">
            <p>Total</p>
            <p>${{ total.toFixed(2) }}</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import NavBar from "../components/navbar2.vue";
import { get } from "../assets/utils/communications.js";
import { getUserIdFromToken } from "../assets/utils/auth.js";
import { post } from "../assets/utils/communications.js";

export default {
  name: "PaymentPage",
  components: { NavBar },
  data() {
    return {
      flightId: null,
      departureDate: null,
      flightData: null,
      price: 0,
      tax: 0,
      total: 0,
      payment: {
        name: "",
        cardNumber: "",
        expiry: "",
        cvc: "",
      },
    };
  },
  computed: {
    formattedDate() {
      if (!this.departureDate) return "";
      const date = new Date(this.departureDate);
      return date.toLocaleDateString("fr-FR", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    },
  },
  mounted() {
    this.flightId = this.$route.query.volId;
    this.departureDate = this.$route.query.departureDate;
    this.fetchFlight(this.flightId);
  },
  methods: {
    async fetchFlight(id) {
      try {
        const { body } = await get(`vols/${id}`);
        this.flightData = body;
        this.price = body.prix * body.temps;
        this.tax = this.price * 0.15;
        this.total = this.price + this.tax;
      } catch (error) {
        console.error("Erreur lors du chargement du vol:", error);
      }
    },
    handleSubmit: async function () {
      const email = getUserIdFromToken();

      if (!email) {
        alert("Utilisateur non authentifié");
        return;
      }

      const isoString = new Date().toISOString().split(".")[0]; // removes milliseconds

      const reservationPayload = {
        email: email,
        volId: parseInt(this.flightId),
        dateReservation: isoString, // or this.departureDate if needed
      };

      try {
        const { body } = await post("reservations", reservationPayload);
        alert("Paiement confirmé et réservation enregistrée !");
        console.log("Réservation créée :", body);
        this.$router.push("/confirmation");
      } catch (error) {
        console.error("Erreur lors de la réservation :", error);
        alert("Erreur lors de la réservation.");
      }
    },
  },
};
</script>

<style scoped>
/* Optional scoped styles */
</style>
