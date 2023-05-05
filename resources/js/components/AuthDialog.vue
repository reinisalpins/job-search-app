<template>
    <Dialog :dismissableMask="true" :draggable="false" header=" " v-model:visible="indexStore.isAuthDialogOpen" modal
            :style="{ width: '40vw' }" :breakpoints="{ '1500px': '60vw','1100px': '75vw', '641px': '100vw' }">
        <Login v-if="!indexStore.getIsRegisterActive"/>
        <Register v-if="indexStore.getIsRegisterActive"/>
    </Dialog>

</template>
<script setup>
import Dialog from "primevue/dialog";
import Login from "./auth/Login.vue";
import {useIndex} from "../store";
import Register from "./auth/Register.vue";

const indexStore = useIndex()
</script>


<style lang="scss">
.p-dialog .p-dialog-header {
    padding-bottom: 0px !important;
}

.p-dialog {
    padding: 15px !important;
    box-shadow: none !important;
}


</style>
