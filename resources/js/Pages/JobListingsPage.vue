<template>
    <div class="listings-container">
        <div class="container listings-page-container">
            <ListingCard/>
        </div>
    </div>
</template>
<script setup>
import ListingCard from "../components/ListingCard.vue";
</script>
<style lang="scss">
.listings-page-container {
    align-items: baseline;
}
</style>
