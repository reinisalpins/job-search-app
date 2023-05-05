import {defineStore} from "pinia";
import authAxios from "../api/axiosConfig";

export const useEmployerStore = defineStore('employers', {
    state: () => ({
        employerProfile: null,
        isLoading: false,
        isFormLoading: false
    }),

    getters: {
        getEmployerProfileInfo: (state) => state.employerProfile,
    },

    actions: {
        async fetchEmployerProfile(userId) {
            this.isLoading = true
            try {
                const response = await authAxios.get(`/api/employer/${userId}/profile`)
                if (response.data.status) {
                    this.employerProfile = null
                } else {
                    this.employerProfile = response.data.data
                }
            } catch (error) {
                console.log(error)
            }
            this.isLoading = false
        },
        async setEmployerProfile(userId, payload) {
            this.isFormLoading = true
            try {
                const response = await authAxios.post(`/api/employer/${userId}/profile`, payload)
                this.employerProfile = response.data.data;
                this.isFormLoading = false
                return {success: true, errorMessage: null};
            } catch (error) {
                this.isFormLoading = false
                return {
                    success: false,
                    errorMessage: error.response?.data?.message || 'Aizpildiet laukus korekti un mēginiet vēlreiz'
                };
            }
        },

        async updateEmployerProfile(userId, payload) {
            this.isFormLoading = true
            try {
                const response = await authAxios.patch(`/api/employer/${userId}/profile`, payload)
                this.employerProfile = response.data.data;
                this.isFormLoading = false
                return {success: true, errorMessage: null};
            } catch (error) {
                this.isFormLoading = false
                return {
                    success: false,
                    errorMessage: error.response?.data?.message || 'Aizpildiet laukus korekti un mēginiet vēlreiz'
                };
            }
        },

        async clearEmployerProfile() {
            this.employerProfile = null
        }
    },

})
