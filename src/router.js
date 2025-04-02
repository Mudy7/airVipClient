import { createRouter, createWebHistory } from "vue-router";
import HomeView from "./pages/homePage.vue";
import Login from "./pages/login.vue";
import Search from "./pages/search.vue";
//import Flight from "./pages/flightDetail.vue";

const routes = [
  { path: "/", component: HomeView }, // Home Page
  { path: "/login", component: Login }, //login
  { path: "/search", component: Search }, //search
  { path: "/manage", component: Manager,
    beforeEnter: (to, from, next) => {
      const role = localStorage.getItem("role");
      if (role === "admin") {
        next();
      } else {
        next("/"); 
      }
    }
  },
  //{ path: "/flight", component: Flight }, //flight
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
