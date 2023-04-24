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
        loadingChangePassword: false
    }),

    getters: {
        getUser: (state) => state.user,
        getIsLoggedIn: (state) => !!state.user,
        getIsUserLoaded: (state) => state.isUserLoaded,
        getIsLoadingProfileInfo: (state) => state.loadingProfileInfo,
        getProfileInfo: (state) => state.profileInfo,
        getLoadingChangePassword: (state) => state.loadingChangePassword
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
                this.profileInfo = null
            } catch (error) {
                console.error('Error logging out:', error);
            }
        },

        async fetchUserProfile(userId) {
            this.loadingProfileInfo = true
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
        },

        async changeUserPassword(userId, password) {
            this.loadingChangePassword = true
            try {
                const response = await axios.patch(`/api/user/${userId}/changePassword`, password)
                return 200
            } catch (error) {
                return 400
            } finally {
                this.loadingChangePassword = false
            }
        }
    },
});
