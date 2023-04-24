<template>
    <div class="profile-container">
        <div class="container" style="position: relative">
            <!--            <Button :loading="logoutLoading" label="Izlogoties" @click="logout"/>-->
            <div v-if="!user" class="surface-section w-full">
                <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="7"/>
            </div>
            <div class="profile-divider" v-if="user">
                <div class="profile-navigation">
                    <div class="profile-navbar">
                        <ul>
                            <li :class="activeComponent === 1 ? 'active' : ''" @click="router.push('/profils')">
                                Profila informācija
                            </li>
                            <li @click="router.push('/profils/pieteikumi')"
                                :class="activeComponent === 2 ? 'active' : ''">
                                Mani pieteikumi
                            </li>
                            <li @click="router.push('/profils/statistika')"
                                :class="activeComponent === 3 ? 'active' : ''">
                                Pieteikumu statistika
                            </li>
                            <li @click="router.push('/profils/mainit-paroli')"
                                :class="activeComponent === 4 ? 'active' : ''">
                                Mainīt paroli
                            </li>
                            <Button type="button" :loading="logoutLoading" class="logout-btn" label="Izlogoties"
                                    @click="logout"/>
                        </ul>
                    </div>
                </div>
                <div class="profile-main">
                    <ProfileInfo :user="user" v-if="activeComponent === 1"/>
                    <UserApplyStats v-if="activeComponent === 3"/>
                    <ChangePassword v-if="activeComponent === 4"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {computed, ref, watch, onBeforeMount} from 'vue';
import {useProfileStore} from "../store/user";
import ProgressSpinner from "primevue/progressspinner";
import router from "../router";
import ProfileInfo from "../components/Profile/ProfileInfo.vue";
import Button from "primevue/button";
import ChangePassword from "../components/Profile/ChangePassword.vue";
import UserApplyStats from "../components/Profile/UserApplyStats.vue";

const profileStore = useProfileStore()
const user = computed(() => profileStore.getUser)
const logoutLoading = ref(false)
const activeComponent = ref(1)

const setActiveComponentByRoute = () => {
    const currentPath = router.currentRoute.value.path;
    switch (currentPath) {
        case '/profils':
            activeComponent.value = 1;
            break;
        case '/profils/pieteikumi':
            activeComponent.value = 2;
            break;
        case '/profils/statistika':
            activeComponent.value = 3;
            break;
        case '/profils/mainit-paroli':
            activeComponent.value = 4;
            break;
        default:
            activeComponent.value = 1;
            break;
    }
}


watch(router.currentRoute, () => {
    setActiveComponentByRoute()
})

onBeforeMount(() => {
    setActiveComponentByRoute()
})

const logout = async () => {
    logoutLoading.value = true
    await profileStore.logout()
    await router.push('/ielogoties')
    logoutLoading.value = false
}

</script>
<style lang="scss">
.profile-container {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    .profile-divider {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;

        @media screen and (max-width: 900px) {
            flex-direction: column;
        }

        .profile-navigation {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 250px;

            .profile-navbar {
                border: 1px solid #dee2e6;
                border-radius: 6px;

                ul {
                    display: flex;
                    flex-direction: column;
                }

                li {
                    padding: 15px;
                    border-bottom: 1px solid #e1e6eb;

                    &:hover {
                        background-color: #f8f9fa;
                        cursor: pointer;
                    }
                }

                .active {
                    background-color: #f8f9fa;
                    text-decoration: none !important;
                    font-weight: bold;
                }
            }
        }

        .profile-main {
            flex: 2;
            width: 100%;
            display: flex;
            flex-direction: column;

            .p-message {
                margin: 0 !important;
            }
        }
    }
}

.panel-style {
    margin-bottom: 50px;
}

.logout-btn {
    border: none !important;
    text-align: left !important;
    background-color: transparent;
    padding: 15px !important;
    width: 100% !important;
    display: block !important;
    color: black;
    border-radius: 0px !important;
    transition: none !important;
    
    &:focus {
        border: none !important;
        box-shadow: none !important;
    }

    &:active {
        border: none !important;
        box-shadow: none !important;
    }

    &:hover {
        border: none !important;
        box-shadow: none !important;
        background-color: #eceeed !important;
        color: black !important;
        font-weight: normal !important;
    }

    &:enabled:active {
        background: transparent !important;
        color: black !important;
    }
}

</style>
