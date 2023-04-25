import axios from 'axios';

const authAxios = axios.create();

const setAuthToken = () => {
    const authToken = localStorage.getItem('auth_token');
    if (authToken) {
        authAxios.defaults.headers.common['Authorization'] = `Bearer ${authToken}`;
    } else {
        delete authAxios.defaults.headers.common['Authorization'];
    }
};

setAuthToken();

export default authAxios;
