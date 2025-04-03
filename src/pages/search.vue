<template>
  <navBar />
  <div class="flex flex-col w-full md:flex-row py-5 px-3 gap-8">
    <!-- Main Content -->
    <main class="flex flex-col w-full p-4 md:p-10">
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
              class="text-[10px] md:text-[12px] flex items-center py-[6px] px-3 focus:ring-1 ring-gray-300 rounded-lg shadow-sm focus:ring-primary focus:ring-opacity-75 bg-white"
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
          class="flex flex-row w-full shadow-[0_4px_15px_rgba(0,0,0,0.2)] rounded-lg overflow-hidden mb-6 bg-white cursor-pointer"
        >
          <!-- Image Section -->
          <div class="w-[35%] group p-3">
            <div class="relative aspect-[16/9] overflow-hidden rounded-lg">
              <img
                class="w-full h-full object-cover"
                :src="flight.images[flight.currentImage - 1]"
                alt="Flight Image"
              />

              <!-- Dots -->
              <div
                class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex gap-1.5"
              >
                <span
                  v-for="dot in flight.totalImages"
                  :key="dot"
                  class="w-1.5 h-1.5 rounded-full"
                  :class="{
                    'bg-white': dot === flight.currentImage,
                    'bg-gray-300': dot !== flight.currentImage,
                  }"
                ></span>
              </div>

              <!-- Arrows -->
              <button
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white p-1 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                @click="prevFlightImage(flight)"
                v-if="flight.currentImage > 1"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                  />
                </svg>
              </button>
              <button
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white p-1 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                @click="nextFlightImage(flight)"
                v-if="flight.currentImage < flight.totalImages"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 rotate-180"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                  />
                </svg>
              </button>
            </div>
          </div>

          <div
            class="flex-1 p-4 flex flex-col justify-between"
            @click="goToFlightPage(flight)"
          >
            <!-- Top Row: Title and Price -->
            <div class="flex justify-between items-start mb-2">
              <h3 class="text-lg md:text-lg font-semibold">
                {{ flight.plane }}
              </h3>
              <p class="text-lg font-semibold text-right whitespace-nowrap">
                {{ getFormattedPrice(flight) }} $
              </p>
            </div>

            <!-- Route Info -->
            <div class="text-gray-600 text-sm md:text-base">
              <div
                class="flex items-center gap-2 text-sm md:text-base text-gray-600"
              >
                <!-- Takeoff -->
                <img
                  src="../../public/assets/icons/takeoff.svg"
                  class="w-5 invert"
                />
                <span class="font-medium">{{ flight.from }}</span>

                <!-- Line + Duration + Line -->
                <div class="flex items-center gap-2 flex-1 px-2">
                  <div class="flex-1 h-px bg-gray-300"></div>
                  <span
                    class="whitespace-nowrap text-xs md:text-sm text-gray-500"
                    >{{ flight.duration }} heure</span
                  >
                  <div class="flex-1 h-px bg-gray-300"></div>
                </div>

                <!-- Landing -->
                <img
                  src="../../public/assets/icons/landing.svg"
                  class="w-5 invert"
                />
                <span class="font-medium">{{ flight.to }}</span>
              </div>
            </div>

            <!-- Bottom Row: Departure on Left -->
            <div class="mt-4">
              <p class="text-gray-400 text-xs text-left">
                Départure: {{ formatDate(flight.departureDate) }}
              </p>
            </div>
          </div>
        </div>
      </section>

      <section v-else>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 gap-y-5">
          <div
            v-for="(flight, index) in flights"
            :key="index"
            class="flex flex-col bg-white rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.2)] overflow-hidden cursor-pointer hover:shadow-lg duration-300"
          >
            <!-- Image -->
            <div class="relative h-[200px] w-full group">
              <img
                class="w-full h-full object-cover"
                :src="flight.images[flight.currentImage - 1]"
                alt="Flight Image"
              />

              <!-- Dots -->
              <div
                class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex gap-1.5"
              >
                <span
                  v-for="dot in flight.totalImages"
                  :key="dot"
                  class="w-1.5 h-1.5 rounded-full"
                  :class="{
                    'bg-white': dot === flight.currentImage,
                    'bg-gray-300': dot !== flight.currentImage,
                  }"
                ></span>
              </div>

              <!-- Arrows -->
              <button
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white p-1 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                @click="prevFlightImage(flight)"
                v-if="flight.currentImage > 1"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                  />
                </svg>
              </button>
              <button
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white p-1 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                @click="nextFlightImage(flight)"
                v-if="flight.currentImage < flight.totalImages"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 rotate-180"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                  />
                </svg>
              </button>
            </div>

            <!-- Info Section -->
            <div class="p-3 flex flex-col justify-between h-full text-[11px]">
              <!-- Plane -->
              <h3 class="font-semibold mb-4 text-[12px]">{{ flight.plane }}</h3>

              <!-- Route Info -->
              <div class="flex items-center gap-1 text-gray-600 mb-2">
                <img
                  src="../../public/assets/icons/takeoff.svg"
                  class="w-4 invert"
                />
                <span>{{ flight.from }}</span>
                <div class="flex items-center gap-1 flex-1 px-1">
                  <div class="flex-1 h-px bg-gray-300"></div>
                  <span class="text-gray-500">{{ flight.duration }} h</span>
                  <div class="flex-1 h-px bg-gray-300"></div>
                </div>
                <img
                  src="../../public/assets/icons/landing.svg"
                  class="w-4 invert"
                />
                <span>{{ flight.to }}</span>
              </div>

              <!-- Departure + Price -->
              <div class="flex justify-between items-center text-gray-500">
                <p class="text-[10px]">
                  Départure: {{ formatDate(flight.departureDate) }}
                </p>
                <p class="text-[11px] font-semibold whitespace-nowrap">
                  {{ getFormattedPrice(flight) }} $
                </p>
              </div>
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
      selectedSort: "Price Ascendant",
      sortOptions: ["prix Descendant"],
      numberOfResults: 5,
      searchParams: [],
      flights: [
        {
          id: 1,
          images: [
            "https://i.pinimg.com/736x/31/b3/52/31b3520c5ca15a76b1326a724ce75644.jpg",
            "https://imageio.forbes.com/specials-images/imageserve/620a5ca7309af58b6b77d907/0x0.jpg?format=jpg&height=900&width=1600&fit=bounds",
          ],
          currentImage: 1,
          totalImages: 2,
          title: "Vol Paris",
          plane: "Bombardier Global Express",
          from: "Montreal",
          to: "Paris",
          departureDate:
            "Mon Mar 17 2025 00:00:00 GMT-0400 (Eastern Daylight Time)",
          price: 3500,
          duration: 8,
        },
        {
          images: [
            "https://i.pinimg.com/736x/1e/23/3c/1e233c7c1d073e8e4dfa216fa42ea65b.jpg",
            "https://www.sunairjets.com/wp-content/uploads/2023/05/Gulfstream-GIV-SP-Private-Jet-Interior.png",
          ],
          id: 2,
          currentImage: 1,
          totalImages: 2,
          title: "Vol à Tokyo",
          plane: "Embraer Phenom 300",
          from: "Paris",
          to: "Tokyo",
          departureDate:
            "Mon Mar 17 2025 00:00:00 GMT-0400 (Eastern Daylight Time)",
          price: 4500,
          duration: 14,
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
    goToFlightPage(flight) {
      this.$router.push({
        path: "/flight",
        query: {
          id: flight.id,
          departureDate: flight.departureDate,
        },
      });
    },
    prevFlightImage(flight) {
      if (flight.currentImage > 1) {
        flight.currentImage--;
      }
    },
    nextFlightImage(flight) {
      if (flight.currentImage < flight.totalImages) {
        flight.currentImage++;
      }
    },
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
      this.sortOptions.push(this.selectedSort);
      this.sortOptions = this.sortOptions.filter((item) => item !== option);
      this.selectedSort = option;
      this.showDropdown = false;

      if (option.toLowerCase().includes("ascendant")) {
        this.flights.sort((a, b) => a.price - b.price); // ascending
      } else if (option.toLowerCase().includes("descendant")) {
        this.flights.sort((a, b) => b.price - a.price); // descending
      }
    },

    filteredOptions() {
      return this.sortOptions.filter((option) => option !== this.selectedSort);
    },
    getFormattedPrice(flight) {
      const total = flight.price * flight.duration;
      return total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    },
    dynamicTitle() {
      const from = this.searchParams[0] || "Unknown";
      const to = this.searchParams[1] || "Unknown";
      const date = this.searchParams[2]
        ? this.formatDate(this.searchParams[2])
        : "Any Date";

      if (from !== "Unknown" && to !== "Unknown") {
        return `Vol de ${from} à ${to}`;
      } else {
        return "Vol Disponible";
      }
    },
  },
};
</script>
