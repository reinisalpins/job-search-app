<template>
    <div class="main">
        <Toast/>
        <div class="main-flex-item">
            <NavBar/>
            <router-view></router-view>
        </div>
        <Footer/>
    </div>
</template>

<script>
import Footer from "./Footer.vue";
import NavBar from "./NavBar.vue";
import 'primeicons/primeicons.css';
import {getUserData} from "../../api/axios";
import "primevue/resources/themes/lara-light-indigo/theme.css";
import "primevue/resources/primevue.min.css";

export default {
    name: 'App',
    components: {
        Footer,
        NavBar,
    },
    async created() {
        await getUserData();
    },
};
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
