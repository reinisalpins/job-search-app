<template>
    <div class="profile-container">
        <div class="container">
            <h2>Sveiki, {{ user?.first_name || 'User' }}</h2>
            <p>E-pasts: {{ user?.email || 'N/A' }}</p>
            <Button label="izlogoties" class="btn-bg" :loading="loading" @click="logoutUser"/>
            <UserInfoModal></UserInfoModal>
        </div>
    </div>
</template>

<script setup>
import {computed, ref} from 'vue';
import {useStore} from 'vuex';
import {logout} from "../../api/axios";
import Button from 'primevue/button';
import UserInfoModal from "../components/Profile/UserInfoModal.vue";

const skills = ref();
const store = useStore();
const user = computed(() => store.state.user);
const visible = ref(false);
const loading = ref(false)
const logoutUser = async () => {
    loading.value = true
    await logout()
    await store.dispatch('setUser', null);
    loading.value = false
}
</script>

<style lang="scss">

.profile-container {
    display: flex;
    width: 100%;
    justify-content: center;
    padding-top: 200px;
}

.edit-container {
    display: flex;
}

.btn-bg {
    background-color: red !important;
    border: none !important;

    &:hover {
        background-color: #fb6a6a !important;
    }
}

.p-dialog-content {
    padding-top: 20px !important;
}
</style>
