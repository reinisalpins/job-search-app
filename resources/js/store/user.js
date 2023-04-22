import {defineStore} from 'pinia';
import axios from 'axios';

const authAxios = axios.create({
    baseURL: '/api',
});

export const useProfileStore = defineStore({
    id: 'profile',

    state: () => ({
        user: null,
        isUserLoaded: false,
        loadingProfileInfo: false,
        profileInfo: null,
    }),

    getters: {
        getUser: (state) => state.user,
        getIsLoggedIn: (state) => !!state.user,
        getIsUserLoaded: (state) => state.isUserLoaded,
        getIsLoadingProfileInfo: (state) => state.loadingProfileInfo,
        getProfileInfo: (state) => state.profileInfo,
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
                const response = await authAxios.get('/user');
                const userData = response.data;
                await this.setUser(userData)
                this.isProfileInfoLoaded = true
            } catch (error) {
                console.error('Error getting user data:', error);
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
            const authToken = localStorage.getItem('auth_token');

            if (authToken) {
                authAxios.defaults.headers.common['Authorization'] = `Bearer ${authToken}`;
            } else {
                return;
            }

            try {
                await authAxios.post('/logout');
                localStorage.removeItem('auth_token');
                this.user = null
            } catch (error) {
                console.error('Error logging out:', error);
            }
        },

        async fetchUserProfile(userId) {
            try {
                const response = await axios.get(`/api/userProfile/${userId}`);
                this.profileInfo = response.data.data
            } catch (error) {
                this.profileInfo = null
            } finally {
                this.loadingProfileInfo = false;
            }
        },

        async updateUserProfile(userId, payload) {
            try {
                const response = await axios.patch(`/api/userProfile/${userId}`, payload)
                this.profileInfo = response.data.data
            } catch (error) {
                console.error("Error updating profile info:", error);
            }
        },

        async createUserProfile(userId, payload) {
            try {
                const response = await axios.post(`/api/userProfile/${userId}`, payload);
                this.profileInfo = response.data.data
            } catch (error) {
                console.error("Error creating profile info:", error);
            }
        }
    },
});
