import { createRouter, createWebHistory } from "vue-router";
import HomeView from "./pages/homePage.vue";
import Login from "./pages/login.vue";
import Search from "./pages/search.vue";
import Manager from "./pages/manager.vue";
import Profil from "./pages/profil.vue";
import Flight from "./pages/flightDetail.vue";
import Pay from "./pages/pay.vue";
import confirmation from "./pages/confirmation.vue";
import { isAuthenticated } from "./assets/utils/auth.js";
import contact from "./pages/contact.vue";

const routes = [
  { path: "/", component: HomeView }, // Home Page
  { path: "/login", component: Login }, //login
  { path: "/search", component: Search }, //search
  { path: "/flight", component: Flight }, //flight
  { path: "/profil", component: Profil }, // page de profil
  {
    path: "/manager",
    component: Manager,
    beforeEnter: (to, from, next) => {
      const role = localStorage.getItem("role");
      if (role === "admin") {
        next();
      } else {
        next("/");
      }
    },
  },
  {
    path: "/confirmation",
    component: () => import("./pages/confirmation.vue"),
  },

  {
    path: "/payment",
    component: Pay,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem("token");
      if (token) {
        next();
      } else {
        next("/login");
      }
    },
  },
  { path: "/contact", component: contact}
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
