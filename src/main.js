import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import router from "./router";

const app = createApp(App);
app.use(router); // Correctly attach the router
app.mount("#app"); // Mount the Vue app
