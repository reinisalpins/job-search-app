<template>
    <ul>
        <li>
            <h1 class="text-2xl font-normal mb-3">Vakances virsraksts*</h1>
            <InputText v-model="jobTitle" placeholder="piem. PHP programmētājs"/>
        </li>
        <Divider/>
        <li>
            <h1 class="text-2xl font-normal mb-3">Atrašanās vieta*</h1>
            <InputText v-model="location" placeholder="piem. Liepāja vai attālināti"/>
        </li>
        <Divider/>
        <li>
            <h1 class="text-2xl font-normal mb-3">Vakances tips*</h1>
            <SelectButton :unselectable="true" v-model="value" :options="options" aria-labelledby="basic"/>
        </li>
        <Divider/>
        <li>
            <h1 class="text-2xl font-normal mb-3">Slodze*</h1>
            <SelectButton
                :unselectable="true"
                v-model="workload"
                :options="workloadOptions"
                aria-labelledby="basic"
            />
        </li>
        <Divider/>
        <li>
            <h1 class="text-2xl font-normal mb-3">Alga* <span class="text-xl">(0, ja atalgojums netiek piedāvāts)</span>
            </h1>
            <span class="p-input-icon-right">
                <i class="pi pi-euro"/>
                <InputText v-model="salaryRange" placeholder="piem. 1500-2000"/>
            </span>
        </li>
        <Divider/>
        <li>
            <h1 class="text-2xl font-normal mb-3">Vakances apraksts*</h1>
            <Editor v-model="description" editorStyle="height: 320px"/>
        </li>
        <Divider/>
    </ul>
    <Button label="Saglabāt" :loading="loading" @click="submitJobListing"/>

    <InlineMessage class="ml-4" v-if="errMessage" severity="error">{{ errMessage }}</InlineMessage>
</template>

<script setup>
import InputText from "primevue/inputtext";
import SelectButton from "primevue/selectbutton";
import {computed, ref} from "vue";
import Divider from "primevue/divider";
import Editor from "primevue/editor";
import Button from "primevue/button";
import InlineMessage from "primevue/inlinemessage";
import {useListingStore} from "../../../../../store/listings";

const listingStore = useListingStore()
const jobTitle = ref('');
const location = ref('');
const workload = ref('Pilna laika');
const workloadOptions = ref(['Pilna laika', 'Nepilna laika']);
const salaryRange = ref('');
const description = ref('');
const errMessage = ref('')
const success = ref(false)
const loading = computed(() => listingStore.listingLoading)
const emit = defineEmits(['post-success'])
const value = ref('Darba vakance');
const options = ref(['Darba vakance', 'Prakse']);

const props = defineProps({
    formData: Object,
    user: Object
})

const listingType = computed(() => (value.value === 'Darba vakance' ? 2 : 1));

const submitJobListing = async () => {
    if (validateFields()) {
        const workloadMapping = {
            'Pilna laika': 'full_time',
            'Nepilna laika': 'part_time'
        };

        const payload = {
            userId: props.user.id,
            listingType: listingType.value,
            title: jobTitle.value,
            location: location.value,
            employmentType: workloadMapping[workload.value],
            salaryRange: salaryRange.value,
            description: description.value
        };

        let response
        response = await listingStore.postJobListing(props.user.id, payload)

        if (!response.success) {
            errMessage.value = response.errorMessage
        } else {
            errMessage.value = '';
            success.value = true;
            emit('post-success', success.value)
        }
    }
}

const validateFields = () => {
    if (!jobTitle.value || !location.value || !workload.value || !salaryRange.value || !description.value) {
        errMessage.value = "Lūdzu, aizpildiet visus obligātos laukus.";
        return false;
    }

    if (!isValidSalaryRange(salaryRange.value)) {
        errMessage.value = "Lūdzu, ievadiet derīgu algu diapazonu (piemēram, 2000 vai 2000-2500).";
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

<style lang="scss">
</style>

<style lang="scss">
</style>
