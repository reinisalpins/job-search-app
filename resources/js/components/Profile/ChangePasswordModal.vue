<template>
    <Button label="Mainīt paroli" class="submit-btn modal-btn" @click="showModal = true"/>
    <Dialog v-model:visible="showModal" header="Mainīt paroli"  modal :draggable="false">
        <div class="change-pw-container">
            <label for="currentPw">Vecā parole: </label>
            <Password name="currentPw" v-model="oldPw" toggleMask :feedback="false"/>

            <label for="newPw">Jaunā parole: </label>
            <Password name="newPw" v-model="newPw" toggleMask :feedback="false"/>

            <label for="currentPw">Jaunā parole atkārtoti:  </label>
            <Password name="newPwAgain" v-model="newPwAgain" toggleMask :feedback="false"/>
            <Button label="Saglabāt" class="submit-btn modal-btn"/>
        </div>
    </Dialog>

</template>
<script setup>
import Button from "primevue/button";
import {ref} from "vue";
import Dialog from "primevue/dialog";
import Password from "primevue/password";

const showModal = ref(false)
const oldPw = ref(null)
const newPw = ref(null)
const newPwAgain = ref(null)



</script>
<style lang="scss">
.change-pw-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
</style>
