<template>
    <div class="text-center mb-5">
        <div class="text-900 text-3xl font-medium mb-3">Izveidot profilu</div>
        <span class="text-600 font-medium line-height-3">Jums jau ir profils?</span>
        <a class="font-medium no-underline ml-2 text-blue-500 cursor-pointer"
           @click="indexStore.makeRegisterInactive">Ielogojieties
            šeit</a>
    </div>
    <div class="profile-type flex gap-3 flex-row justify-content-center flex-wrap mt-2 mb-3">
        <Card :class="`w-15rem h-4rem ${selectedUserType === 'job_seeker' ? 'bg-blue-50' : ''} cursor-pointer`"
              @click="selectedUserType = 'job_seeker'">
            <template #subtitle>Esmu darba meklētājs</template>
        </Card>
        <Card :class="`w-15rem h-4rem ${selectedUserType === 'employer' ? 'bg-blue-50' : ''} cursor-pointer`"
              @click="selectedUserType = 'employer'">
            <template #subtitle>Esmu darba devējs</template>
        </Card>
    </div>

    <div>
        <label for="email1" class="block text-900 font-medium mb-2">E-Pasts</label>
        <InputText id="email1" v-model="email" type="text" class="w-full mb-3"/>

        <label for="password1" class="block text-900 font-medium mb-2">Parole</label>
        <InputText id="password1" v-model="password" type="password" class="w-full mb-3"/>

        <label for="password2" class="block text-900 font-medium mb-2">Parole atkārtoti</label>
        <InputText id="password2" v-model="passwordRepeat" type="password" class="w-full mb-3"/>

        <InlineMessage v-if="errMessage" severity="error">{{ errMessage }}</InlineMessage>

        <Button @click="handleSubmit" :loading="loading" label="Reģistrēties" icon="pi pi-user"
                class="w-full mt-3"></Button>
    </div>
</template>

<script setup>
import {ref} from 'vue';
import router from "../../router";
import Button from "primevue/button";
import InlineMessage from "primevue/inlinemessage";
import {useProfileStore} from "../../store/user";
import InputText from "primevue/inputtext";
import {useIndex} from "../../store/indexPinia";
import Card from "primevue/card";

const profileStore = useProfileStore();
const email = ref('');
const password = ref('');
const passwordRepeat = ref('');
const errMessage = ref('');
const loading = ref(false)
const indexStore = useIndex()
const selectedUserType = ref('job_seeker');

const handleSubmit = async () => {
    if (validateFields()) {
        const userData = {
            email: email.value,
            password: password.value,
            password_confirmation: passwordRepeat.value,
            user_type: selectedUserType.value
        };

        loading.value = true;
        const result = await profileStore.register(userData);

        if (result === true) {
            await router.push('/profils');
            indexStore.hideAuthDialog()
        } else {
            errMessage.value = result;
        }
        loading.value = false;
    }
}

const validateFields = () => {

    const emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

    if (!emailRegex.test(email.value.trim())) {
        errMessage.value = 'Pārbaudiet savu e-pasta adresi'
        return false;
    }

    if (password.value.trim().length < 6) {
        errMessage.value = 'Parolei jābūt garākai par 6 simboliem'
        return false;
    }

    if (password.value !== passwordRepeat.value) {
        errMessage.value = 'Paroles nesakrīt'
        return false;
    }

    if (selectedUserType.value !== 'job_seeker' && selectedUserType.value !== 'employer') {
        errMessage.value = 'Izvēlieties lietotāja veidu';
        return false;
    }


    errMessage.value = ''
    return true;
};


</script>
