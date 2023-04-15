<template>
    <div class="not-found-container">
        <div class="container">
            <div class="not-found">
                <Message severity="error" :closable="false">404 Šī lapa neeksistē, spiediet <span
                    @click="router.push('/')" class="route">šeit</span>
                    lai nokļūtu uz sākumlapu
                </Message>
            </div>
        </div>
    </div>
</template>
<script setup>
import Message from "primevue/message";
import router from "../router";
</script>
<style lang="scss">
.not-found-container {
    display: flex;
    justify-content: center;
    width: 100%;

    .not-found {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;

        .route {
            text-decoration: underline;
            cursor: pointer;
            font-weight: bold;

            &:hover {
                opacity: .8;
            }
        }

        .p-message.p-message-error {
            width: 100% !important;
        }
    }
}
</style>
