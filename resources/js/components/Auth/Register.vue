<template>
    <div class="text-center mb-5">
        <div class="text-900 text-3xl font-medium mb-3">Izveidot profilu</div>
        <span class="text-600 font-medium line-height-3">Jums jau ir profils?</span>
        <a class="font-medium no-underline ml-2 text-blue-500 cursor-pointer"
           @click="indexStore.makeRegisterInactive">Ielogojieties
            šeit</a>
    </div>

    <div>
        <label for="email1" class="block text-900 font-medium mb-2">E-Pasts</label>
        <InputText id="email1" v-model="email" type="text" class="w-full mb-3"/>

        <label for="firstName" class="block text-900 font-medium mb-2">Vārds</label>
        <InputText id="firstName" v-model="firstName" type="text" class="w-full mb-3"/>

        <label for="lastName" class="block text-900 font-medium mb-2">Uzvārds</label>
        <InputText id="lastName" v-model="lastName" type="text" class="w-full mb-3"/>

        <label for="phone" class="block text-900 font-medium mb-2">Tālrunis</label>
        <InputText id="phone" v-model="phone" type="text" class="w-full mb-3"/>

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

const profileStore = useProfileStore();
const firstName = ref('');
const lastName = ref('');
const phone = ref('');
const email = ref('');
const password = ref('');
const passwordRepeat = ref('');
const errMessage = ref('');
const loading = ref(false)
const indexStore = useIndex()

const handleSubmit = async () => {
    if (validateFields()) {
        const userData = {
            first_name: firstName.value,
            last_name: lastName.value,
            phone: phone.value,
            email: email.value,
            password: password.value,
            password_confirmation: passwordRepeat.value,
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
    if (firstName.value.trim() === '') {
        errMessage.value = 'Ievadiet savu vārdu'
        return false;
    }

    if (lastName.value.trim() === '') {
        errMessage.value = 'Ievadiet savu uzvārdu'
        return false;
    }

    const phoneRegex = /^\+?[1-9]\d{1,14}$/;
    if (!phoneRegex.test(phone.value.trim())) {
        errMessage.value = 'Pārbaudiet savu tālruni'
        return false;
    }

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

    errMessage.value = ''
    return true;
};


</script>
