import './bootstrap';
import {createApp} from 'vue';
import App from './components/App.vue';
import router from './router';
import {createPinia} from "pinia";
import PrimeVue from 'primevue/config';
import ToastService from "primevue/toastservice";
import Toast from 'primevue/toast';

const pinia = createPinia()

createApp(App)
    .use(router)
    .use(PrimeVue)
    .use(pinia)
    .use(ToastService)
    .component('Toast', Toast)
    .mount('#app');

