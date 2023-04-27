<template>
    <div v-if="isProfileInfoLoading">
        <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="7"/>
    </div>
    <router-view></router-view>
</template>

<script setup>
import {computed, onMounted} from "vue";
import {useEmployerStore} from "../../../../store/employer";
import {useProfileStore} from "../../../../store/user";
import ProgressSpinner from "primevue/progressspinner";

const employerStore = useEmployerStore()
const userStore = useProfileStore()

const isProfileInfoLoading = computed(() => employerStore.isEmployerProfileLoading)
const user = computed(() => userStore.getUser)

onMounted(() => {
    employerStore.fetchEmployerProfile(user.value.id)
})

</script>

<style lang="scss"></style>
