import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import StationView from "../views/StationView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/:station",
      name: "station",
      component: () => StationView,
    },
    {
      path: "/:station/:line",
      name: "station-line",
      component: () => StationView,
    },
    {
      path: "/:station/:line/:destination",
      name: "station-line-destination",
      component: () => StationView,
    },
  ],
});

export default router;
