<template>
    <div class="shadow-2 bg-gray-300 border-round p-3">
        <div class="font-medium text-3xl text-900 mb-3 flex align-items-center gap-2 justify-content-between flex-wrap">
            <div>Uzņēmuma pamatinformācija</div>
            <router-link to="/vadibas-panelis/uznemuma-informacija"><Button rounded icon="pi pi-pencil"/></router-link>
        </div>
        <div class="text-600 mb-5">Neliela informācija par jūsu uzņēmumu, ko lietotāji varēs redzēt pie jūsu
            publicētajiem sludinājumiem
        </div>
        <ul class="list-none p-0 m-0">
            <li class="flex align-items-center py-3 px-2 flex-wrap">
                <div class="text-600 w-6 md:w-2 font-medium">Uzņēmuma nosaukums</div>
                <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">{{ companyInfo.company_name }}</div>
            </li>
            <li class="flex align-items-center py-3 px-2 flex-wrap">
                <div class="text-600 w-6 md:w-2 font-medium">Tālrunis</div>
                <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">
                    <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">{{ companyInfo.phone }}</div>
                </div>
            </li>
            <li class="flex align-items-center py-3 px-2 flex-wrap">
                <div class="text-600 w-6 md:w-2 font-medium">E-Pasts</div>
                <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">{{ user.email }}</div>
            </li>
            <li class="flex align-items-center py-3 px-2 flex-wrap">
                <div class="text-600 w-6 md:w-2 font-medium">Atrašanās vieta</div>
                <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1">{{ companyInfo.location }}</div>
            </li>
            <li class="flex align-items-center py-3 px-2 flex-wrap overflow-hidden">
                <div class="text-600 w-6 md:w-2 font-medium">Mājas lapa</div>
                <div class="text-900 w-full md:w-8 md:flex-order-0 flex-order-1"><a
                    class="hover:underline text-blue-600"
                    :href="companyInfo.website_url" target="_blank">{{ companyInfo.website_url }}</a></div>
            </li>
            <li class="flex py-3 px-2 flex-wrap">
                <div class="text-600 w-6 md:w-2 font-medium">Apraksts par uzņēmumu</div>
                <div class="text-900 bg-white w-full md:w-8 md:flex-order-0 flex-order-1 shadow-1 border-gray-500 border-round p-2" v-html="companyInfo.about"></div>
            </li>
        </ul>
    </div>
</template>
<script setup>
import Button from "primevue/button";
import {useUserStore} from "../../../../store/user";
import {computed} from "vue";
import router from "../../../../router";

const userPinia = useUserStore()
const user = computed(() => userPinia.getUser)

const props = defineProps({
    companyInfo: Object,
})
</script>

<style scoped lang="scss">
li {
    border-top: 1px solid #cacaca;
}

</style>
