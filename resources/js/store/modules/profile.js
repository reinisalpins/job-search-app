import axios from "axios";

const state = {
    userProfileInfo: null,
};

const mutations = {
    setProfileInfo(state, profileInfo) {
        state.userProfileInfo = profileInfo;
    },
};

const actions = {
    setProfileInfo({ commit }, profileInfo) {
        commit("setProfileInfo", profileInfo);
    },
    async fetchProfileInfo({ commit }, userId) {
        try {
            const response = await axios.get(`/api/userProfile/${userId}`);
            commit("setProfileInfo",response.data.data);
        } catch (error) {
            console.error("Error fetching profile info:", error);
        }
    },
    async createProfileInfo({ commit }, { userId, payload }) {
        try {
            const response = await axios.post(`/api/userProfile/${userId}`, payload);
            commit("setProfileInfo", response.data.data);
        } catch (error) {
            console.error("Error creating profile info:", error);
        }
    },
    async updateProfileInfo({ commit }, { userId, payload }) {
        try {
            const response = await axios.patch(`/api/userProfile/${userId}`, payload);
            commit("setProfileInfo", response.data.data);
        } catch (error) {
            console.error("Error updating profile info:", error);
        }
    },
};

const getters = {
    getProfileInfo: (state) => {
        return state.userProfileInfo;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
