<template>
    <div v-if="!loadingListing">
        <div v-if="selectedListing">
            <Panel :header="`Vakance #${selectedListing.listing_id}`" v-if="!successDelete">
                <template #icons>
                    <ConfirmPopup></ConfirmPopup>
                    <button class="p-panel-header-icon p-link mr-2">
                        <span class="pi pi-file-edit text-xl"
                              @click="router.push(`/profils/vakances/${selectedListing.listing_id}/labot`)"></span>
                    </button>
                    <button class="p-panel-header-icon p-link mr-2">
                        <span class="pi pi-trash text-xl text-red-500" @click="confirmDeleteListing($event)"></span>
                    </button>
                </template>
                <ul>
                    <li>
                        <h1 class="text-2xl font-normal mb-2">Vakances virsraksts</h1>
                        <Chip class="font-bold" :label="selectedListing.title"/>
                    </li>
                    <Divider/>
                    <li>
                        <h1 class="text-2xl font-normal mb-2">Atrašanās vieta</h1>
                        <Chip class="font-bold" :label="selectedListing.location"/>
                    </li>
                    <Divider/>
                    <li>
                        <h1 class="text-2xl font-normal mb-2">Vakances veids</h1>
                        <Chip class="font-bold" :label="formatHelper.formatListingType(selectedListing.listing_type)"/>
                    </li>
                    <Divider/>
                    <li>
                        <h1 class="text-2xl font-normal mb-2">Slodze</h1>
                        <Chip class="font-bold"
                              :label="formatHelper.formatEmploymentType(selectedListing.related_listing.employment_type)"/>
                    </li>
                    <Divider/>
                    <li>
                        <h1 class="text-2xl font-normal mb-2">Algas diapazons</h1>
                        <Chip class="font-bold" :label="`${selectedListing.related_listing.salary_range} $`"/>
                    </li>
                    <Divider/>
                    <li>
                        <h1 class="text-2xl font-normal mb-3">Apraksts</h1>
                        <p class="border-1 p-3 border-gray-400 border-round ql-editor"
                           v-html="selectedListing.related_listing.description"></p>
                    </li>
                    <Divider/>
                    <li>
                        <h1 class="text-2xl font-normal mb-2">Pievienots</h1>
                        <Chip class="font-bold" :label=" formatHelper.formatDatePosted(selectedListing.date_posted)"/>
                    </li>
                </ul>
            </Panel>
            <Message :closable="false" severity="success" v-if="successDelete">Vakance dzēsta veiksmīgi, spiediet
                <router-link style="text-decoration: none; color: inherit" class="hover:underline font-bold"
                             to="/profils/vakances">šeit
                </router-link>
                lai atgrieztos pie visām vakancēm
            </Message>
        </div>
        <div v-else>
            <Message :closable="false" severity="error">Vakance ar šādu ID jums nepieder</Message>
        </div>
    </div>
    <div v-if="loadingListing">
        <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="7"/>
    </div>
</template>

<script setup>
import Panel from "primevue/panel";
import {computed, onMounted, ref} from "vue";
import {useListingStore} from "../../../../store/listings";
import router from "../../../../router";
import ProgressSpinner from "primevue/progressspinner";
import Message from "primevue/message";
import {useProfileStore} from "../../../../store/user";
import Divider from "primevue/divider";
import formatHelper from "../../../../helpers/format-helper";
import ConfirmPopup from "primevue/confirmpopup";
import {useConfirm} from "primevue/useconfirm";
import Chip from "primevue/chip";

const listingStore = useListingStore()
const userStore = useProfileStore()
const confirm = useConfirm()
const successDelete = ref(false)

const selectedId = computed(() => router.currentRoute.value.params.id)
const selectedListing = computed(() => listingStore.getSelectedListing)
const loadingListing = computed(() => listingStore.listingLoading)
const user = computed(() => userStore.getUser)

onMounted(() => {
    listingStore.fetchSelectedEmployerListing(user.value.id, selectedId.value)
})

const confirmDeleteListing = (event) => {
    confirm.require({
        target: event.currentTarget,
        message: 'Vai tiešām vēlaties izdzēst šo vakanci?',
        icon: 'pi pi-info-circle',
        acceptClass: 'p-button-danger',
        rejectLabel: 'Nē',
        acceptLabel: 'Jā',
        acceptIcon: 'pi pi-check',
        rejectIcon: 'pi pi-times',
        accept: () => {
            deleteListing()
        },
        reject: () => {

        }
    });
};

const deleteListing = async () => {
    const response = await listingStore.deleteListing(user.value.id, selectedId.value)
    if (response.success) {
        successDelete.value = true
    }
}
</script>

<style scoped lang="scss">
</style>
