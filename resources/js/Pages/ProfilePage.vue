<template>
    <div class="profile-container">
        <div class="container">
            <div class="profile-info-container">
<!--            <h2>Sveiki, {{ user?.first_name || 'User' }}</h2>-->
<!--            <p>E-pasts: {{ user?.email || 'N/A' }}</p>-->
<!--            <Button label="izlogoties" class="btn-bg" :loading="loading" @click="logoutUser"/>-->
<!--            <UserInfoModal></UserInfoModal>-->
                <div class="profile-picture">
                    <img src="/assets/logo.png"/>
                </div>
                <div class="user-info">
                    Jūsu vārds: {{user.first_name}} {{user.last_name}}
                </div>
            </div>
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
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
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

.profile-info-container{
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 50px;
    //flex-wrap: wrap-reverse;
    //align-items: left;

    .profile-picture {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        padding: 10px;
        border-radius: 2px;
        max-width: 250px;
        max-height: 200px;
        width: 100%;
        height: 100%;
        img {
            //max-width: 250px;
            //max-height: 200px;
            width: 100%;
            height: 100%;
        }
    }

    .user-info {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        padding: 10px;
        border-radius: 2px;
    }
}
</style>
