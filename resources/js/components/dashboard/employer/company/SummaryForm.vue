<template>
    <div v-if="!success">
        <div v-if="!loading">
            <div class="shadow-2 bg-gray-300 border-round p-3">
                <div
                    class="font-medium text-3xl text-900 mb-3 flex align-items-center gap-2 justify-content-between flex-wrap">
                    <div>Uzņēmuma pamatinformācija</div>
                </div>
                <div class="text-600 mb-3">Neliela informācija par jūsu uzņēmumu, ko lietotāji varēs redzēt pie jūsu
                    publicētajiem sludinājumiem
                </div>
                    <Message class="mb-3 shadow-1" :closable="false" severity="info">Ar * apzīmēti obligātie lauki</Message>
                <ul class="list-none p-0 m-0">
                    <li class="flex align-items-center py-3 gap-2 px-2 flex-wrap">
                        <div class="text-600 w-6 md:w-2 font-medium">Uzņēmuma nosaukums*</div>
                        <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">
                            <InputText v-model="companyName" placeholder="piem. KarjeraIT" class="shadow-1"/>
                        </div>
                    </li>
                    <li class="flex align-items-center py-3 gap-2 px-2 flex-wrap">
                        <div class="text-600 w-6 md:w-2 font-medium">Tālrunis</div>
                        <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">
                            <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">
                                <InputText v-model="phone" placeholder="piem. 22345678" class="shadow-1"/>
                            </div>
                        </div>
                    </li>
                    <li class="flex align-items-center py-3 gap-2 px-2 flex-wrap">
                        <div class="text-600 w-6 md:w-2 font-medium">Atrašanās vieta</div>
                        <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">
                            <InputText v-model="location" placeholder="piem. Liepāja" class="shadow-1"/>
                        </div>
                    </li>
                    <li class="flex align-items-center py-3 gap-2 px-2 flex-wrap">
                        <div class="text-600 w-6 md:w-2 font-medium">Mājas lapa</div>
                        <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">
                            <InputText v-model="website" placeholder="piem. http://www.karjerait.lv/" class="shadow-1"/>
                        </div>
                    </li>
                    <li class="flex py-3 gap-2 px-2 flex-wrap last">
                        <div class="text-600 w-6 md:w-2 font-medium">Apraksts par uzņēmumu</div>
                        <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">
                            <Editor v-model="description" editorStyle="height: 320px" class="shadow-1"/>
                        </div>
                    </li>
                </ul>
                <div class="flex gap-3 flex-wrap align-items-center">
                    <Button @click="submitForm" :loading="formLoading" class="mt-4" type="submit" label="Saglabāt"/>
                    <InlineMessage class="mt-4" severity="error" v-if="errMessage">{{ errMessage }}</InlineMessage>
                </div>
            </div>
        </div>
        <div v-if="loading">
            <i class="pi pi-spin pi-spinner text-4xl"></i>
        </div>
    </div>
    <div v-if="success">
        <Message :closable="false" class="shadow-1" severity="success">Uzņēmuma informācija saglabāta veiksmīgi, to variet apskatīt
            <router-link to="/vadibas-panelis" class="hover:underline font-bold">šeit</router-link>
        </Message>
    </div>
</template>
<script setup>
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import Editor from 'primevue/editor';
import {computed, ref, watch} from "vue";
import {useEmployerStore} from "../../../../store/employer";
import {useUserStore} from "../../../../store/user";
import InlineMessage from "primevue/inlinemessage";
import Message from "primevue/message";

const employerPinia = useEmployerStore()
const userPinia = useUserStore()
const errMessage = ref('')
const success = ref(false)

const companyName = ref('');
const phone = ref('');
const email = ref('');
const location = ref('');
const website = ref('');
const description = ref('');

const companyInfo = computed(() => employerPinia.getEmployerProfileInfo)
const loading = computed(() => employerPinia.isLoading)
const formLoading = computed(() => employerPinia.isFormLoading)
const user = computed(() => userPinia.getUser)

watch(companyInfo, (newValue, oldValue) => {
    companyName.value = newValue?.company_name
    phone.value = newValue?.phone
    description.value = newValue?.about
    location.value = newValue?.location
    website.value = newValue?.website_url
});

companyName.value = companyInfo.value?.company_name
phone.value = companyInfo.value?.phone
description.value = companyInfo.value?.about
location.value = companyInfo.value?.location
website.value = companyInfo.value?.website_url


const submitForm = async () => {
    loading.value = true
    if (!companyName.value || companyName.value.trim() === '') {
        errMessage.value = 'Kompānijas nosaukums nevar būt tukšs.';
        loading.value = false
        return;
    }
    const payload = {
        user_id: user.value.id,
        company_name: companyName.value,
        phone: phone.value,
        location: location.value,
        about: description.value,
        website_url: website.value,
    };

    let response;
    if (companyInfo.value) {
        response = await employerPinia.updateEmployerProfile(user.value.id, payload);
    } else {
        response = await employerPinia.setEmployerProfile(user.value.id, payload);
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
<style scoped lang="scss">
li {
    border-top: 1px solid #cacaca;
}

input {
    background: #f5f5f5;
}

.last {
    border-bottom: 1px solid #cacaca;
}
</style>
