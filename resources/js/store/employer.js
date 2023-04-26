import {defineStore} from "pinia";
import axios from "axios";

export const useEmployerStore = defineStore('employers', {
    state: () => ({

    }),

    getters: {

    },

    actions: {
        async login(email, password) {
            try {
                await axios.get('/sanctum/csrf-cookie');
                const response = await axios.post('/api/employer/login', {
                    email: email,
                    password: password,
                });

                localStorage.setItem('employer_auth_token', response.data.token);
                // await this.
                return true
            } catch (error) {
                return false;
            }
        },
    }
})
