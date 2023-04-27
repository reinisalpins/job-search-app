<template>
    <Panel class="panel-style" header="Profila informācija" v-if="userProfile && !createEditUserProfile">
        <template #icons>
            <button class="p-panel-header-icon p-link mr-2">
                <span class="pi pi-user-edit text-xl" @click="createEditUserProfile = true"></span>
            </button>
        </template>
        <ul class="profile-info-list">
            <li>
                <span>Jūsu vārds </span>
                <h3>{{ user.first_name }} {{ user.last_name }}</h3>
            </li>
            <Divider/>
            <li>
                <span>Jūsu izglītība </span>
                <h3>{{ userProfile.education }}</h3>
            </li>
            <Divider/>
            <li>
                <span>Jūsu atrašanās vieta </span>
                <h3>{{ userProfile.location }}</h3>
            </li>
            <Divider/>
            <li>
                <span>Jūsu prasmes </span>
                <div class="flex gap-2 flex-wrap">
                    <span v-for="skill in userProfile.skills">
                    <Chip :label="skill"/>
                </span>
                </div>
            </li>
            <Divider/>
            <li>
                <span>Jūsu pieredze </span>
                <h3>{{ userProfile.experience }}</h3>
            </li>
            <Divider/>
            <li>
                <span>Valodas </span>
                <h3><span v-for="language in userProfile.languages">
                    {{ language }},
                </span></h3>
            </li>
        </ul>
    </Panel>
    <div v-if="!userProfile && !createEditUserProfile">
        <Message severity="info" :closable="false">Profila informācija vēl nav izveidota, to variet izveidot
            <span class="font-bold cursor-pointer hover:underline" @click="createEditUserProfile = true">šeit</span>
        </Message>
    </div>

</template>
<script setup>
import Panel from "primevue/panel";
import Divider from "primevue/divider";
import {computed, onBeforeMount, onMounted, ref, watch} from "vue";
import {useProfileStore} from "../../../store/user";
import Message from "primevue/message";
import Chip from "primevue/chip";

const createEditUserProfile = ref(false)

const profileStore = useProfileStore()

const props = defineProps({
    user: Object
})

const closeEditProfile = () => {
    createEditUserProfile.value = false;
}

const userProfile = computed(() => profileStore.getProfileInfo)
const isUserProfileSet = computed(() => userProfile.value !== null)

onMounted(() => {
    profileStore.fetchUserProfile(props.user.id)
})

</script>
<style lang="scss">
</style>
