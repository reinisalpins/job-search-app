<template>
    <div v-if="employerProfile">
        <SummaryPanel :company-info="employerProfile"/>
    </div>
    <div v-if="!employerProfile && !loading">
        <Message :closable="false" severity="info">Uzņēmuma informācija vēl nav iestatīta, to variet izdarīt
            <router-link to="/vadibas-panelis/uznemuma-informacija" class="hover:underline font-bold">šeit</router-link>
        </Message>
    </div>
    <div v-if="loading">
        <i class="pi pi-spin pi-spinner text-4xl"></i>
    </div>
</template>

<script setup>
import {useEmployerStore} from "../../../../store/employer";
import {computed} from "vue";
import Message from "primevue/message";
import SummaryPanel from "./SummaryPanel.vue";

const employerPinia = useEmployerStore()

const employerProfile = computed(() => employerPinia.getEmployerProfileInfo)
const loading = computed(() => employerPinia.isLoading)
</script>
