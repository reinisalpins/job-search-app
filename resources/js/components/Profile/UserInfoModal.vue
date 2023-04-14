<template>
    <Button label="Labot profila informāciju" @click="visible = true"/>
    <Dialog v-model:visible="visible" :draggable="false" modal header="Profila informācija"
            :style="{ width: '50vw' }">
                   <span class="p-float-label">

                    </span>
    </Dialog>
</template>
<script setup>
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import {ref} from "vue";



const visible = ref(false);

</script>
<style lang="scss"></style>
