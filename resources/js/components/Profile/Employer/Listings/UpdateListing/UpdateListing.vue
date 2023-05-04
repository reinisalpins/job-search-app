<template>
    <div v-if="!loadingListing">
        <div v-if="selectedListing">
            <Panel :header="`Labot vakanci #${selectedListing.listing_id}`">
                <div v-if="!successUpdate">
                    <Message :closable="false" severity="info">* - obligātie lauki</Message>
                    <Divider/>
                    <ul>
                        <li>
                            <h1 class="text-2xl font-normal mb-3">Vakances virsraksts*</h1>
                            <InputText v-model="editJobTitle" placeholder="piem. PHP programmētājs"/>
                        </li>
                        <Divider/>
                        <li>
                            <h1 class="text-2xl font-normal mb-3">Atrašanās vieta*</h1>
                            <InputText v-model="editLocation" placeholder="piem. Liepāja vai attālināti"/>
                        </li>
                        <Divider/>
                        <li>
                            <h1 class="text-2xl font-normal mb-3">Vakances tips*</h1>
                            <SelectButton :unselectable="true" v-model="editType" :options="options"
                                          aria-labelledby="basic"/>
                        </li>
                        <Divider/>
                        <li>
                            <h1 class="text-2xl font-normal mb-3">Slodze*</h1>
                            <SelectButton :unselectable="true" v-model="editWorkload" :options="workloadOptions"
                                          aria-labelledby="basic"/>
                        </li>
                        <Divider/>
                        <li>
                            <h1 class="text-2xl font-normal mb-3">
                                Alga*
                                <span class="text-xl">
                                    (0, ja atalgojums netiek piedāvāts)
                                </span>
                            </h1>
                            <span class="p-input-icon-right">
                                <i class="pi pi-euro"/>
                                <InputText v-model="editSalaryRange" placeholder="piem. 1500-2000"/>
                            </span>
                        </li>
                        <Divider/>
                        <li>
                            <h1 class="text-2xl font-normal mb-3">Vakances apraksts*</h1>
                            <Editor v-model="editDescription" editorStyle="height: 320px"/>
                        </li>
                        <Divider/>
                        <li>
                            <ConfirmPopup></ConfirmPopup>
                            <Button label="Saglabāt izmaiņas" :loading="loadingUpdate"
                                    @click="confirmUpdateListing($event)"/>
                            <InlineMessage class="ml-4" v-if="errMessage" severity="error">{{
                                    errMessage
                                }}
                            </InlineMessage>
                        </li>
                    </ul>
                </div>
                <div v-if="successUpdate">
                    <Message :closable="false" severity="info">Vakance labota veiksmīgi, to variet apskatīt
                        <span class="hover:underline font-bold cursor-pointer"
                              @click="router.push(`/profils/vakances/${selectedListing.listing_id}`)">šeit</span>
                    </Message>
                </div>
            </Panel>
        </div>
        <div v-if="!selectedListing">
            <Message :closable="false" severity="error">Vakance ar šādu ID jums nepieder</Message>
        </div>
    </div>
    <div v-if="loadingListing">
        <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="7"/>
    </div>
</template>

<script setup>
import Panel from "primevue/panel";
import {computed, onMounted, ref, watch} from "vue";
import {useListingStore} from "../../../../../store/listings";
import {useProfileStore} from "../../../../../store/user";
import router from "../../../../../router";
import Message from "primevue/message";
import ProgressSpinner from "primevue/progressspinner";
import Button from "primevue/button";
import Editor from "primevue/editor";
import SelectButton from "primevue/selectbutton";
import InputText from "primevue/inputtext";
import Divider from "primevue/divider";
import formatHelper from "../../../../../helpers/format-helper";
import {useConfirm} from "primevue/useconfirm";
import ConfirmPopup from "primevue/confirmpopup";
import InlineMessage from "primevue/inlinemessage";

const editJobTitle = ref('');
const editLocation = ref('');
const editWorkload = ref('');
const editSalaryRange = ref('');
const editDescription = ref('');
const editType = ref('')

const workload = ref('Pilna laika');
const workloadOptions = ref(['Pilna laika', 'Nepilna laika']);

const options = ref(['Darba vakance', 'Prakse']);

const listingStore = useListingStore()
const userStore = useProfileStore()

const selectedListing = computed(() => listingStore.getSelectedListing)
const user = computed(() => userStore.getUser)
const selectedId = computed(() => router.currentRoute.value.params.id)
const loadingListing = computed(() => listingStore.listingLoading)
const confirm = useConfirm()
const successUpdate = ref(false)
const errMessage = ref('')
const loadingUpdate = computed(() => listingStore.updateLoading)

onMounted(() => {
    listingStore.fetchSelectedEmployerListing(user.value.id, selectedId.value)
})

watch(selectedListing, () => {
    if (selectedListing.value) {
        editJobTitle.value = selectedListing.value.title;
        editLocation.value = selectedListing.value.location;
        editType.value = selectedListing.value.listing_type === 1 ? 'Prakse' : 'Darba vakance';
        editWorkload.value = formatHelper.formatEmploymentType(selectedListing.value.related_listing.employment_type);
        editSalaryRange.value = selectedListing.value.related_listing.salary_range;
        editDescription.value = selectedListing.value.related_listing.description;
    }
});

const listingType = computed(() => editType.value === 'Darba vakance' ? 2 : 1)

const updateListing = async () => {
    if (validateFields()) {
        const workloadMapping = {
            'Pilna laika': 'full_time',
            'Nepilna laika': 'part_time'
        };

        const payload = {
            userId: user.value.id,
            listingType: listingType.value,
            title: editJobTitle.value,
            location: editLocation.value,
            employmentType: workloadMapping[editWorkload.value],
            salaryRange: editSalaryRange.value,
            description: editDescription.value,
        }

        let response
        response = await listingStore.updateListing(user.value.id, selectedId.value, payload)

        if (!response.success) {
            errMessage.value = response.errorMessage
        } else {
            errMessage.value = '';
            successUpdate.value = true;
        }
    }
}

const confirmUpdateListing = (event) => {
    confirm.require({
        target: event.currentTarget,
        message: 'Vai tiešām vēlaties labot šo vakanci?',
        icon: 'pi pi-info-circle',
        acceptClass: 'p-button-success',
        rejectLabel: 'Nē',
        acceptLabel: 'Jā',
        acceptIcon: 'pi pi-check',
        rejectIcon: 'pi pi-times',
        accept: () => {
            updateListing()
        },
        reject: () => {

        }
    });
};

const validateFields = () => {
    if (!editJobTitle.value || !editLocation.value || !editWorkload.value || !editSalaryRange.value || !editDescription.value) {
        errMessage.value = "Lūdzu, aizpildiet visus obligātos laukus.";
        return false;
    }

    if (!isValidSalaryRange(editSalaryRange.value)) {
        errMessage.value = "Lūdzu, ievadiet derīgu algu diapazonu (piemēram, 2000 vai 2000-2500 vai 0).";
        return false;
    }

    errMessage.value = "";
    return true;
}


const isValidSalaryRange = (range) => {
    const regex = /^(\d+)(-\d+)?$/;
    return regex.test(range);
}
</script>
