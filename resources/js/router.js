import { createRouter, createWebHistory } from 'vue-router';
import HomePage from "./Pages/HomePage.vue";
import JobListingsPage from "./Pages/JobListingsPage.vue";
import LoginPage from "./Pages/LoginPage.vue";
import RegisterPage from "./Pages/RegisterPage.vue";
import ProfilePage from "./Pages/ProfilePage.vue";
import store from "./store";
import {watchEffect} from "vue";

watchEffect(() => {
    const isLoggedIn = store.getters.isLoggedIn;
});

const routes = [
    {path: '/', component: HomePage},
    {path: '/vakances', component: JobListingsPage},
    {path: '/ielogoties', component: LoginPage},
    {path: '/registreties', component: RegisterPage},
    {path: '/profils', component: ProfilePage}
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
