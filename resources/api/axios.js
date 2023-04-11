import axios from 'axios';
import store from "../js/store";
import router from "../js/router";

const authAxios = axios.create({
    baseURL: '/api',
});

const getUserData = async () => {
    const authToken = localStorage.getItem('auth_token');

    if (authToken) {
        authAxios.defaults.headers.common['Authorization'] = `Bearer ${authToken}`;
    } else {
        return;
    }

    try {
        const response = await authAxios.get('/user');
        const userData = response.data;
        await store.dispatch('setUser', userData);
    } catch (error) {
        console.error('Error getting user data:', error);
    }
};

const logout = async () => {
    const authToken = localStorage.getItem('auth_token');

    if (authToken) {
        authAxios.defaults.headers.common['Authorization'] = `Bearer ${authToken}`;
    } else {
        return;
    }

    try {
        await authAxios.post('/logout');
        localStorage.removeItem('auth_token');
        await store.dispatch('setUser', null);
        await router.push('/ielogoties')
    } catch (error) {
        console.error('Error logging out:', error);
    }
};

export { authAxios, getUserData, logout };
