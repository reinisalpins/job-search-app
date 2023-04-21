<template>
    <div class="profile-container">
        <div class="container" style="position: relative">
            <div v-if="!isProfileInfoLoaded" class="loading-profile-spinner">
                <ProgressSpinner/>
            </div>
            <div v-if="isProfileInfoLoaded" class="profile-info-container">
                <div class="left-side">
<!--                    <div class="profile-picture">-->
<!--                        <img-->
<!--                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"/>-->
<!--                    </div>-->
                    <div v-if="!loadingProfileInfo">
                        <UserInfoModal :is-profile-info-set="isProfileInfoSet" ref="userInfoModal"
                                       :profile-info="profileInfoValue"/>
                    </div>
                    <div class="change-password">
                        <ChangePasswordModal></ChangePasswordModal>
                    </div>
                    <div class="logout">
                        <Button :loading="logoutLoading" label="Izlogoties" @click="logoutUser"
                                class="submit-btn modal-btn"/>
                    </div>
                </div>
                <div class="right-side">
                    <div class="profile-heading">
                        <h1>{{ user?.first_name }} {{ user?.last_name }}</h1>
                    </div>
                    <hr>
                    <div class="profile-info" v-if="isProfileInfoSet">
                        <h3>profila informācija</h3>
                        {{profileInfoValue}}
                        <hr>
                        <h3>jūsu pieteikumi</h3>
                    </div>
                    <div class="profile-unset-info" v-if="!isProfileInfoSet">
                        <p>Lai veiktu tālākas darbības lūdzu pievienojiet informāciju par sevi
                            <span @click="showModal">šeit</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {computed, onMounted, ref, watch} from 'vue';
import {useStore} from 'vuex';
import UserInfoModal from "../components/Profile/UserInfoModal.vue";
import ProgressSpinner from "primevue/progressspinner";
import Button from "primevue/button";
import {logout} from "../../api/axios";
import router from "../router";
import ChangePasswordModal from "../components/Profile/ChangePasswordModal.vue";

const store = useStore();
const userInfoModal = ref(null);
const logoutLoading = ref(false)

const user = computed(() => store.state.user);
const isProfileInfoLoaded = computed(() => !store.state.profile.loadingProfileInfo);

const loadData = async () => {
    await store.dispatch('profile/fetchProfileInfo', user.value.id);
};

const showModal = () => {
    userInfoModal.value.showModal();
}
onMounted(() => {
    if (user.value) {
        loadData();
    }
});

watch(user, (newUser) => {
    if (newUser) {
        store.dispatch('profile/fetchProfileInfo', newUser.id);
    }
});

const isProfileInfoSet = computed(() => isProfileInfoLoaded.value && store.getters['profile/getProfileInfo'] !== null);
const profileInfo = computed(() => store.state.profile.userProfileInfo);
const loadingProfileInfo = computed(() => store.state.profile.loadingProfileInfo);

const profileInfoValue = computed(() => {
    if (!loadingProfileInfo.value && profileInfo.value !== null) {
        return profileInfo.value;
    }
    return null;
});

const logoutUser = async () => {
    logoutLoading.value = true
    await logout()
    await router.push('/ielogoties')
    logoutLoading.value = false
};
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

.profile-info-container {
    width: 100%;
    display: flex;
    gap: 50px;

    //@media screen and (max-width: 930px) {
    //    gap: 30px;
    //}
    flex-wrap: wrap;

    .left-side {
        display: flex;
        flex-direction: column;
        gap: 20px;
        //justify-content: center;
        flex: 0 1 auto;

        hr {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .profile-picture {
            display: flex;
            max-width: 250px;
            max-height: 250px;
            width: 100%;
            height: 100%;

            img {
                width: 100%;
                height: 100%;
            }
        }
    }

    .right-side {
        flex: 2 1 auto;
        display: flex;
        flex-direction: column;

        .profile-heading {
            display: flex;
            flex-direction: column;
            gap: 15px;

            h1 {
                color: #4b4b4b;
            }
        }

        h3 {
            text-transform: uppercase;
            font-size: 15px;
            color: #a9a8a8;
            font-weight: normal;
        }
    }
}

.location-info {
    font-size: 20px;
}

hr {
    margin-top: 15px;
    margin-bottom: 15px;
}

.profile-unset-info {
    margin-top: 20px;
    background-color: red;
    padding: 20px;
    color: white;
    border-radius: 5px;
    box-shadow: rgba(0, 0, 0, 0.24) 0 3px 8px;

    span {
        text-decoration: underline;
        font-size: 20px;
        cursor: pointer;

        &:hover {
            opacity: .8;
        }
    }
}

.profile-set-info {
    margin-top: 25px;
    display: flex;
    flex-direction: row;
    gap: 25px;
    line-break: anywhere;

    .headings {
        display: flex;
        flex-direction: column;
        gap: 10px;
        text-transform: uppercase;

        span {
            font-weight: normal;
            color: #a9a8a8;
            font-size: 15px;
        }

        .values {
            margin-left: 15px;
            font-weight: bold;
            color: #6b6a6a;
            font-size: 17px;
        }
    }
}

.profile-btn {
    margin-top: 10px;
    padding: 15px;
    border-radius: 3px !important;
    font-weight: bold;

    .p-button-label {
        font-size: 12px !important;
    }
}
</style>
