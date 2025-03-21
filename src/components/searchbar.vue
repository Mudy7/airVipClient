<template>
  <div class="flex items-center justify-center p-6">
    <div
      class="flex items-center bg-white shadow-md rounded-full px-4 py-2 space-x-3 w-full max-w-4xl border"
    >
      <!-- FROM Input -->
      <div class="flex flex-col px-4">
        <label class="text-sm text-start text-black">De</label>
        <input
          v-model="from"
          type="text"
          placeholder="Location"
          class="text-sm bg-transparent border-none focus:outline-none"
        />
      </div>

      <!-- TO Input -->
      <div class="flex flex-col px-4 py-2">
        <label class="text-sm text-start text-black">à</label>
        <input
          v-model="to"
          type="text"
          placeholder="Destinations"
          class="text-sm bg-transparent border-none focus:outline-none"
        />
      </div>

      <!-- DEPARTURE DATE -->
      <div class="flex flex-col px-4 py-2 cursor-pointer">
        <label class="text-sm text-start text-black">Departure</label>
        <VueDatePicker
          v-model="departureDate"
          placeholder="date"
          class="text-sm"
        />
      </div>

      <!-- RETURN DATE -->
      <div class="flex flex-col px-4 py-2 cursor-pointer">
        <label class="text-sm text-start text-black">Retour</label>
        <VueDatePicker
          v-model="returnDate"
          placeholder="date"
          class="text-sm"
        />
      </div>

      <!-- SEARCH BUTTON -->
      <div
        class="relative flex items-center justify-center bg-primary primary-hover rounded-full p-5 cursor-pointer"
        @click="searchFlights"
      >
        <img
          class="w-4 absolute filter invert"
          src="/assets/icons/search.svg"
          alt="Search"
        />
      </div>
    </div>
  </div>
</template>

<script>
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
  name: "FlightSearchBar",
  components: { VueDatePicker },
  data() {
    return {
      from: "",
      to: "",
      departureDate: null,
      returnDate: null,
      passengers: 1,
      dropdownOpen: false,
    };
  },
  methods: {
    toggleDropdown() {
      this.dropdownOpen = !this.dropdownOpen;
    },
    changePassengers(num) {
      this.passengers = num;
      this.dropdownOpen = false;
    },
    searchFlights() {
      console.log(
        "Searching flights:",
        this.from,
        this.to,
        this.departureDate,
        this.returnDate,
        this.passengers
      );
    },
  },
};
</script>
