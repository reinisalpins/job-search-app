import './bootstrap';
import {createApp} from 'vue';
import App from './components/App.vue';
import router from './router';
import store from './store';
import PrimeVue from 'primevue/config';

createApp(App)
    .use(router)
    .use(store)
    .use(PrimeVue)
    .mount('#app');

