<template>
    <Panel header="Pievienot jaunu vakanci">
        <template #icons>
            <router-link to="/profils/vakances">
                <button class="p-panel-header-icon p-link mr-2">
                    <span class="pi pi-times-circle text-xl"></span>
                </button>
            </router-link>
        </template>
        <div v-if="!listingSuccess">
            <div v-if="employerProfile">
                <Message :closable="false" severity="info">* - obligātie lauki</Message>
                <Divider/>
                <CreateListingForm :user="user" @post-success="listingSuccess = $event"/>
            </div>
            <div v-if="!employerProfile && !employerProfileLoading">
                <Message :closable="false" severity="warn">Lai pievienotu vakanci, sākumā jāiestata darba devēja profila
                    informācija, to variet izdarit <span
                        class="hover:underline font-bold cursor-pointer"
                        @click="router.push(`/profils/uznemums/informacija`)">šeit</span>
                </Message>
            </div>
            <div v-if="employerProfileLoading">
                <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="7"/>
            </div>
        </div>
        <div v-if="listingSuccess">
            <Message
                v-if="listingSuccess"
                :closable="false"
                severity="success"
            >
                Vakance saglabāta veiksmīgi, to variet apskatīt <span
                class="hover:underline font-bold cursor-pointer"
                @click="router.push(`/profils/vakances/${postedListing.listing_id}`)"
            >šeit</span>
            </Message>
        </div>
    </Panel>
</template>

<script setup>
import Panel from "primevue/panel";
import Divider from "primevue/divider";
import {computed, onMounted, ref} from "vue";
import CreateListingForm from "./CreateListingForm.vue";
import Message from "primevue/message";
import {useProfileStore} from "../../../../../store/user";
import {useEmployerStore} from "../../../../../store/employer";
import router from "../../../../../router";
import {useListingStore} from "../../../../../store/listings";
import ProgressSpinner from "primevue/progressspinner";

const profileStore = useProfileStore()
const user = computed(() => profileStore.getUser)
const employerStore = useEmployerStore()
const employerProfile = computed(() => employerStore.getEmployerProfileInfo)
const employerProfileLoading = computed(() => employerStore.isEmployerProfileLoading)
const listingSuccess = ref(false);
const listingStore = useListingStore()
const postedListing = computed(() => listingStore.getSelectedListing)

onMounted(() => {
    if (!employerProfile.value) {
        employerStore.fetchEmployerProfile(user.value.id)
    }
})
</script>

<style lang="scss"></style>
