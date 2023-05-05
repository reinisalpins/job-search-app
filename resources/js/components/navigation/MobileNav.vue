<template>
    <div class="fixed right-0 pr-3 pt-3">
        <div class="flex justify-content-end">
            <Button @click="showSideBar = true" rounded icon="pi pi-bars"/>
        </div>
    </div>
    <Sidebar v-model:visible="showSideBar" position="right">
        <ul class="flex flex-column w-full justify-content-center gap-4 text-xl text-primary">
            <li v-for="(item, index) in items" class="text-xl text-primary">
                <div v-if="item.label === 'Ielogoties' || item.label === 'Vadības panelis'">
                    <Button :label="item.label" @click="item.onClick"/>
                </div>
                <div v-else>
                    <router-link
                        :class="`hover:text-black-alpha-60 ${activePath === `/${item.path}` ? 'active' : ''}`"
                        :to="`/${item.path}`">
                        {{ item.label }}
                    </router-link>
                </div>
            </li>
        </ul>
    </Sidebar>
</template>

<script setup>
import Sidebar from "primevue/sidebar";
import {ref} from "vue";
import {useRoute} from "vue-router";
import Button from "primevue/button";

const showSideBar = ref(false)
const route = useRoute();

const props = defineProps({
    items: Object,
    activePath: String
})
</script>

<style lang="scss" scoped>
button {
    border-radius: 10px;
}

.active {
    color: rgba(0, 0, 0, 0.6);
}
</style>
