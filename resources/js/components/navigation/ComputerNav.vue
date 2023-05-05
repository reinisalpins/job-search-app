<template>
    <div class="w-full flex flex-row pt-5 pb-5 justify-content-between align-items-center">
        <router-link to="/">
            <Image src="/assets/logo.png" width="200"/>
        </router-link>
        <div>
            <ul class="flex gap-5 align-items-center">
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
        </div>
    </div>
</template>

<script setup>
import Image from "primevue/image";
import Button from "primevue/button";

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
