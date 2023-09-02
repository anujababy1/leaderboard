import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import Leaderboard from "../pages/Leaderboard.vue";
import CreateCompetitor from "../pages/competitors/Create.vue";
import ShowCompetitor from "../pages/competitors/Show.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: Home },
        { path: "/leaderboard", component: Leaderboard, name: "Leaderboard" },
        {
            path: "/users/create",
            component: CreateCompetitor,
            name: "CreateCompetitor",
        },
        {
            path: "/users/:id",
            name: "ShowCompetitor",
            component: ShowCompetitor,
            props: true,
        },
    ],
});

export default router;
