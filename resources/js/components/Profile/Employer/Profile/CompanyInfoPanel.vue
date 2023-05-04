<template>
    <Panel class="panel-style" header="Uzņēmuma informācija"
           v-if="profileInfo && !isProfileInfoLoading">
        <template #icons>
            <button class="p-panel-header-icon p-link mr-2">
                <span class="pi pi-pencil text-xl" @click="router.push('/profils/uznemums/informacija')"></span>
            </button>
        </template>
        <ul>
            <li>
                <h1 class="text-2xl font-normal mb-2">Uzņēmuma nosaukums</h1>
                <p class="text-xl font-bold">{{ profileInfo.company_name }}</p>
            </li>
            <Divider/>
            <li>
                <h1 class="text-2xl font-normal mb-2">Tālrunis</h1>
                <p class="text-xl font-bold">{{ profileInfo.phone }}</p>
            </li>
            <Divider/>
            <li>
                <h1 class="text-2xl font-normal mb-2">Atrašanās vieta</h1>
                <p class="text-xl font-bold">{{ profileInfo.location }}</p>
            </li>
            <Divider/>
            <li>
                <h1 class="text-2xl font-normal mb-2">Uzņēmuma informācija</h1>
                <p class="text-xl font-bold">{{ profileInfo.about }}</p>
            </li>
            <Divider/>
            <li>
                <h1 class="text-2xl font-normal mb-2">Uzņēmuma mājas lapa</h1>
                <p>
                    <a class="text-xl font-bold hover:underline" target="_blank"
                       :href="profileInfo.website_url">{{ profileInfo.website_url }}
                    </a>
                </p>
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
