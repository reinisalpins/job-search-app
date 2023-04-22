<template>
    <div class="auth-container">
        <div class="auth-form-container">
            <div class="text-container">
                <h1>Reģistrēties</h1>
            </div>
            <div class="form-container">
                <form @submit.prevent="handleSubmit">
                    <input v-model="firstName" type="text" placeholder="Tavs vārds"/>
                    <input v-model="lastName" type="text" placeholder="Tavs uzvārds"/>
                    <input v-model="phone" type="text" placeholder="Tavs tālrunis"/>
                    <input v-model="email" type="email" placeholder="Tavs e-pasts"/>
                    <input v-model="password" type="password" placeholder="Tava parole"/>
                    <input v-model="passwordRepeat" type="password" placeholder="Parole atkārtoti"/>
                    <Button class="submit-btn" :loading="loading" type="submit" label="Reģistrēties"/>
                    <div class="validation-container">
                        <div>
                            <InlineMessage severity="error" v-if="errMessage">{{ errMessage }}</InlineMessage>
                        </div>
                        <router-link to="/ielogoties">Ielogoties</router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import {ref, watchEffect} from 'vue';
import router from "../router";
import Button from "primevue/button";
import InlineMessage from "primevue/inlinemessage";
import {useProfileStore} from "../store/user";

const profileStore = useProfileStore();
const firstName = ref('');
const lastName = ref('');
const phone = ref('');
const email = ref('');
const password = ref('');
const passwordRepeat = ref('');
const errMessage = ref('');
const loading = ref(false)

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

watchEffect(() => {
    const isLoggedIn = profileStore.isLoggedIn;
    const redirect = () => {
        if (isLoggedIn) {
            router.push('/profils');
        }
    }
    redirect()
});
</script>

<style lang="scss">
</style>
