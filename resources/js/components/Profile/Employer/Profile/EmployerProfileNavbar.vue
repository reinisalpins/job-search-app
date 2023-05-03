<template>
    <div class="profile-navbar">
        <ul>
            <li :class="currentRoute === '/profils' ? 'active' : ''"
                @click="router.push('/profils')">Kopsavilkums
            </li>
            <li v-for="(item, index) in items" :key="index" @click="router.push(item.to)"
                :class="currentRoute.startsWith(item.to) ? 'active' : ''">
                {{ item.label }}
            </li>
            <Button type="button" :loading="logoutLoading" class="logout-btn" label="Izlogoties"
                    @click="logout"/>
        </ul>
    </div>
</template>

<script setup>
import Button from "primevue/button";
import router from "../../../../router";
import {useProfileStore} from "../../../../store/user";
import {computed, ref} from "vue";
import {useRoute} from "vue-router";

const routers = useRoute()
const profileStore = useProfileStore()
const logoutLoading = ref(false)
const currentRoute = computed(() => routers.path)

const items = ref([
    {
        label: 'Uzņēmuma informācija',
        to: '/profils/uznemums'
    },
    {
        label: 'Vakances',
        to: '/profils/vakances'
    },
    {
        label: 'Pieteikumi',
        to: '/profils/pieteikumi'
    },
    {
        label: 'Iestatījumi',
        to: '/profils/iestatijumi'
    },
    {
        label: 'Statistika',
        to: '/profils/statistika'
    },
]);

const logout = async () => {
    logoutLoading.value = true
    await profileStore.logout()
    await router.push('/')
    logoutLoading.value = false
}
</script>
