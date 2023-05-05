<template>
    <div class="main">
        <Toast/>
        <div class="main-flex-item">
            <NavBar/>
            <router-view></router-view>
        </div>
        <ScrollTop />
        <Footer/>
        <AuthDialog/>
    </div>
</template>

<script setup>
import Footer from "./Footer.vue";
import NavBar from "./navigation/NavBar.vue";
import 'primeicons/primeicons.css';
import {useUserStore} from "../store/user";
import "primevue/resources/primevue.min.css";
import '../../css/theme.css'
import "primeflex/primeflex.css";
import {onMounted} from "vue";
import ScrollTop from "primevue/scrolltop";
import AuthDialog from "./AuthDialog.vue";

const profileStore = useUserStore();

onMounted(async () => {
    await profileStore.fetchUser();
});
</script>
<style lang="scss">
.main {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    max-width: 1440px;
    width: 100%;
    margin: auto;
    padding-left: 20px;
    padding-right: 20px;
}

.main-flex-item {
    flex: 1;
    width: 100%;
}
</style>
