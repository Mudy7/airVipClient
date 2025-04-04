import { createRouter, createWebHistory } from "vue-router";
import HomeView from "./pages/homePage.vue";
import Login from "./pages/login.vue";
import Search from "./pages/search.vue";
import Manager from "./pages/manager.vue";
import Profil from "./pages/profil.vue";
import Flight from "./pages/flightDetail.vue";
import Pay from "./pages/pay.vue";

const routes = [
  { path: "/", component: HomeView }, // Home Page
  { path: "/login", component: Login }, //login
  { path: "/search", component: Search }, //search
  { path: "/flight", component: Flight }, //flight
<<<<<<< HEAD
  { path: "/payment", component: Pay },
=======
  { path: "/profil", component: Profil }, // page de profil
  { path: "/manager", component: Manager,
    beforeEnter: (to, from, next) => {
      const role = localStorage.getItem("role");
      if (role === "admin") {
        next();
      } else {
        next("/"); 
      }
    }
  },
>>>>>>> d55c2db1530fe83e55a4ec99a0bda700de785f16
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
