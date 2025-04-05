<template>
  <div class="flex items-center justify-center p-4">
    <form
      @submit.prevent="searchFlights"
      class="flex flex-col md:flex-row items-center shadow-md rounded-xl md:rounded-full py-4 md:py-1 px-4 md:space-x-3 space-y-3 md:space-y-0 w-auto max-w-3xl border border-gray-300 bg-white text-black"
    >
      <!-- FROM Input -->
      <div class="flex flex-1 items-center md:pl-2 w-full">
        <img src="/assets/icons/takeoff.svg" class="w-5 invert" />
        <div class="flex flex-row md:flex-col w-full px-4">
          <label class="text-sm text-start md:mb-1 pr-2">De</label>
          <AutoComplete
            placeholder="Location"
            v-model="from"
            :suggestions="filteredCities"
            @complete="searchCity"
            size="small"
            class="text-sm w-full text-black"
            required
          />
        </div>
      </div>

      <div class="hidden md:flex border-l border-gray-300 h-8"></div>

      <!-- TO Input -->
      <div class="flex flex-1 items-center md:pl-2 w-full">
        <img src="/assets/icons/landing.svg" class="w-5 invert" />
        <div class="flex flex-row md:flex-col w-full px-4">
          <label class="text-sm text-start md:mb-1 pr-2">À</label>
          <AutoComplete
            placeholder="Location"
            v-model="to"
            :suggestions="filteredCities"
            @complete="searchCity"
            size="small"
            class="text-sm w-full text-black"
            required
          />
        </div>
      </div>

      <div class="hidden md:flex border-l border-gray-300 h-8"></div>

      <!-- DEPARTURE DATE -->
      <div class="flex flex-1 items-center md:pl-2 w-full">
        <img src="/assets/icons/calendar.svg" class="w-5 invert" />
        <div class="flex flex-row md:flex-col w-full px-4 py-2 cursor-pointer">
          <label class="text-sm text-start md:mb-1 pr-2">Departure</label>
          <DatePicker
            v-model="departureDate"
            placeholder="Date"
            size="small"
            class="text-sm focus:outline-none w-full solid-input"
            dateFormat="dd/mm"
            required
          />
        </div>
      </div>

      <!-- SEARCH BUTTON -->
      <button
        type="submit"
        class="relative flex items-center w-full md:w-auto justify-center bg-primary primary-hover rounded-full p-5 cursor-pointer"
      >
        <img
          class="w-4 absolute invert"
          src="/assets/icons/search.svg"
          alt="Search"
        />
      </button>
    </form>
  </div>
</template>

<script>
import "@vuepic/vue-datepicker/dist/main.css";
import DatePicker from "primevue/datepicker";
import AutoComplete from "primevue/autocomplete";
import { useRouter } from "vue-router";
import { get } from "../assets/utils/communications.js";

export default {
  name: "FlightSearchBarSolid",
  components: { DatePicker, AutoComplete },
  data() {
    return {
      from: "",
      to: "",
      departureDate: null,
      filteredCities: [],
      cities: [],
    };
  },

  setup() {
    const router = useRouter();
    return { router };
  },
  async mounted() {
    const { body } = await get("aeroports/villes");
    this.cities = body;
  },
  methods: {
    searchFlights() {
      if (!this.from || !this.to || !this.departureDate) {
        alert("Veuillez remplir tous les champs !");
        return;
      }

      this.router.push({
        path: "/search",
        query: {
          from: this.from,
          to: this.to,
          departureDate: this.departureDate,
        },
      });
    },
    searchCity(event) {
      const query = event.query.toLowerCase();
      this.filteredCities = this.cities.filter((city) =>
        city.toLowerCase().includes(query)
      );
    },
  },
};
</script>

<style scoped>
/* Style input text and placeholder for solid search bar */
.solid-input :deep(.p-inputtext) {
  color: black !important;
  box-shadow: none !important;
  border: none !important;
  background: transparent !important;
  padding: 0 !important;
}
.p-inputtext {
  color: #000000 !important;
}
.p-autocomplete-overlay {
  background: white !important;
  color: black !important;
}

.p-autocomplete-option-color {
  color: black !important;
}

.solid-input :deep(.p-inputtext::placeholder) {
  color: rgba(0, 0, 0, 0.6) !important;
}
.p-autocomplete-option:not(.p-autocomplete-option-selected):not(
    .p-disabled
  ).p-focus {
  color: black !important;
}
:deep(.p-inputtext) {
  color: black !important;
  background: transparent !important;
  border: none !important;
  box-shadow: none !important;
  padding: 0 !important;
}

/* Placeholder color */
:deep(.p-inputtext::placeholder) {
  color: rgba(0, 0, 0, 0.6) !important;
}

/* Dropdown suggestions */
:deep(.p-autocomplete-panel) {
  background: white !important;
  color: black !important;
}

:deep(.p-autocomplete-item) {
  color: black !important;
}

:deep(.p-autocomplete-item.p-highlight) {
  background-color: #fcd79b !important;
  color: white !important;
}
</style>
