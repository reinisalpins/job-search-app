<template>
    <div class="profile-navbar">
        <ul>
            <li :class="currentRoute === '/profils' ? 'active' : ''"
                @click="router.push('/profils')">Kopsavilkums
            </li>
            <li :class="currentRoute.startsWith('/profils/uznemums') ? 'active' : ''"
                @click="router.push('/profils/uznemums')">Uzņēmuma informācija
            </li>
            <li :class="currentRoute.startsWith('/profils/vakances') ? 'active' : ''"
                @click="router.push('/profils/vakances')">Vakances
            </li>
            <li>Pieteikumi</li>
            <li>Iestatījumi</li>
            <li>Statistika</li>
            <Button type="button" :loading="logoutLoading" class="logout-btn" label="Izlogoties"
                    @click="logout"/>
        </ul>
    </div>
</template>
<script setup>
import Button from "primevue/button";
import router from "../../../../router";
import {useProfileStore} from "../../../../store/user";
import {computed, ref, watch} from "vue";
import {useRoute} from "vue-router";

const routers = useRoute()
const profileStore = useProfileStore()
const logoutLoading = ref(false)
const currentRoute = computed(() => routers.path)

const logout = async () => {
    logoutLoading.value = true
    await profileStore.logout()
    await router.push('/')
    logoutLoading.value = false
}
</script>
