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
                    <input type="submit" class="submit-btn" value="Reģistrēties"/>
                    <div class="validation-container">
                        <div>
                            <span class="validation-err">{{ errMessage }}</span>
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
import {getUserData} from "../../api/axios";
import router from "../router";
import {useStore} from "vuex";

const store = useStore();
const firstName = ref('');
const lastName = ref('');
const phone = ref('');
const email = ref('');
const password = ref('');
const passwordRepeat = ref('');
const errMessage = ref('');

const handleSubmit = () => {
    if (validateFields()) {
        registerUser();
    }
};

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

const registerUser = async () => {
    try {
        const response = await axios.post('/api/register', {
            first_name: firstName.value,
            last_name: lastName.value,
            phone: phone.value,
            email: email.value,
            password: password.value,
            password_confirmation: passwordRepeat.value,
        });

        if (response.status === 200) {
            localStorage.setItem('auth_token', response.data.token);

            await getUserData()
            await router.push('/profils');
        }
    } catch (error) {
        errMessage.value = error.response.data.message;
    }
};

watchEffect(() => {
    const isLoggedIn = store.getters.isLoggedIn;
    const redirect = () => {
        if(isLoggedIn) {
            router.push('/profils');
        }
    }
    redirect()
});
</script>

<style lang="scss">
</style>
