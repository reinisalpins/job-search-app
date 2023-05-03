import {defineStore} from "pinia";
import authAxios from "../api/axiosConfig";

export const useListingStore = defineStore('listings', {
    state: () => ({
        listingsLoading: false,
        allEmployersListings: null,
    }),

    getters: {
        getAllEmployersListings: (state) => state.allEmployersListings,
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
        }
    }
})
