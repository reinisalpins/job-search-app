<template>
    <div class="w-full pt-6 pb-5">
        <Divider class="border-top-1"/>
        <div class="flex flex-wrap justify-content-between gap-3 align-items-center">
            <img src="/assets/logo.png" alt="logo"/>
            <ul class="flex gap-5 flex-wrap">
                <li v-for="(category, index) in footerLinks" :key="index">
                    <h1>{{ category.title }}</h1>
                    <ul class="flex flex-column gap-1 mt-3">
                        <li v-for="(link, index) in category.links" :key="index">{{ link }}</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>
<script setup>
import Divider from "primevue/divider";

const footerLinks = [
    {
        title: 'Noderīgas saites',
        links: ['Par mums', 'Noteikumi', 'Sazināties'],
    },
    {
        title: 'Vakances',
        links: ['Darbs', 'Prakse', 'Pašnodarbinātajiem'],
    },
];

const socialIcons = [
    {icon: 'pi pi-facebook'},
    {icon: 'pi pi-twitter'},
    {icon: 'pi pi-instagram'},
];

</script>

<style lang="scss" scoped>
img {
    max-height: 70px;
    max-width: 280px;
    width: 100%;
}
</style>
