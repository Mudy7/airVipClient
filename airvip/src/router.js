import { createRouter, createWebHistory } from "vue-router";
import HomeView from "./pages/HomePage.vue";

const routes = [
  { path: "/", component: HomeView }, // Home Page
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
