import { createRouter, createWebHistory } from 'vue-router';
import HomePage from "./Pages/HomePage.vue";
import JobListingsPage from "./Pages/JobListingsPage.vue";

const routes = [
    {path: '/', component: HomePage},
    {path: '/vakances', component: JobListingsPage}
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

