<template>
    <div class="profile-container">
        <div class="container">
            <h2>Sveiki, {{ user?.first_name || 'User' }}</h2>
            <p>E-pasts: {{ user?.email || 'N/A' }}</p>
            <Button label="izlogoties" class="btn-bg" @click="logout"/>
            <Button label="Labot profila informāciju" @click="visible = true"/>
            <Dialog v-model:visible="visible" :draggable="false" modal header="Profila informācija"
                    :style="{ width: '50vw' }">
               <span class="p-float-label">
                    <Chips id="chips" v-model="skills"/>
                    <label for="chips">Tavas prasmes</label>
                </span>
            </Dialog>
        </div>
    </div>
</template>

<script setup>
import {computed, ref} from 'vue';
import {useStore} from 'vuex';
import {logout} from "../../api/axios";
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import Chips from 'primevue/chips';

const skills = ref();

const store = useStore();

const user = computed(() => store.state.user);

const visible = ref(false);
const logoutUser = () => {
    logout()
    store.dispatch('setUser', null);
}
</script>

<style lang="scss">

.profile-container {
    display: flex;
    width: 100%;
    justify-content: center;
    padding-top: 200px;
}

.edit-container {
    display: flex;
}

.btn-bg {
    background-color: red !important;
    border: none !important;

    &:hover {
        background-color: #fb6a6a !important;
    }
}

.p-dialog-content {
    padding-top: 20px !important;
}
</style>
