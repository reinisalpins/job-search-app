<template>
    <Panel header="Visas publicētās vakances">
        <template #icons>
            <router-link to="/profils/vakances/pievienot">
                <button class="p-panel-header-icon p-link mr-2">
                    <span class="pi pi-plus-circle text-2xl text-black-alpha-90"></span>
                </button>
            </router-link>
            <span class="p-input-icon-left">
                <i class="pi pi-search"/>
                <InputText v-model="searchVal" placeholder="Meklēt"/>
            </span>
        </template>
        <div v-if="loadingListings">
            <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="7"/>
        </div>
        <div v-else>
            <div v-if="listings && listings.length > 0">
                <ul>
                    <li v-for="(listing, index) in listings" :key="index"
                        @click="router.push(`/profils/vakances/${listing.listing_id}`)">
                        <MinimalListingCard :listing-info="listing"/>
                    </li>
                </ul>
            </div>
            <div v-else>
                <Message :closable="false" severity="info">Vēl neviena vakance nav pievienota</Message>
            </div>
        </div>
    </Panel>
</template>
<script setup>
import Panel from "primevue/panel";
import {useListingStore} from "../../../../../store/listings";
import {useProfileStore} from "../../../../../store/user";
import {computed, onMounted, ref} from "vue";
import ProgressSpinner from "primevue/progressspinner";
import Message from "primevue/message";
import MinimalListingCard from "../MinimalListingCard.vue";
import InputText from "primevue/inputtext";
import router from "../../../../../router";

const listingStore = useListingStore()
const userStore = useProfileStore()

const user = computed(() => userStore.getUser)
const loadingListings = computed(() => listingStore.listingsLoading)
const listings = computed(() => listingStore.getAllEmployersListings)

const searchVal = ref();

onMounted(() => {
    if (!listings.value) {
        listingStore.fetchAllEmployerListings(user.value.id)
    }
})
</script>
<style lang="scss">
.p-panel .p-panel-header {
    flex-wrap: wrap !important;
    gap: 15px !important;
}

.p-panel-icons {
    display: flex !important;
    flex-wrap: wrap !important;
    align-items: center !important;
    gap: 15px;
}
</style>
