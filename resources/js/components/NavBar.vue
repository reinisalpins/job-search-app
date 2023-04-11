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
                <button @click="showSb">
                    <i class="pi pi-bars" style="font-size: 2rem; color: white"></i>
                </button>
            </div>
        </div>
        <div :class="showSideBar ? 'side-nav open' : 'side-nav'">
            <ul :class="showClassChange">
                <li v-for="(item, index) in navItems" :key="index" :class="{ active: isActive(item.path) }">
                    <router-link style="color: white" :to="item.path">{{ item.label }}</router-link>
                </li>
            </ul>
            <div :class="showClassChange" class="logo-side-nav">
                <img src="/assets/logo-white.png"/>
            </div>
            <div class="close-btn" v-if="showSideBar">
                <button @click="showSb">
                    <i class="pi pi-times" style="font-size: 2rem; color: white "></i>
                </button>
            </div>
        </div>
    </nav>
</template>

<script setup>
import {computed, ref, watch} from "vue";
import {useWindowSize} from '@vueuse/core'
import {useRoute} from "vue-router";
import { useStore } from 'vuex';

const {width, height} = useWindowSize()
const showSideBar = ref(false)
const showClassChange = ref('hide')
const route = useRoute();

const store = useStore();

const isLoggedIn = computed(() => store.getters.isLoggedIn);
const user = computed(() => store.state.user);

const navItems = ref([
    {path: '/vakances', label: 'Darba vakances'},
    {path: '/prakse', label: 'Prakse'},
    {path: '/pasnodarbinatie', label: 'Pašnodarbinātajiem'},
    {path: '/darba-devejiem', label: 'Darba devējiem'},
    {path: '/ielogoties', label: 'Ielogoties', className: 'login'},
]);

watch(isLoggedIn, (loggedIn) => {
    navItems.value = [
        {path: '/vakances', label: 'Darba vakances'},
        {path: '/prakse', label: 'Prakse'},
        {path: '/pasnodarbinatie', label: 'Pašnodarbinātajiem'},
        {path: '/darba-devejiem', label: 'Darba devējiem'},
        {path: loggedIn ? '/profils' : '/ielogoties', label: loggedIn ? 'Profils' : 'Ielogoties', className: 'login'},
    ];
});

const showSb = () => {
    showSideBar.value = !showSideBar.value
    if (showSideBar.value) {
        setTimeout(() => {
            showClassChange.value = 'show'
        }, 220)
    } else {
        showClassChange.value = 'hide'
    }
}
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


    .side-nav {
        position: fixed;
        height: 200vh;
        right: 0;
        width: 0;
        opacity: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #000;
        transition: .5s;


        ul {
            margin-top: 300px;
            display: none;
            flex-direction: column;
            gap: 20px;

            li {
                list-style-type: none;
                color: #fff;
                padding: 7px;

                &:hover {
                    text-decoration: underline;
                    text-underline-offset: 10px;
                    text-decoration-thickness: 5px;
                    text-decoration-color: #234E70;
                }
            }


            .login {
                background-color: #234E70;
                border-radius: 4px;
                border: 2px solid #234E70;

                a {
                    color: #fff;
                }

                &:hover {
                    opacity: .9;
                }
            }
        }

        .logo-side-nav {
            position: absolute;
            bottom: 70px;
            margin-left: 15px;
            width: 150px;

            img {
                width: 100%;
            }
        }

        .close-btn {
            position: absolute;
            right: 50px;

            button {
                background-color: transparent;
                border: none;
                cursor: pointer;

                &:hover {
                    opacity: 0.9;
                }

                svg {
                    font-size: 40px;
                    color: #fff;
                }

            }
        }
    }
}

.open {
    opacity: 1 !important;
    width: 250px !important;
}

.hide {
    display: none !important;
}

.show {
    display: flex !important;
}

.active {
    text-decoration: underline;
    text-underline-offset: 10px;
    text-decoration-thickness: 5px;
    text-decoration-color: #234E70;
}
</style>

