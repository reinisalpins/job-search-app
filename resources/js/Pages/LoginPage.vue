<template>
    <div class="auth-container">
        <div class="auth-form-container">
            <div class="text-container">
                <h1>Sveicināti atpakaļ</h1>
            </div>
            <div class="form-container">
                <form @submit.prevent="login">
                    <input type="email" v-model="email" placeholder="Tavs e-pasts" />
                    <input type="password" v-model="password" placeholder="Tava parole" />
                    <Button class="submit-btn" :loading="loading" type="submit" label="Ielogoties"/>
                    <div class="validation-container">
                        <div>
                            <InlineMessage severity="error" v-if="errMessage">{{ errMessage }}</InlineMessage>
                        </div>
                        <router-link to="/registreties">Reģistrēties</router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import {ref, watchEffect} from 'vue';
import {useProfileStore} from '../store/user';
import {useRouter} from 'vue-router';
import Button from 'primevue/button';
import InlineMessage from 'primevue/inlinemessage';

const profileStore = useProfileStore();
const router = useRouter();
const loading = ref(false);

const errMessage = ref('');
const email = ref('');
const password = ref('');

const login = async () => {
    loading.value = true;
    const success = await profileStore.login(email.value, password.value);

    if (success) {
        await router.push('/profils');
    } else {
        errMessage.value = 'Nepareizs e-pasts vai/un parole';
    }
    loading.value = false;
};

watchEffect(() => {
    const isLoggedIn = profileStore.getIsLoggedIn;
    const redirect = () => {
        if (isLoggedIn) {
            router.push('/profils');
        }
    };
    redirect();
});
</script>


<style lang="scss">


</style>
