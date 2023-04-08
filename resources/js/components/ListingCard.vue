<template>
    <div class="listings">
        <ul>
            <li class="listing">
                <img src="https://www.printful.com/static/images/layout/printful-logo.png"/>
                <div class="listing-info">
                    <h1>Software Tester</h1>
                    <div class="small-info">
                        <h2>uzņēmums - Printful</h2>
                        <h2>Klātienē</h2>
                        <h2>Rīga</h2>
                        <h2>Pilna-laika</h2>
                    </div>
                    <h2>Publicēts pirms 7 dienām</h2>
                    <span class="salary">1500 €</span>
                </div>
            </li>
        </ul>
    </div>
</template>
<script setup></script>
<style lang="scss">

.listings {
    width: 100%;
    display: flex;
    flex-direction: column;
    box-shadow: rgba(0, 0, 0, 0.16) 0 1px 4px;

    .listing {
        border-bottom: 1px solid #e1e6eb;
        list-style-type: none;
        padding: 24px 16px;
        display: flex;
        align-items: center;

        @media screen and (max-width: 850px) {
            flex-direction: column;
            align-items: flex-start;
            padding-bottom: 40px;

            img {
                margin-bottom: 15px;
            }
        }

        &:hover {
            background-color: #eceeed;
            cursor: pointer;
        }

        img {
            max-width: 120px;
            width: 100%;
            max-height: 120px;
            height: 100%;
            margin-right: 15px;
        }

        .listing-info {
            display: flex;
            gap: 12px;
            flex-direction: column;

            h1 {
                font-size: 1.2rem+0.5rem;


            }

            .small-info {
                display: flex;
                gap: 10px;

                @media screen and (max-width: 700px) {
                    flex-direction: column;

                    h2 {
                        border-right: none !important;
                        border-bottom: 1px solid black;
                        padding-bottom: 10px;
                    }
                }

                h2 {
                    font-size: 1.2rem - 0.1rem;
                    font-weight: 400;
                    border-right: 1px solid black;
                    padding-right: 10px;
                }
            }

            h2 {
                font-size: 1.2rem - 0.3rem;
                font-weight: 400;
            }

            .salary {
                padding: 5px;
                background-color: #1C1C1C;
                max-width: 150px;
                font-size: 1.2rem;
                text-align: center;
                border-radius: 5px;
                color: #fff;
            }
        }
    }
}
</style>
