import {createRouter, createWebHistory} from 'vue-router';
import HomePage from "./Pages/HomePage.vue";
import JobListingsPage from "./Pages/JobListingsPage.vue";
import ProfilePage from "./Pages/ProfilePage.vue";
import NotFoundPage from "./Pages/NotFoundPage.vue";
import Employers from "./Pages/Employers.vue";

const routes = [
    {path: '/', component: HomePage},
    {path: '/vakances', component: JobListingsPage},
    {path: '/darba-devejiem', component: Employers},
    {path: '/profils', component: ProfilePage, meta: {requiresAuth: true}},
    {path: '/profils/:section', component: ProfilePage, meta: {requiresAuth: true}},
    {path: '/:pathMatch(.*)*', component: NotFoundPage},
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
