import {defineStore} from 'pinia';
import authAxios from "../api/axiosConfig";
import axios from "axios";

export const useUserStore = defineStore({
    id: 'userStore',

    state: () => ({
        user: null,
        isLoading: false,
    }),

    getters: {
        getUser: (state) => state.user,
        getIsLoggedIn: (state) => !!state.user,
    },

    actions: {
        setUser(user) {
            this.user = user;
        },

        async fetchUser() {
            const authToken = localStorage.getItem('auth_token');

            if (authToken) {
                authAxios.defaults.headers.common['Authorization'] = `Bearer ${authToken}`;
            } else {
                return;
            }

            try {
                const response = await authAxios.get('/api/user');
                const userData = response.data;
                await this.setUser(userData);
            } catch (error) {
                console.error('Error getting user data:', error.message);
            }
        },

        async login(email, password) {
            try {
                await axios.get('/sanctum/csrf-cookie');
                const response = await axios.post('/api/login', {
                    email: email,
                    password: password,
                });

                localStorage.setItem('auth_token', response.data.token);
                await this.fetchUser();
                return true;
            } catch (error) {
                console.error('Error logging in:', error.message);
                return false;
            }
        },

        async register(userData) {
            try {
                const response = await axios.post('/api/register', userData);

                if (response.status === 200) {
                    localStorage.setItem('auth_token', response.data.token);

                    await this.fetchUser();
                    return true;
                }
            } catch (error) {
                return error.response.data.message;
            }
        },

        async logout() {
            this.isLoading = true;
            try {
                await authAxios.post('/api/logout');
                localStorage.removeItem('auth_token');
                this.user = null;
            } catch (error) {
                console.error('Error logging out:', error.message);
            }
            this.isLoading = false;
        },
    },
});
