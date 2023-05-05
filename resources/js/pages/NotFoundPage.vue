<template>
    <Message class="shadow-2" severity="error" :closable="false">404 Šī lapa neeksistē, spiediet
        <router-link to="/" class="font-bold hover:underline">šeit</router-link>
        lai nokļūtu uz sākumlapu
    </Message>
</template>
<script setup>
import Message from "primevue/message";
</script>
<style lang="scss">
</style>
