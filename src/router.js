import { createRouter, createWebHistory } from "vue-router";
import HomeView from "./pages/homePage.vue";
import Login from "./pages/login.vue";
import Search from "./pages/search.vue";
import Manager from "./pages/manager.vue";

const routes = [
  { path: "/", component: HomeView }, // Home Page
  { path: "/login", component: Login },
  { path: "/search", component: Search },
  { path: "/manage", component: Manager }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
