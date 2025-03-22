import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import router from "./router";
import PrimeVue from "primevue/config";
import Aura from "@primeuix/themes/aura";
import { definePreset } from "@primeuix/themes";

const app = createApp(App);
app.use(router); // Correctly attach the router
const MyPreset = definePreset(Aura, {
  semantic: {
    primary: {
      50: "{amber.50}",
      100: "{amber.100}",
      200: "{amber.200}",
      300: "{amber.300}",
      400: "{amber.400}",
      500: "{amber.500}",
      600: "{amber.600}",
      700: "{amber.700}",
      800: "{amber.800}",
      900: "{amber.900}",
      950: "{amber.950}",
    },
  },
});
app.use(PrimeVue, {
  theme: {
    preset: MyPreset,
  },
});
app.mount("#app"); // Mount the Vue app
