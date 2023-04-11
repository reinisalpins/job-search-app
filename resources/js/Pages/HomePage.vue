<template>
    <div class='home-container'>
        <div class="container">
            <h1>Atrodi savu vietu IT nozarē</h1>
            <div class='home-links'>
                <router-link to="/vakances"><span>Darba vakances</span></router-link>
                <span>Prakses vietas</span>
            </div>
        </div>
    </div>
    <div class='info-container'>
        <div class="main-info-container">
            <div v-if="width >= 650">
                <img src='/assets/developer.png'/>
            </div>
            <div class='text-flex-item'>
                <h1>Esi pašnodarbinātais?</h1>
                <p>Mūsu platforma padara klientu atrašanu Jums daudz vieglāku.</p>
                <p>Jauns projekts dažu klikšķu attālumā.</p>
                <button>Apskatīt piedāvājumus</button>
            </div>
        </div>
    </div>
    <div class='cards-container'>
        <div class="main-cards-container">
            <div class='text'>
                <h1>Vai esi gatavs spert nākamo soli savā karjerā?</h1>
                <h2>Sadarbojoties ar uzņēmumiem mēs nodrošinam plašu vakanču sarakstu jaunajiem profesionāļiem,
                    kā
                    arī pieredzējušiem speciālistiem.</h2>
            </div>
            <div class='cards'>
                <div class='card' v-for="(card, index) in cardsData" :key="index">
                    <i :class="card.icon" style="font-size: 3rem"></i>
                    <h1>{{ card.title }}</h1>
                    <p>{{ card.description }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {useWindowSize} from "@vueuse/core";

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

<style lang="scss">
.home-container {
    height: 40vh;
    min-height: 350px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: #1C1C1C;
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 80%);

    @media screen and (max-width: 700px) {
        min-height: 500px;
    }

    h1 {
        font-size: 48px;
        color: #fff;
        padding-left: 20px;
        padding-right: 20px;
        text-align: center;
        @media screen and (max-width: 650px) {
            font-size: 40px;
        }
    }

    .home-links {
        display: flex;
        gap: 25px;
        align-items: center;

        @media screen and (max-width: 650px) {
            gap: 13px;
        }

        span {
            background-color: #234E70;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            font-size: 1.2rem;

            @media screen and (max-width: 650px) {
                font-size: .9rem;
                padding: 8px;
            }

            &:hover {
                opacity: .9;
            }
        }
    }
}

.info-container {
    display: flex;
    flex-direction: column;
    width: 100%;
    justify-content: center;
    align-items: center;

    .main-info-container {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 25px;
        width: 100%;
        max-width: 1600px;
        padding: 15px 20px;

        img {
            width: 100%;
            max-width: 420px;
        }

        .text-flex-item {
            display: flex;
            gap: 5px;
            flex-direction: column;

            @media screen and (max-width: 650px) {
                align-items: center;
                text-align: center;
                padding: 20px;
            }

            h1 {
                font-size: 35px;
                padding-bottom: 15px;

                @media screen and (max-width: 650px) {
                    font-size: 30px;
                }
            }

            p {
                font-size: 1.2rem;
                @media screen and (max-width: 650px) {
                    font-size: 1.2rem;
                }
            }

            button {
                margin-top: 30px;
                padding: 10px;
                border: 2px solid #234E70;
                border-radius: 5px;
                width: 100%;
                max-width: 200px;
                background-color: transparent;
                cursor: pointer;

                &:hover {
                    background-color: rgb(249, 247, 247);
                }
            }
        }
    }
}

.cards-container {
    background-color: #f1f0f0;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding-bottom: 50px;

    .main-cards-container {
        display: flex;
        width: 100%;
        max-width: 1600px;
        padding: 15px 20px;
        flex-direction: column;
    }

    .text {
        padding-top: 25px;
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 15px;

        h1 {
            font-size: 2rem;
        }

        h2 {
            font-size: 1.2rem;
            font-weight: 400;
        }
    }

    .cards {
        padding-top: 30px;
        padding-bottom: 30px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
        max-width: 1250px;
        width: 100%;
        margin: auto;

        .card {
            background-color: #fff;
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 20px 20px 35px;
            max-width: 400px;
            width: 100%;

            h1 {
                font-size: 30px;
            }

            p {
                font-size: 1.2rem;
                padding-right: 20px;
            }
        }
    }
}

</style>
