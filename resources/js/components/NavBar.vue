<template>
    <nav>
        <div class="nav-container" v-if="width >= 1250">
            <router-link style="color: white" to="/"><img src="/assets/logo-white.png"/></router-link>
            <ul>
                <li v-for="(item, index) in navItems" :key="index" :class="{ active: isActive(item.path) }">
                    <router-link style="color: white" :to="item.path">{{ item.label }}</router-link>
                </li>
            </ul>
        </div>
        <div class="hamburger-nav" v-if="width < 1250">
            <div class="logo-container">
                <router-link to="/"><img src="/assets/logo-white.png"/></router-link>
            </div>
            <div class="hamburger-icon">
                <button @click="showSideBar = true">
                    <i class="pi pi-bars" style="font-size: 2rem; color: white"></i>
                </button>
            </div>
        </div>
        <Sidebar v-model:visible="showSideBar" position="right">
            <ul class="sidebar-ul">
                <li v-for="(item, index) in navItems" :key="index" :class="{ active: isActive(item.path) }">
                    <router-link style="color: black" :to="item.path">{{ item.label }}</router-link>
                </li>
            </ul>
        </Sidebar>
    </nav>
</template>

<script setup>
import {computed, ref, watch} from "vue";
import {useWindowSize} from '@vueuse/core'
import {useRoute} from "vue-router";
import Sidebar from "primevue/sidebar";
import {useProfileStore} from "../store/user";

const {width} = useWindowSize()
const showSideBar = ref(false)
const route = useRoute();
const profileStore = useProfileStore();

const isLoggedIn = computed(() => profileStore.getIsLoggedIn);
const user = computed(() => profileStore.getUser);

const navItems = ref([
    {path: '/vakances', label: 'Darba vakances'},
    {path: '/prakse', label: 'Prakse'},
    {
        path: '/pasnodarbinatie',
        label: 'Pašnodarbinātajiem',
        subItems: [
            {path: '/subitem1', label: 'Subitem 1'},
            {path: '/subitem2', label: 'Subitem 2'},
        ]
    },
    {path: '/darba-devejiem', label: 'Darba devējiem'},
    {path: '/ielogoties', label: 'Ielogoties', className: 'login'},
]);

watch(isLoggedIn, (loggedIn) => {
    navItems.value = [
        {path: '/vakances', label: 'Darba vakances'},
        {path: '/prakse', label: 'Prakse'},
        // {path: '/pasnodarbinatie', label: 'Pašnodarbinātajiem'},
        {path: '/darba-devejiem', label: 'Darba devējiem'},
        {path: loggedIn ? '/profils' : '/ielogoties', label: loggedIn ? 'Profils' : 'Ielogoties', className: 'login'},
    ];
});

const isActive = (path) => {
    return route.path === path;
}

</script>

<style lang="scss">
nav {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #1C1C1C;
    z-index: 1;

    @media screen and (max-width: 1250px) {
        position: fixed;
        width: 100%;
        padding: 15px 50px;
    }

    @media screen and (max-width: 900px) {
        position: fixed;
        width: 100%;
        padding: 15px 20px;
    }


    @media screen and (max-width: 450px) {
        padding: 15px 20px;
    }

    .nav-container {
        max-width: 1600px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 15px 50px;

        img {
            max-width: 240px;
            width: 100%;
        }

        h1 {
            font-size: 2rem;
        }

        ul {
            display: flex;
            gap: 5px;
            font-size: 1.2rem;
            color: #fff;

            .login {
                background-color: #234E70;
                border-radius: 4px;
                border: 2px solid #234E70;
                color: #fff;

                &:hover {
                    opacity: .9;
                    text-decoration: none !important;
                }
            }

            li {
                list-style-type: none;
                padding: 12px;
                border: 2px solid transparent;
                border-radius: 4px;

                a {
                    text-decoration: none;
                    color: black;
                }

                &:hover {
                    text-decoration: underline;
                    text-underline-offset: 10px;
                    text-decoration-thickness: 5px;
                    text-decoration-color: #234E70;
                }
            }
        }
    }

    .hamburger-nav {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;

        .hamburger-icon {
            button {
                background-color: transparent;
                border: none;
                cursor: pointer;

                &:hover {
                    opacity: 0.8;
                }
            }
        }

        .logo-container {
            max-width: 130px;
            width: 100%;

            img {
                width: 100%;
            }
        }
    }

    .p-sidebar-icon {
        &:focus {
            box-shadow: none !important;
        }
    }

    .p-link:focus {
        &:focus {
            box-shadow: none !important;
        }
    }
}

.active {
    text-decoration: underline;
    text-underline-offset: 10px;
    text-decoration-thickness: 5px;
    text-decoration-color: #234E70;
}

.sidebar-ul {
    display: flex;
    flex-direction: column;
    gap: 30px;
    color: black;
    justify-content: center;

    li {
        a {
            font-size: 20px;
        }
    }
}
</style>

