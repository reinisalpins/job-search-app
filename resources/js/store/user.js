import {defineStore} from 'pinia';
import axios from 'axios';
import authAxios from "../api/axiosConfig";
import router from "../router";

// const authAxios = axios.create({
//     baseURL: '/api',
// });

export const useProfileStore = defineStore({
    id: 'profile',

    state: () => ({
        user: null,
        isUserLoaded: false,
        loadingProfileInfo: false,
        profileInfo: null,
        loadingChangePassword: false,
        profileInfoLoaded: false,
    }),

    getters: {
        getUser: (state) => state.user,
        getIsLoggedIn: (state) => !!state.user,
        getIsUserLoaded: (state) => state.isUserLoaded,
        getIsLoadingProfileInfo: (state) => state.loadingProfileInfo,
        getProfileInfo: (state) => state.profileInfo,
        getLoadingChangePassword: (state) => state.loadingChangePassword,
        getIsProfileInfoLoaded: (state) => state.profileInfoLoaded
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
                await this.fetchUser()
                return true
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
            try {
                await authAxios.post('/api/logout');
                localStorage.removeItem('auth_token');
                this.user = null
                this.profileInfo = null
                this.profileInfoLoaded = false
            } catch (error) {
                console.error('Error logging out:', error);
            }
        },

        async fetchUserProfile(userId) {
            this.loadingProfileInfo = true
            if (!this.profileInfoLoaded) {
                try {
                    const response = await authAxios.get(`/api/user/profile/${userId}`);
                    this.profileInfo = response.data.data
                } catch (error) {
                    this.profileInfo = null
                } finally {
                    this.loadingProfileInfo = false;
                    this.profileInfoLoaded = true;
                }
            }
        },

        async updateUserProfile(userId, payload) {
            try {
                const response = await authAxios.patch(`/api/user/profile/${userId}`, payload)
                this.profileInfo = response.data.data
            } catch (error) {
                console.error("Error updating profile info:", error);
            }
        },

        async createUserProfile(userId, payload) {
            try {
                const response = await authAxios.post(`/api/user/profile/${userId}`, payload);
                this.profileInfo = response.data.data
            } catch (error) {
                this.profileInfo = null
                console.error("Error creating profile info:", error);
            }
        },

        async changeUserPassword(userId, password) {
            this.loadingChangePassword = true
            try {
                const response = await authAxios.patch(`/api/user/${userId}/password`, password)
                return response.status
            } catch (error) {
                return 400
            } finally {
                this.loadingChangePassword = false
            }
        }
    },
});
