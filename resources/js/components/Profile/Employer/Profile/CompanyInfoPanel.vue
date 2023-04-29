<template>
    <Panel class="panel-style" header="Uzņēmuma informācija"
           v-if="profileInfo && !isProfileInfoLoading">
        <template #icons>
            <button class="p-panel-header-icon p-link mr-2">
                <span class="pi pi-pencil text-xl" @click="router.push('/profils/uznemums/informacija')"></span>
            </button>
        </template>
        <ul class="profile-info-list"
            v-if="profileInfo && !isProfileInfoLoading">
            <li>
                <span>Uzņēmuma nosaukums </span>
                <h3>{{ profileInfo.company_name }}</h3>
            </li>
            <Divider/>
            <li>
                <span>Tālrunis </span>
                <h3>{{ profileInfo.phone }}</h3>
            </li>
            <Divider/>
            <li>
                <span>Atrašanās vieta </span>
                <h3>{{ profileInfo.location }}</h3>
            </li>
            <Divider/>
            <li>
                <span>Uzņēmuma informācija </span>
                <h3>{{ profileInfo.about }}</h3>
            </li>
            <Divider/>
            <li>
                <span>Uzņēmuma mājas lapa </span>
                <a class="text-xl hover:underline" target="_blank"
                   :href="profileInfo.website_url">{{ profileInfo.website_url }}
                </a>
            </li>
        </ul>
    </Panel>
    <div v-if="!profileInfo && !isProfileInfoLoading">
        <Message severity="info" :closable="false">Uzņemuma informācija vēl nav iestatita, to variet izdarīt
            <span class="font-bold cursor-pointer hover:underline"
                  @click="router.push('/profils/uznemums/informacija')">šeit</span>
        </Message>
    </div>
</template>
<script setup>
import Divider from "primevue/divider";
import Panel from "primevue/panel";
import {useEmployerStore} from "../../../../store/employer";
import router from "../../../../router";
import Message from "primevue/message";
import {computed} from "vue";

const employerStore = useEmployerStore()
const profileInfo = computed(() => employerStore.getEmployerProfileInfo)
const isProfileInfoLoading = computed(() => employerStore.isEmployerProfileLoading)

const props = defineProps({
    profileInfo: Object
})
</script>
