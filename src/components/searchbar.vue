<template>
  <div class="flex items-center justify-center p-6">
    <div
      class="flex items-center bg-white shadow-md rounded-full px-4 space-x-3 w-full max-w-3xl py-1 border border-gray-300"
    >
      <!-- FROM Input -->
      <div class="flex flex-col px-4">
        <label class="text-sm text-start text-black">De</label>
        <AutoComplete
          placeholder="Location"
          :suggestions="['Paris', 'London', 'New York', 'Tokyo']"
          v-model="from"
          size="small"
          class="text-sm placeholder-gray-500"
        ></AutoComplete>
      </div>
      <div class="border-l border-gray-300 h-8"></div>

      <!-- TO Input -->
      <div class="flex flex-col px-4">
        <label class="text-sm text-start text-black">à</label>
        <AutoComplete
          placeholder="Location"
          :suggestions="['Paris', 'London', 'New York', 'Tokyo']"
          v-model="to"
          size="small"
          class="text-sm placeholder-gray-500"
        ></AutoComplete>
      </div>

      <div class="border-l border-gray-300 h-8"></div>
      <!-- DEPARTURE DATE -->
      <div class="flex flex-col px-4 py-2 cursor-pointer">
        <label class="text-sm text-start text-black">Departure</label>
        <DatePicker
          v-model="departureDate"
          placeholder="date"
          size="small"
          style="border: none; box-shadow: none"
          class="text-sm focus:outline-none"
          dateFormat="dd/mm"
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
import "@vuepic/vue-datepicker/dist/main.css";
import DatePicker from "primevue/datepicker";

import AutoComplete from "primevue/autocomplete";

export default {
  name: "FlightSearchBar",
  components: { DatePicker, AutoComplete },
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

<style>
.p-calendar,
.p-datepicker,
.p-inputtext,
.p-datepicker-panel {
  box-shadow: none !important;
  border: none !important;
  padding: 0 !important;
}

.p-inputtext::placeholder {
  color: #6b7280 !important; /* Change to your desired color */
  opacity: 1; /* Ensure visibility */
}
</style>
