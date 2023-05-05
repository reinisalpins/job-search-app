<template>
    <div class="flex gap-5 align-items-center pt-5">
        <div class="flex-1 flex flex-column gap-5 landing-heading">
            <h1 class="text-7xl line-height-1">Atrodi savu vietu IT pasaulē</h1>
            <h2 class="text-2xl font-normal">Izpēti jaunākās IT darba un prakses iespējas</h2>
            <div class="flex gap-4">
                <router-link to="/vakances">
                    <Button label="Darba vakances"/>
                </router-link>
                <router-link to="/prakse">
                    <Button outlined class="border-2" label="Prakse"/>
                </router-link>
            </div>
        </div>
        <div class="flex-1 flex align-items-center justify-content-center" v-if="width >= 1250">
            <img src="/assets/tech.jpeg" alt="Sample tech image"/>
        </div>
    </div>

    <div class="flex gap-5 align-items-center pt-7 cards">
        <div class="flex-1">
            <ul class="flex flex-column gap-4 justify-content-center align-items-center w-full">
                <li v-for="card in cardsData"
                    class="bg-black-alpha-90 flex text-left flex-column gap-3 text-white p-3 card border-round-2xl shadow-2">
                    <div class="flex gap-3 align-items-center">
                        <i :class="`${card.icon} text-2xl`"></i>
                        <h2 class="text-white">{{ card.title }}</h2>
                    </div>
                    <div>
                        {{ card.description }}
                    </div>
                </li>
            </ul>
        </div>

        <div class="flex-1 flex flex-column gap-3">
            <h1 class="text-6xl line-height-1">Kāpēc izmantot mūsu sistēmu?</h1>
            <h2 class="text-2xl font-normal">Daži iemesli kādēļ izmantot mūsu sistēmu</h2>
        </div>
    </div>

    <div class="flex flex-column pt-7 gap-5 pb-5 justify-content-center text-center">
        <div class="mb-3 font-bold text-3xl flex flex-column gap-3">
            <h1 class="text-5xl">Esi pašnodarbinātais? </h1>
            <h2 class="text-2xl text-800">Mums ir piedāvājumi arī Tev</h2>
        </div>
        <div class="flex flex-wrap flex-column lg:flex-row lg:gap-3 gap-6">
            <div class="flex flex-column gap-3 align-items-center text-center flex-1">
                <div
                    class="flex w-4rem h-4rem border-round shadow-1 justify-content-center align-items-center bg-gray-300">
                    <i class="pi pi-search text-xl"></i>
                </div>
                <h2>Meklē jaunu un interesantu projektu?</h2>
                <h5 class="font-normal">Ar dažu klikšku palīdzību tiec pie jauna projekta</h5>
            </div>
            <div class="flex flex-column gap-3 align-items-center text-center flex-1">
                <div
                    class="flex w-4rem h-4rem border-round shadow-1 justify-content-center align-items-center bg-gray-300">
                    <i class="pi pi-briefcase text-xl"></i>
                </div>
                <h2 >Vēlies izmēginat spēkus freelance pasaulē?</h2>
                <h5 class="font-normal">Apskati pieejamos piedāvājumus</h5>
            </div>
            <div class="flex flex-column gap-3 align-items-center text-center flex-1">
                <div
                    class="flex w-4rem h-4rem border-round shadow-1 justify-content-center align-items-center bg-gray-300">
                    <i class="pi pi-check text-xl"></i>
                </div>
                <h2>Meklē ekspertu savai biznesa idejai?</h2>
                <h5 class="font-normal">Mūsu sistēmā vari atrast nepieciešamo darbaspēku sava iecerētā projekta
                    izstrādei</h5>
            </div>
        </div>
    </div>
</template>
<script setup>
import {useWindowSize} from "@vueuse/core";
import Button from "primevue/button";

const {width, height} = useWindowSize()

const cardsData = [
    {
        icon: 'pi pi-verified',
        title: 'Verificēti piedāvājumi',
        description:
            'Pirms darba piedāvājums tiek padarīts publisks,' +
            ' mēs verificējam darba devēja norādīto informāciju,' +
            ' kā arī pārbaudām pašu uzņēmumu, lai netiktu publicētas nepatiesas vakances vai spams.',
    },
    {
        icon: 'pi pi-history',
        title: 'Tikai aktuālās vakances',
        description:
            'Mūsu vakances tiek atjauninātas katru dienu,' +
            ' lai jūs varētu pārlūkot visjaunākos pieejamos piedāvājumus,' +
            ' no kuriem daudzi netiks atrasti citās darba sludinājumu vietnēs.',
    },
    {
        icon: 'pi pi-link',
        title: 'Tieša pieteikšanās sistēma',
        description:
            'Pieteikšanās nekad nav bijusi tik viegla.' +
            ' Caur mūsu platformu aizsūti savu pieteikumu pa tiešo vēlamā uzņēmuma HR administratora pastkastītē.',
    },
];


</script>

<style scoped lang="scss">
h1, h2 {
    color: #1e1f26;
}

button {
    border-radius: 10px;
}

img {
    max-width: 600px;
    width: 100%;
    border-radius: 10px;
}

.landing-heading {
    @media screen and (max-width: 1249px) {
        justify-content: center;
        align-items: center;
        text-align: center;
    }
}

.card {
    max-width: 430px;
    width: 100%;
}

.cards {
    @media screen and (max-width: 1100px) {
        justify-content: center;
        flex-direction: column-reverse;
        text-align: center;
    }
}
</style>
