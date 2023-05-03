<template>
    <li class="listing">
        <img src="https://www.printful.com/static/images/layout/printful-logo.png"/>
        <div class="listing-info">
            <h1>{{ listingInfo.title }}</h1>
            <div class="small-info">
                <h2>{{generalHelper.formatEmploymentType(listingInfo.related_listing.employment_type)}}</h2>
            </div>
            <h2>{{ generalHelper.formatDatePosted(listingInfo.date_posted) }}</h2>
        </div>
    </li>
</template>
<script setup>
import generalHelper from "../../../../helpers/general-helper";

const props = defineProps({
    listingInfo: Object
})

</script>
<style lang="scss">

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
        max-width: 80px;
        width: 100%;
        max-height: 80px;
        height: 100%;
        margin-right: 30px;
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
                    padding-bottom: 10px;
                }
            }

            h2 {
                font-size: 1.2rem - 0.1rem;
                font-weight: 400;
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

</style>
