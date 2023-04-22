<template>
    <Panel header="Jūsu pieteikumu statistika">
        <div class="apply-stats">
            <div class="stats-card">
                <div class="flex flex-column w-full">
                    <span style="color: #9E9E9E"
                          class="font-bold flex align-items-center heading"><p>Pieteikumu skaits</p> <i
                        class="pi pi-plus font-bold icon"></i></span>
                    <span class="card-number">20</span>
                    <span class="last-week"><span>10</span> pēdējās nedēļas laikā</span>
                </div>
            </div>
            <div class="stats-card">
                <div class="flex flex-column w-full">
                    <span style="color: #9E9E9E" class="font-bold flex align-items-center heading"><p>Pieteikumu skatījumi</p> <i
                        class="pi pi-search font-bold icon"></i></span>
                    <span class="card-number">0</span>
                    <span class="last-week"><span>0</span> pēdējās nedēļas laikā</span>
                </div>
            </div>
            <div class="stats-card">
                <div class="flex flex-column w-full">
                    <span style="color: #9E9E9E" class="font-bold flex align-items-center heading"><p>Noraidītie pieteikumi</p> <i
                        class="pi pi-ban font-bold icon"></i></span>
                    <span class="card-number">50</span>
                    <span class="last-week"><span>10</span> pēdējās nedēļas laikā</span>
                </div>
            </div>
        </div>
    </Panel>
</template>
<script setup>
import Panel from "primevue/panel";
</script>

<style lang="scss">
.apply-stats {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;

    .stats-card {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 15px;
        display: flex;
        max-width: 250px;
        width: 100%;

        .heading {
            display: flex;
            width: 100%;
            justify-content: space-between;

        }

        .icon {
            font-size: 16px;
            color: #fff;
            background-color: black;
            padding: 10px;
            border-radius: 50%;

        }

        .card-number {
            margin-top: 10px;
            font-weight: bold;
        }

        .last-week {
            margin-top: 15px;
            color: #9E9E9E;

            span {
                color: #234E70;
                font-weight: bold;
            }
        }
    }
}
</style>

