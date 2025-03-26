<template>
  <navBar />
  <div class="flex flex-col w-full md:flex-row py-5 px-3 gap-8">
    <!-- Main Content -->
    <main class="flex flex-col w-full p-10">
      <!-- Tag Section -->

      <!-- Title -->
      <div class="flex justify-between mb-6 md:mb-8">
        <span class="font-BasisGrotesque text-[23px] sm:text-[28px]">{{
          dynamicTitle()
        }}</span>
      </div>

      <!-- Results and Sorting Section -->
      <div
        class="flex text-[12px] flex-row items-end justify-between mb-2 md:mb-4"
      >
        <div class="flex gap-1">
          <span>{{ numberOfResults }}</span>
          <span class="text-gray-600">results</span>
        </div>

        <div class="flex gap-6 items-center">
          <div class="relative">
            <button
              @click="toggleDropdown"
              @blur="toggleDropdown"
              class="flex items-center py-[6px] px-3 focus:ring-1 ring-gray-300 rounded-lg shadow-sm focus:ring-primary focus:ring-opacity-75 bg-white"
            >
              {{ selectedSort }}
              <div>
                <img
                  class="ml-1 w-2 h-2"
                  src="/assets/icons/chevronGray.svg"
                  alt="Sort"
                />
              </div>
            </button>

            <Dropdown
              :options="filteredOptions()"
              :showDropdown="showDropdown"
              @select="selectSort"
              class="absolute right-0"
            />
          </div>
        </div>
      </div>

      <!-- Flight Cards (List for Desktop, Grid for Mobile) -->
      <section v-if="!isMobile">
        <div
          v-for="(flight, index) in flights"
          :key="index"
          class="flex flex-row w-full rounded-lg shadow-md overflow-hidden mb-6"
        >
          <div class="w-[35%] p-3">
            <div class="relative aspect-[16/9] overflow-hidden rounded-lg">
              <img
                class="w-full h-full object-cover"
                :src="flight.images[0]"
                alt="Flight Image"
              />
            </div>
          </div>

          <div class="flex-1 p-4 flex flex-col justify-between">
            <h3 class="text-sm sm:text-lg md:text-xl">{{ flight.title }}</h3>
            <div class="text-gray-400 text-[12px]">
              <span class="block">From: {{ flight.from }}</span>
              <span class="block">To: {{ flight.to }}</span>
              <span class="block"
                >Departure: {{ formatDate(flight.departureDate) }}</span
              >
            </div>
            <p class="text-sm sm:text-md md:text-lg">{{ flight.price }} $</p>
          </div>
        </div>
      </section>

      <section v-else>
        <div class="grid grid-cols-2 gap-3 gap-y-5">
          <div
            v-for="(flight, index) in flights"
            :key="index"
            class="flex flex-col bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:shadow-lg duration-300"
          >
            <div class="relative aspect-square">
              <img
                class="w-full h-full object-cover"
                :src="flight.images[0]"
                alt="Flight Image"
              />
            </div>

            <div class="p-4 flex flex-col">
              <h3 class="text-sm sm:text-lg">{{ flight.title }}</h3>
              <p class="text-sm sm:text-md">{{ flight.price }} $</p>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import NavBar from "../components/navbar2.vue";
import Dropdown from "../components/dropDown.vue";

export default {
  name: "SearchPage",
  components: {
    NavBar,
    Dropdown,
  },
  data() {
    return {
      isMobile: window.innerWidth < 768,
      showDropdown: false,
      selectedSort: "Recommended",
      sortOptions: ["Price Descending", "Price Ascending", "Newest"],
      numberOfResults: 5,
      searchParams: [],
      flights: [
        {
          images: [
            "https://i.pinimg.com/736x/31/b3/52/31b3520c5ca15a76b1326a724ce75644.jpg",
          ],
          title: "Flight to Paris",
          from: "Montreal",
          to: "Paris",
          departureDate:
            "Mon Mar 17 2025 00:00:00 GMT-0400 (Eastern Daylight Time)",
          price: 850,
        },
        {
          images: [
            "https://i.pinimg.com/736x/1e/23/3c/1e233c7c1d073e8e4dfa216fa42ea65b.jpg",
          ],
          title: "Flight to Tokyo",
          from: "Paris",
          to: "Tokyo",
          departureDate:
            "Mon Mar 17 2025 00:00:00 GMT-0400 (Eastern Daylight Time)",
          price: 1200,
        },
      ],
    };
  },
  mounted() {
    this.getSearchParams();
    window.addEventListener("resize", this.handleResize);
  },
  beforeUnmount() {
    window.removeEventListener("resize", this.handleResize);
  },
  methods: {
    handleResize() {
      this.isMobile = window.innerWidth < 768;
    },
    getSearchParams() {
      const params = new URLSearchParams(window.location.search);
      const from = params.get("from") || "Unknown";
      const to = params.get("to") || "Unknown";
      const departureDate = params.get("departureDate") || "Unknown Date";

      this.searchParams = [from, to, departureDate];
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toDateString();
    },
    removeTag(index) {
      this.searchParams.splice(index, 1);
    },
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    selectSort(option) {
      this.selectedSort = option;
      this.showDropdown = false;
    },
    filteredOptions() {
      return this.sortOptions.filter((option) => option !== this.selectedSort);
    },
    dynamicTitle() {
      const from = this.searchParams[0] || "Unknown";
      const to = this.searchParams[1] || "Unknown";
      const date = this.searchParams[2]
        ? this.formatDate(this.searchParams[2])
        : "Any Date";

      if (from !== "Unknown" && to !== "Unknown") {
        return `Vol de ${from} à ${to} - ${date}`;
      } else {
        return "Vol Disponible";
      }
    },
  },
};
</script>
