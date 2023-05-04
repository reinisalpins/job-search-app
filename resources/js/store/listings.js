import {defineStore} from "pinia";
import authAxios from "../api/axiosConfig";
import axios from "axios";

export const useListingStore = defineStore('listings', {
    state: () => ({
        listingsLoading: false,
        allEmployersListings: null,
        listingLoading: false,
        selectedListing: null,
        updateLoading: false
    }),

    getters: {
        getAllEmployersListings: (state) => state.allEmployersListings,
        getSelectedListing: (state) => state.selectedListing
    },

    actions: {
        async fetchAllEmployerListings(employerId) {
            this.listingsLoading = true
            try {
                const response = await authAxios.get(`api/employer/${employerId}/listings/all`)
                this.allEmployersListings = response.data.data
            } catch (error) {
                console.log(error)
            }
            this.listingsLoading = false
        },

        async fetchSelectedEmployerListing(employerId, listingId) {
            this.listingLoading = true
            try {
                const response = await authAxios.get(`api/employer/${employerId}/listings/${listingId}`)
                this.selectedListing = response.data.data
            } catch (error) {
                console.log(error)
            }
            this.listingLoading = false
        },

        async postJobListing(employerId, payload) {
            this.listingLoading = true
            try {
                const response = await authAxios.post(`api/employer/${employerId}/listings`, payload)
                this.selectedListing = response.data.data
                this.listingLoading = false
                await this.fetchAllEmployerListings(employerId)
                return {success: true, errorMessage: null}
            } catch (error) {
                this.listingLoading = false
                return {
                    success: false,
                    errorMessage: error.response?.data?.message || 'Aizpildiet laukus korekti un mēginiet vēlreiz'
                };
            }
        },

        async deleteListing(employerId, listingId) {
            try {
                await authAxios.delete(`/api/employer/${employerId}/listings/${listingId}`)
                await this.fetchAllEmployerListings(employerId)
                return {success: true, errorMessage: null}
            } catch (error) {
                return {
                    success: false,
                    errorMessage: error.response?.data?.message || 'Aizpildiet laukus korekti un mēginiet vēlreiz'
                };
            }
        },

        async updateListing(employerId, listingId, payload) {
            this.updateLoading = true
            try {
                await authAxios.patch(`/api/employer/${employerId}/listings/${listingId}`, payload)
                await this.fetchAllEmployerListings(employerId)
                this.updateLoading = false
                return {success: true, errorMessage: null}
            } catch (error) {
                this.updateLoading = false
                return {
                    success: false,
                    errorMessage: error.response?.data?.message || 'Aizpildiet laukus korekti un mēginiet vēlreiz'
                };
            }
        }
    }
})
