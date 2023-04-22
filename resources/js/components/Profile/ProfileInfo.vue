<template>
    <Panel class="panel-style" header="Profila informācija" v-if="userProfile">
        <template #icons>
            <button class="p-panel-header-icon p-link mr-2">
                <span class="pi pi-user-edit text-xl"></span>
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
                <span>Jūsu prasmes </span>
                <div class="flex gap-2">
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
    <div v-if="!userProfile">
        <Message severity="info" :closable="false">Profils vēl nav izveidots, to variet izveidot
            <span class="font-bold cursor-pointer hover:underline" @click="showModal">šeit</span>
        </Message>

<!--        <UserInfoModal :visible="showProfileModal" :is-profile-info-set="isUserProfileSet" :profile-info="userProfile"/>-->
    </div>
</template>
<script setup>
import Panel from "primevue/panel";
import Divider from "primevue/divider";
import {computed, onMounted, ref} from "vue";
import {useProfileStore} from "../../store/user";
import Message from "primevue/message";
import UserInfoModal from "./UserInfoModal.vue";
import Chip from "primevue/chip";

const showProfileModal = ref(false)

const showModal = () => {
    showProfileModal.value = true
}

const profileStore = useProfileStore()

const props = defineProps({
    user: Object
})

const userProfile = computed(() => profileStore.getProfileInfo)
const isUserProfileSet = computed(() => userProfile.value !== null)

onMounted(() => {
    if ( !profileStore.getProfileInfo ) {
        profileStore.fetchUserProfile(props.user.id)
    }
})

</script>
<style lang="scss">
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
