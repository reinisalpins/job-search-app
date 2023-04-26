<template>
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
</template>
<script setup>
import router from "../../router";
import ProfileInfo from "./UserProfileInfo.vue";
import ChangePassword from "./ChangePassword.vue";
import Button from "primevue/button";
import UserApplyStats from "./UserApplyStats.vue";
import {useProfileStore} from "../../store/user";
import {computed, onBeforeMount, ref, watch} from "vue";

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
    await router.push('/')
    logoutLoading.value = false
}
</script>
