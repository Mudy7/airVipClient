<template>
  <div class="flex items-center justify-center p-4">
    <form
      @submit.prevent="searchFlights"
      :class="[
        'flex flex-col md:flex-row items-center shadow-md rounded-xl md:rounded-full py-4 md:py-1 px-4 md:space-x-3 space-y-3 md:space-y-0 w-auto max-w-3xl border transition-all duration-300 bg-white/20 border-white backdrop-blur-sm backdrop-filter text-white',
      ]"
    >
      <!-- FROM Input -->
      <div class="flex flex-1 items-center md:pl-2 w-full">
        <img src="../../public/assets/icons/takeoff.svg" class="w-5" />
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
        <img src="../../public/assets/icons/landing.svg" class="w-5" />
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
        <img src="../../public/assets/icons/calendar.svg" class="w-5" />
        <div class="flex flex-row md:flex-col w-full px-4 py-2 cursor-pointer">
          <label class="text-sm text-start md:mb-1 pr-2">Departure</label>
          <DatePicker
            v-model="departureDate"
            placeholder="Date"
            size="small"
            class="text-sm focus:outline-none w-full"
            dateFormat="dd/mm"
            required
          />
        </div>
      </div>

      <!-- SEARCH BUTTON -->
      <button
        type="submit"
        class="relative flex items-center w-full md:w-auto justify-center bg-secondary rounded-full p-5 cursor-pointer"
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
  name: "FlightSearchBar",
  components: { DatePicker, AutoComplete },
  props: {
    solid: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      from: "",
      to: "",
      departureDate: null,
      cities: [],
      filteredCities: [],
    };
  },
  setup() {
    const router = useRouter();
    return { router };
  },
  async mounted() {
    const { body } = await get("aeroports/villes");
    this.cities = body;
    console.log(this.cities);
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

<style>
.p-inputtext {
  box-shadow: none !important;
  border: none !important;
  padding: 0 !important;
  color: white !important;
}
.p-autocomplete-placeholder-color {
  color: whitesmoke !important;
}
.p-icon-spin {
  color: white !important;
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
  color: black !important;
}

.p-datepicker-header {
  background-color: white !important;
  color: black !important;
}

.p-datepicker-select-month,
.p-datepicker-select-year,
.p-datepicker-weekday,
.p-datepicker-day {
  color: black !important;
}

.p-autocomplete-overlay {
  background-color: white !important;
  color: black !important;
}
.p-button:hover,
.p-datepicker-select-year:hover,
.p-datepicker-select-month:hover,
.p-datepicker-day:hover {
  background-color: #fcd79b !important;
  color: white !important;
}

.p-datepicker-today > .p-datepicker-day {
  background-color: #f9bb12 !important;
  color: white !important;
}

.p-datepicker-day-selected {
  background-color: #fcd79b !important;
  color: white !important;
}

td.p-datepicker-day-cell.p-datepicker-today {
  color: white !important;
}

.placeholder-white::placeholder {
  color: rgba(255, 255, 255, 1) !important;
}

.placeholder-black::placeholder {
  color: black !important;
}
input::placeholder {
  color: #b0aeae !important;
}
</style>
