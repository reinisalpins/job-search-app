import { createStore } from 'vuex';

export default createStore({
    state: {
        user: null,
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
    },
    actions: {
        setUser({ commit }, user) {
            commit('setUser', user);
        },
        async fetchUser({ commit }) {
            try {
                await axios.get('/sanctum/csrf-cookie');
                const response = await axios.get('/api/user');
                commit('setUser', response.data);
            } catch (error) {
                console.error('Error fetching user:', error);
            }
        },
    },
    getters: {
        getUser(state) {
            return state.user;
        },
        isLoggedIn(state) {
            return !!state.user;
        },
    },
});
