<template>
    <Panel class="panel-style" header="Labot/Iestatīt uznēmuma informāciju" v-if="!success && !isProfileInfoLoading">
        <template #icons>
            <button class="p-panel-header-icon p-link mr-2">
                <span class="pi pi-times-circle text-xl" @click="router.push('/profils/uznemums')"></span>
            </button>
        </template>
        <ul>
            <li>
                <h1 class="text-2xl font-normal mb-2">Uzņēmuma nosaukums</h1>
                <InputText v-model="companyName" class="inputfield"/>
            </li>
            <Divider/>
            <li>
                <h1 class="text-2xl font-normal mb-2">Tālrunis</h1>
                <InputText v-model="phone" class="inputfield"/>
            </li>
            <Divider/>
            <li>
                <h1 class="text-2xl font-normal mb-2">Atrašanās vieta</h1>
                <InputText v-model="location" class="inputfield"/>
            </li>
            <Divider/>
            <li>
                <h1 class="text-2xl font-normal mb-2">Uzņēmuma informācija (īss apraksts par uzņēmumu, nodarbošanās,
                    utt.)</h1>
                <Textarea v-model="about" class="textarea"/>
            </li>
            <Divider/>
            <li>
                <h1 class="text-2xl font-normal mb-2">Uzņēmuma mājas lapa</h1>
                <InputText v-model="website" class="inputfield"/>
            </li>
            <Divider/>
            <li>
                <div class="flex gap-3 flex-wrap align-items-center">
                    <Button :loading="loading" @click="submitForm" class="save-btn" label="Saglabāt"/>
                    <InlineMessage severity="error" v-if="errMessage">{{ errMessage }}</InlineMessage>
                </div>
            </li>
        </ul>
    </Panel>
    <div v-if="success">
        <Message :closable="false" severity="success">Informācija saglabāta veiksmigi, to variet apskatīt <span
            class="hover:underline font-bold cursor-pointer" @click="router.push('/profils/uznemums')">šeit</span>
        </Message>
    </div>

</template>
<script setup>
import Panel from "primevue/panel";
import Divider from "primevue/divider";
import InputText from "primevue/inputtext";
import Textarea from "primevue/textarea";
import Button from "primevue/button";
import {computed, ref, watch} from "vue";
import InlineMessage from "primevue/inlinemessage";
import {useEmployerStore} from "../../../../store/employer";
import {useProfileStore} from "../../../../store/user";
import Message from "primevue/message";
import router from "../../../../router";

const employerStore = useEmployerStore()
const userStore = useProfileStore()
const companyName = ref('')
const phone = ref('')
const about = ref('')
const location = ref('')
const website = ref('')
const errMessage = ref('')
const user = computed(() => userStore.getUser)
const loading = ref(false)
const success = ref(false)
const isProfileInfoLoading = computed(() => employerStore.isEmployerProfileLoading)
const companyInfo = computed(() => employerStore.getEmployerProfileInfo)

watch(companyInfo, (newValue, oldValue) => {
    companyName.value = newValue?.company_name
    phone.value = newValue?.phone
    about.value = newValue?.about
    location.value = newValue?.location
    website.value = newValue?.website_url
});

companyName.value = companyInfo.value?.company_name
phone.value = companyInfo.value?.phone
about.value = companyInfo.value?.about
location.value = companyInfo.value?.location
website.value = companyInfo.value?.website_url

const submitForm = async () => {
    loading.value = true
    if (companyName.value.trim() === '') {
        errMessage.value = 'Kompānijas nosaukums nevar būt tukšs.';
        loading.value = false
        return;
    }

    const payload = {
        user_id: user.value.id,
        company_name: companyName.value,
        phone: phone.value,
        location: location.value,
        about: about.value,
        website_url: website.value,
    };

    let response;
    if (companyInfo.value) {
        response = await employerStore.updateEmployerProfile(user.value.id, payload);
    } else {
        response = await employerStore.setEmployerProfile(user.value.id, payload);
    }

    if (!response.success) {
        errMessage.value = response.errorMessage;
    } else {
        errMessage.value = '';
        success.value = true;
    }

    loading.value = false;
};
</script>
<style lang="scss">

.textarea {
    max-width: 500px;
    min-width: 150px;
    min-height: 150px;
    max-height: 500px;
    width: 100%;
}

.save-btn {
    max-width: 150px;
}
</style>
