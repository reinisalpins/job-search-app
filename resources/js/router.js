import {createRouter, createWebHistory} from 'vue-router';
import HomePage from "./Pages/HomePage.vue";
import JobListingsPage from "./Pages/JobListingsPage.vue";
import LoginPage from "./Pages/LoginPage.vue";
import RegisterPage from "./Pages/RegisterPage.vue";
import ProfilePage from "./Pages/ProfilePage.vue";
import NotFoundPage from "./Pages/NotFoundPage.vue";
import Employers from "./Pages/Employers.vue";

const routes = [
    {path: '/', component: HomePage},
    {path: '/vakances', component: JobListingsPage},
    {path: '/ielogoties', component: LoginPage},
    {path: '/darba-devejiem', component: Employers},
    {path: '/registreties', component: RegisterPage},
    {path: '/profils', component: ProfilePage},
    {path: '/profils/:section', component: ProfilePage},
    {path: '/:pathMatch(.*)*', component: NotFoundPage},
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
