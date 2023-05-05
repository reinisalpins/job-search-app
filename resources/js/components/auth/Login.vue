<template>
    <div class="text-center mb-5">
        <div class="text-900 text-3xl font-medium mb-3">Sveicināti atpakaļ</div>
        <span class="text-600 font-medium line-height-3">Nēesat reģistrēts?</span>
        <a class="font-medium no-underline ml-2 text-blue-500 cursor-pointer" @click="indexStore.makeRegisterActive">Izveidojiet
            profilu šeit</a>
    </div>

    <div>
        <label for="email1" class="block text-900 font-medium mb-2">E-Pasts</label>
        <InputText id="email1" v-model="email" type="text" class="w-full mb-3"/>

        <label for="password1" class="block text-900 font-medium mb-2">Parole</label>
        <InputText id="password1" v-model="password" type="password" class="w-full mb-3"/>

        <div class="flex align-items-center justify-content-between mb-3">
            <div class="flex align-items-center">
                <Checkbox id="rememberme1" :binary="true" v-model="checked" class="mr-2"></Checkbox>
                <label for="rememberme1">Atcerēties mani</label>
            </div>
            <a class="font-medium no-underline ml-2 text-blue-500 text-right cursor-pointer">Aizmirsāt paroli?</a>
        </div>
        <InlineMessage v-if="errMessage" severity="error">{{ errMessage }}</InlineMessage>

        <Button @click="submitLoginForm" :loading="loading" label="Ielogoties" icon="pi pi-user"
                class="w-full mt-3"></Button>
    </div>
</template>
<script setup>
import {ref} from 'vue';
import {useUserStore} from "../../store/user";
import {useRouter} from 'vue-router';
import Button from 'primevue/button';
import InlineMessage from 'primevue/inlinemessage';
import InputText from "primevue/inputtext";
import Checkbox from "primevue/checkbox";
import {useIndex} from "../../store";

const indexStore = useIndex()
const profileStore = useUserStore();
const router = useRouter();
const loading = ref(false);

const errMessage = ref('');
const email = ref('');
const password = ref('');
const selectedUserType = ref('jobSeeker');

const submitLoginForm = () => {
    if (selectedUserType.value === 'jobSeeker') {
        loginUser();
    } else if (selectedUserType.value === 'employer') {
        loginEmployer();
    }
};

const loginUser = async () => {
    loading.value = true;
    const success = await profileStore.login(email.value, password.value);

    if (!success) {
        errMessage.value = 'Nepareizs e-pasts vai/un parole';
    } else {
        indexStore.hideAuthDialog()
        email.value = ''
        password.value = ''
        errMessage.value = ''
    }

    loading.value = false;
};

const loginEmployer = async () => {
    loading.value = true
}

</script>
