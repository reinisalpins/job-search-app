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
                    <input type="submit" class="submit-btn" value="Ielogoties" />
                    <div class="validation-container">
                        <div>
                            <span class="validation-err">{{ errMessage }}</span>
                        </div>
                        <router-link to="/registreties">Reģistrēties</router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import {getUserData} from "../../api/axios";

const store = useStore();
const router = useRouter();

const errMessage = ref('');
const email = ref('');
const password = ref('');

const login = async () => {
    try {
        await axios.get('/sanctum/csrf-cookie');
        const response = await axios.post('/api/login', {
            email: email.value,
            password: password.value,
        });

        localStorage.setItem('auth_token', response.data.token);

        // await store.dispatch('setUser', response.data.user);

        await getUserData()
        await router.push('/profils');
    } catch (error) {
        errMessage.value = 'Invalid email or password';
    }
};
</script>

<style lang="scss">


</style>
