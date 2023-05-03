<template>
    <Panel header="Visas publicētās vakances">
        <template #icons>
            <span class="p-input-icon-left">
                <i class="pi pi-search"/>
                <InputText v-model="searchVal" placeholder="Meklēt"/>
            </span>
        </template>
        <div v-if="loadingListings">
            <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="7"/>
        </div>
        <div v-else>
            <div v-if="listings">
                <ul>
                    <li v-for="(listing, index) in listings" :key="index">
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
import {useListingStore} from "../../../../store/listings";
import {useProfileStore} from "../../../../store/user";
import {computed, onMounted, ref} from "vue";
import ProgressSpinner from "primevue/progressspinner";
import Message from "primevue/message";
import MinimalListingCard from "./MinimalListingCard.vue";
import InputText from "primevue/inputtext";
import Paginator from "primevue/paginator";

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
</style>
