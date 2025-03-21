import { createRouter, createWebHistory } from "vue-router";
import HomeView from "./pages/homePage.vue";
import Login from "./pages/login.vue";

const routes = [
  { path: "/", component: HomeView }, // Home Page
  { path: "/login", component: Login },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
