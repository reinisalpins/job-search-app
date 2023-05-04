<template>
    <div class="listing-nav mb-4">
        <ul>
            <li v-for="(item, index) in items" :key="index" @click="router.push(item.to)"
                :class="currentRoute === item.to ? 'active' : ''">
                <i :class="item.icon"></i>
                {{ item.label }}
            </li>
        </ul>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import router from "../../../../router";
import {useRoute} from "vue-router";

const routers = useRoute()
const currentRoute = computed(() => routers.path)

const items = ref([
    {
        label: 'Visas vakances',
        icon: 'pi pi-fw pi-home',
        to: '/profils/vakances'
    },
    {
        label: 'Aktīvās vakances',
        icon: 'pi pi-fw pi-check-circle',
        to: '/profils/vakances/aktivas'
    },
    {
        label: 'Vakanču vēsture',
        icon: 'pi pi-fw pi-calendar',
        to: '/profils/vakances/vesture'
    },
    {
        label: 'Vakanču iestatījumi',
        icon: 'pi pi-fw pi-cog',
        to: '/profils/vakances/iestatijumi'
    },
]);
</script>

<style scoped lang="scss">
.listing-nav {
    border-radius: 6px;
    font-size: 16px;

    ul {
        display: flex;
        flex-wrap: wrap;

        li {
            border: 1px solid #e1e6eb;
            padding: 15px;
            max-width: 200px;
            width: 100%;

            &:hover {
                background: #f8f9fa;
                cursor: pointer;
            }

            &.active {
                background: #f8f9fa;
                text-decoration: none !important;
                font-weight: bold;
            }
        }
    }
}
</style>
