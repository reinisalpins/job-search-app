<template>
    <div class="nav">
        <ComputerNav :items="navItems" :active-path="activePath" v-if="width >= 1250"/>
        <MobileNav :items="navItems" :active-path="activePath" v-if="width < 1250"/>
    </div>
</template>

<script setup>
import {computed, ref, watch} from "vue";
import {useWindowSize} from '@vueuse/core'
import {useRoute} from "vue-router";
import {useUserStore} from "../../store/user";
import {useIndex} from "../../store";
import router from "../../router";
import MobileNav from "./MobileNav.vue";
import ComputerNav from "./ComputerNav.vue";

const {width} = useWindowSize()
const route = useRoute();
const profileStore = useUserStore();
const indexStore = useIndex()

const isLoggedIn = computed(() => profileStore.getIsLoggedIn);
const user = computed(() => profileStore.getUser);

const navItems = ref([
    {path: 'vakances', label: 'Darba vakances'},
    {path: 'prakse', label: 'Prakse'},
    {path: 'darba-devejiem', label: 'Darba devējiem'},
    {
        path: 'ielogoties', label: 'Ielogoties', className: 'login',
        onClick: () => {
            indexStore.showAuthDialog()
        },
    },
]);

watch(isLoggedIn, (loggedIn) => {
    navItems.value = [
        {path: 'vakances', label: 'Darba vakances'},
        {path: 'prakse', label: 'Prakse'},
        {path: 'darba-devejiem', label: 'Darba devējiem'},
        {
            label: loggedIn ? 'Vadības panelis' : 'Ielogoties',
            className: 'login',
            onClick: () => {
                if (!loggedIn) {
                    indexStore.showAuthDialog()
                } else {
                    router.push('/vadibas-panelis')
                }
            },
        },
    ];
});

const activePath = computed(() => route.path)

</script>

<style lang="scss">
</style>

