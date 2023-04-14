import {createStore} from "vuex";

export default createStore({
    state: {
        userProfileInfo: null
    },
    mutations: {
      setProfileInfo(state, profileInfo) {
          state.userProfileInfo = profileInfo
      }
    },
    actions: {
        setProfileInfo({ commit }, profileInfo) {
            commit('setProfileInfo', profileInfo);
        },
        async fetchProfileInfo({ commit }) {
            try {

            } catch (error) {
                console.error('Error fetching profile info:', error);
            }
        }
    },
    getters: {
        getProfileInfo(state) {
            return state.userProfileInfo
        }
    }
})
