<template>
    <div class="profile-navbar">
        <ul>
            <li>Profila informācija</li>
            <li>Mani pieteikumi</li>
            <li>Pieteikumu statistika</li>
            <li>Iestatijumi</li>
            <Button type="button" :loading="logoutLoading" class="logout-btn" label="Izlogoties"
                    @click="logout"/>
        </ul>
    </div>
</template>
<script setup>
import Button from "primevue/button";
import router from "../../../router";
import {useProfileStore} from "../../../store/user";
import {ref} from "vue";

const profileStore = useProfileStore()
const logoutLoading = ref(false)

const logout = async () => {
    logoutLoading.value = true
    await profileStore.logout()
    await router.push('/')
    logoutLoading.value = false
}
</script>
