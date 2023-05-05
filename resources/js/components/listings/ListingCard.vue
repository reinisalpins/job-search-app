<template>
    <div class="w-full flex flex-column shadow-2 border-round">
        <ul>
            <li class="p-3 flex gap-3 align-items-center flex-wrap border-round">
                <Image width="130" src="https://www.printful.com/static/images/layout/printful-logo.png"/>
                <div class="flex flex-column gap-2">
                    <h2 class="text-2xl text-800 font-bold uppercase">Software Tester</h2>
                    <div class="flex gap-1 flex-column">
                        <h3>Printful - <span class="text-sm">Liepāja/Attālināti</span></h3>
                    </div>
                    <h5 class="font-normal">Publicēts pirms 7 dienām</h5>
                    <div>
                        <Chip class="bg-gray-700 text-white" label="1500-2000$"/>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
<script setup>
import Image from "primevue/image";
import Chip from "primevue/chip";
</script>
<style lang="scss" scoped>

li {
    background: #e2e2e2;
    cursor: pointer;

    &:hover {
        background: #dedede;
    }
}

h3 {
    font-weight: normal;
}
</style>
