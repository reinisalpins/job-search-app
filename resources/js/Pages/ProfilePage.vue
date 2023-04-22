<template>
    <div class="profile-container">
        <div class="container" style="position: relative">
            <Button :loading="logoutLoading" label="Izlogoties" @click="logout"/>
        </div>
    </div>
</template>
<script setup>
import {computed, onMounted, ref, watch} from 'vue';
import {useProfileStore} from "../store/user";
import UserInfoModal from "../components/Profile/UserInfoModal.vue";
import ProgressSpinner from "primevue/progressspinner";
import Button from "primevue/button";
import router from "../router";
import ChangePasswordModal from "../components/Profile/ChangePasswordModal.vue";

const profileStore = useProfileStore()
const user = computed(() => profileStore.getUser)
const logoutLoading = ref(false)

const logout = async () => {
    logoutLoading.value = true
    await profileStore.logout()
    await router.push('/')
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
}

</style>
