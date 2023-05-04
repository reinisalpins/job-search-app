<template>
    <div class="job-listings-container">
        <JobListingNavigation/>
        <router-view/>
    </div>
</template>
<script setup>
import JobListingNavigation from "./JobListingNavigation.vue";
</script>
<style lang="scss">
</style>
