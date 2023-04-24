<template>
    <div class="main">
        <Toast/>
        <div class="main-flex-item">
            <NavBar/>
            <router-view></router-view>
        </div>
        <ScrollTop />
        <Footer/>
    </div>
</template>

<script setup>
import Footer from "./Footer.vue";
import NavBar from "./NavBar.vue";
import 'primeicons/primeicons.css';
import {useProfileStore} from "../store/user";
import "primevue/resources/primevue.min.css";
import '../../css/theme.css'
import "primeflex/primeflex.css";
import {onMounted} from "vue";
import ScrollTop from "primevue/scrolltop";

const profileStore = useProfileStore();

onMounted(async () => {
    await profileStore.fetchUser();
});
</script>
<style lang="scss">
.main {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.main-flex-item {
    flex: 1;
}
</style>
