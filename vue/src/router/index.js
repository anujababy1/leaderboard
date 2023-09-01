import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import Leaderboard from "../pages/Leaderboard.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: Home },
        { path: "/leaderboard", component: Leaderboard, name: "Leaderboard" },
    ],
});

export default router;
