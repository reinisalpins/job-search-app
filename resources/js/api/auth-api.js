import axios from 'axios';

const baseAPI = axios.create({
    baseURL: '/api',
    withCredentials: true,
});

const authAPI = axios.create({
    baseURL: '/api',
    withCredentials: true,
});

authAPI.interceptors.request.use((config) => {
    const authToken = localStorage.getItem('auth_token');
    if (authToken) {
        config.headers.Authorization = `Bearer ${authToken}`;
    }
    return config;
});

export { baseAPI, authAPI };
