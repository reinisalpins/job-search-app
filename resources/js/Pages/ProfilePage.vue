<template>
    <div class="profile-container">
        <div class="container" style="position: relative">
            <div v-if="!user" class="surface-section w-full">
                <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="7"/>
            </div>
            <div class="profile-divider" v-if="user">
                <div class="profile-navigation">
                    <JobSeekerProfileNavbar v-if="user.user_type === 'job_seeker'"/>
                    <EmployerProfileNavbar v-if="user.user_type === 'employer'"/>
                </div>
                <div class="profile-main">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {computed} from 'vue';
import {useProfileStore} from "../store/user";
import ProgressSpinner from "primevue/progressspinner";
import JobSeekerProfileNavbar from "../components/Profile/JobSeeker/JobSeekerProfileNavbar.vue";
import EmployerProfileNavbar from "../components/Profile/Employer/Profile/EmployerProfileNavbar.vue";

const profileStore = useProfileStore()
const user = computed(() => profileStore.getUser)

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
    background-color: transparent !important;
    padding: 15px !important;
    width: 100% !important;
    display: block !important;
    color: black !important;
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

.profile-info-list {
    display: flex;
    flex-direction: column;

    li {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
}

</style>
