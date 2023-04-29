import {defineStore} from "pinia";
import authAxios from "../api/axiosConfig";

export const useEmployerStore = defineStore('employers', {
    state: () => ({
        employerProfile: null,
        loadingEmployerProfile: false,
    }),

    getters: {
        getEmployerProfileInfo: (state) => state.employerProfile,
        isEmployerProfileLoading: (state) => state.loadingEmployerProfile,
    },

    actions: {
        async fetchEmployerProfile(userId) {
            this.loadingEmployerProfile = true
            try {
                const response = await authAxios.get(`/api/employer/profile/${userId}`)
                if (response.data.status) {
                    this.employerProfile = null
                } else {
                    this.employerProfile = response.data.data
                }
            } catch (error) {
                console.log(error)
            }
            this.loadingEmployerProfile = false
        },
        async setEmployerProfile(userId, payload) {
            try {
                const response = await authAxios.post(`/api/employer/profile/${userId}`, payload)
                this.employerProfile = response.data.data;
                return {success: true, errorMessage: null};
            } catch (error) {
                return {
                    success: false,
                    errorMessage: error.response?.data?.message || 'Aizpildiet laukus korekti un mēginiet vēlreiz'
                };
            }
        },

        async updateEmployerProfile(userId, payload) {
            try {
                const response = await authAxios.patch(`/api/employer/profile/${userId}`, payload)
                this.employerProfile = response.data.data;
                return {success: true, errorMessage: null};
            } catch (error) {
                return {
                    success: false,
                    errorMessage: error.response?.data?.message || 'Aizpildiet laukus korekti un mēginiet vēlreiz'
                };
            }
        },
    },

})
