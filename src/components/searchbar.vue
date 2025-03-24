<template>
  <div class="flex items-center justify-center p-6">
    <div
      class="flex flex-col md:flex-row items-center text-white border-2 bg-white/20 backdrop-filter backdrop-blur-sm shadow-md rounded-xl md:rounded-full py-4 md:py-1 px-4 md:space-x-3 space-y-3 md:space-y-0 w-auto max-w-3xl border border-white"
    >
      <!-- FROM Input -->
      <div class="flex flex-1 items-center md:pl-2 w-full">
        <img src="../../public/assets/icons/takeoff.svg" class="w-5" />
        <div class="flex flex-row md:flex-col w-full px-4">
          <label class="text-sm text-start md:mb-1 pr-2">De</label>
          <AutoComplete
            placeholder="Location"
            :suggestions="['Paris', 'London', 'New York', 'Tokyo']"
            v-model="from"
            size="small"
            class="text-sm placeholder-gray-400 w-full"
          ></AutoComplete>
        </div>
      </div>

      <div class="hidden md:flex border-l border-gray-300 h-8"></div>

      <!-- TO Input -->
      <div class="flex flex-1 items-center md:pl-2 w-full">
        <img src="../../public/assets/icons/landing.svg" class="w-5" />
        <div class="flex flex-row md:flex-col w-full px-4">
          <label class="text-sm text-start md:mb-1 pr-2">À</label>
          <AutoComplete
            placeholder="Location"
            :suggestions="['Paris', 'London', 'New York', 'Tokyo']"
            v-model="to"
            size="small"
            class="text-sm placeholder-gray-400 w-full"
          ></AutoComplete>
        </div>
      </div>

      <div class="hidden md:flex border-l border-gray-300 h-8"></div>

      <!-- DEPARTURE DATE -->
      <div class="flex flex-1 items-center md:pl-2 w-full">
        <img src="../../public/assets/icons/calendar.svg" class="w-5" />
        <div class="flex flex-row md:flex-col w-full px-4 py-2 cursor-pointer">
          <label class="text-sm text-start md:mb-1 pr-2">Departure</label>
          <DatePicker
            v-model="departureDate"
            placeholder="Date"
            size="small"
            style="border: none; box-shadow: none"
            class="text-sm focus:outline-none w-full"
            dateFormat="dd/mm"
          />
        </div>
      </div>

      <!-- SEARCH BUTTON -->
      <div
        class="relative flex items-center w-full md:w-auto justify-center bg-secondary rounded-full p-5 cursor-pointer"
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
.p-inputtext {
  box-shadow: none !important;
  border: none !important;
  padding: 0 !important;
}

.p-inputtext::placeholder {
  color: rgba(255, 255, 255, 0.6); /* Soft White */
  opacity: 1;
}
.p-inputtext,
.p-calendar,
.p-datepicker {
  background: transparent !important;
  border: none !important;
  box-shadow: none !important;
}

.p-datepicker-panel {
  background-color: white !important;
  color: black;
}
</style>
