<template>
    <div v-if="!user">
        <i class="pi pi-spin pi-spinner text-4xl"></i>
    </div>
    <div v-if="user" class="flex flex-column gap-5">
        <div>
            <EmployerNavigation v-if="user.user_type === 'employer'"/>
        </div>
        <div class="flex-1">
            <router-view></router-view>
        </div>
    </div>
</template>
<script setup>
import {computed} from 'vue';
import {useUserStore} from "../store/user";
import ProgressSpinner from "primevue/progressspinner";
import EmployerNavigation from "../components/dashboard/navigation/EmployerNavigation.vue";

const userPinia = useUserStore()
const user = computed(() => userPinia.getUser)

</script>
<style lang="scss" scoped>

</style>
