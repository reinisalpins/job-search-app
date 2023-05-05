<template>
    <Menubar class="bg-gray-300 shadow-1" :model="items"/>
</template>

<script setup>
import Menubar from "primevue/menubar";
import {computed, onMounted, ref} from "vue";
import {useUserStore} from "../../../store/user";
import router from "../../../router";
import {useEmployerStore} from "../../../store/employer";

const userPinia = useUserStore()
const employerPinia = useEmployerStore()
const logoutLoading = computed(() => userPinia.isLoading)

const user = computed(() => userPinia.getUser)
const employerProfile = computed(() => employerPinia.getEmployerProfileInfo)

const items = ref([
    {
        label: 'Uzņēmums',
        icon: 'pi pi-fw pi-book',
        to: '/vadibas-panelis'
    },
    {
        label: 'Vakances',
        icon: 'pi pi-fw pi-list',
        items: [
            {
                label: 'Visas vakances',
                to: '/vadibas-panelis/vakances'
            },
            {
                label: 'Aktivas vakances',
                to: '/vadibas-panelis/vakances/aktivas'

            },
            {
                label: 'Neaktivas vakances',
                to: '/vadibas-panelis/vakances/neaktivas'
            },
            {
                label: 'Vakancu iestatijumi',
                to: '/vadibas-panelis/vakances/iestatijumi'
            }
        ]
    },
    {
        label: 'Pieteikumi',
        icon: 'pi pi-fw pi-user-plus',
        to: '/vadibas-panelis/pieteikumi'
    },
    {
        label: 'Iestatijumi',
        icon: 'pi pi-fw pi-cog',
        items: [
            {
                label: 'Mainīt paroli',
                icon: 'pi pi-fw pi-user-edit',
                to: '/vadibas-panelis/iestatijumi/mainit-paroli'
            }
        ]
    },
    {
        label: 'Izlogoties',
        icon: computed(() => (logoutLoading.value ? 'pi pi-spin pi-spinner' : 'pi pi-fw pi-power-off')),
        command: () => {
            logout()
        }
    }
]);

onMounted(() => {
    if (employerProfile.value === null || !employerProfile.value) {
        employerPinia.fetchEmployerProfile(user.value.id)
    }
})
const logout = async () => {
    await userPinia.logout()
    await employerPinia.clearEmployerProfile()
    await router.push('/');
}
</script>
