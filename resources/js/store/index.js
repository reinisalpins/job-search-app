import {defineStore} from "pinia";

export const useIndex = defineStore('index', {
    state: () => ({
        isAuthDialogOpen: false,
        isRegisterActive: false
    }),

    getters: {
        getIsAuthDialogOpened: (state) => state.isAuthDialogOpen,
        getIsRegisterActive: (state) => state.isRegisterActive
    },

    actions: {
        showAuthDialog() {
            this.isAuthDialogOpen = true
        },

        hideAuthDialog() {
            this.isAuthDialogOpen = false
        },

        makeRegisterActive() {
            this.isRegisterActive = true
        },

        makeRegisterInactive() {
            this.isRegisterActive = false
        }
    }
})
