import './bootstrap';
import {createApp} from 'vue';
import App from './components/App.vue';
import router from './router';
import store from './store';
import PrimeVue from 'primevue/config';
import ToastService from "primevue/toastservice";
import Toast from 'primevue/toast';

createApp(App)
    .use(router)
    .use(store)
    .use(PrimeVue)
    .use(ToastService)
    .component('Toast', Toast)
    .mount('#app');

