<template>
    <div class="sm:mx-5 flex flex-col items-center lg:py-10 py-20">
        <h1 class="text-3xl mt-2 mb-7 self-start ml-28">{{ Data?.name }}</h1>
        <div
            class="border-2 rounded-lg bg-tables lg:grid-cols-3 grid-cols-1 grid lg:w-5/6"
        >
            <div class="box lg:border-r-2 lg:row-span-3">
                <div class="value-wrapper-div">
                    <div class="value-description-div">
                        <p class="value-description">ICO</p>
                    </div>
                    <div class="value-div">
                        <p class="value">{{ Data?.ico }}</p>
                    </div>
                </div>
                <div class="value-wrapper-div">
                    <div class="value-description-div">
                        <p class="value-description">Vznik</p>
                    </div>
                    <p class="value">{{ Data?.date_of_establishment }}</p>
                </div>
                <div class="value-wrapper-div columns-2">
                    <div class="value-description-div">
                        <p class="value-description">Sídlo</p>
                    </div>
                    <div class="value-div">
                        <p class="value">
                            {{ Data?.address?.city }}
                            {{ Data?.address?.street }}
                        </p>
                    </div>
                </div>
                <div class="value-wrapper-div">
                    <div class="value-description-div">
                        <p
                            v-if="Data?.directors?.length === 1"
                            class="value-description"
                        >
                            Konateľ
                        </p>
                        <p v-else class="value-description">Konatelia</p>
                    </div>
                    <div class="value-div">
                        <p class="value" v-if="!Data?.directors?.lenght > 0">
                            Nie je dostupné
                        </p>
                        <ul>
                            <li
                                class="value"
                                v-for="director in Data?.directors"
                            >
                                {{ director?.name }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="value-wrapper-div">
                    <div class="value-description-div">
                        <p class="value-description">Počet Zamestnancov</p>
                    </div>
                    <div class="value-div">
                        <p class="value">Nie je dostupné</p>
                    </div>
                </div>
            </div>
            <div class="box z-0 lg:col-span-2 lg:border-background lg:border-b">
                <h2>Tržby</h2>
                <line-chart
                    download="true"
                    suffix="€"
                    thousands=" "
                    :library="{
                        curveType: 'function',
                        backgroundColor: '#EFEFEF',
                        hAxis: { title: 'Rok' },
                        vAxis: { title: 'Hodnota (€)' },
                    }"
                    :min="null"
                    :max="null"
                    :data="Data?.graph_data?.revenue"
                >
                </line-chart>
            </div>
            <div class="box z-0 lg:col-span-2 lg:border-b">
                <h2>Zisky</h2>
                <line-chart
                    download="true"
                    suffix="€"
                    thousands=" "
                    :library="{
                        curveType: 'function',
                        backgroundColor: '#EFEFEF',
                        hAxis: { title: 'Rok' },
                        vAxis: {
                            title: 'Hodnota (€)',
                        },
                        series: {
                            0: {
                                color: 'blue',
                            },
                            1: {
                                color: 'red',
                            },
                        },
                    }"
                    :min="null"
                    :data="Data?.graph_data?.profits"
                >
                </line-chart>
            </div>
            <!--            <div class="box border-r-2">stuff here</div>-->
            <div class="box">
                <h2>Aktíva</h2>
                <pie-chart
                    suffix="€"
                    legend="bottom"
                    thousands=" "
                    :library="{
                        is3D: true,
                        legend: 'none',
                        backgroundColor: '#EFEFEF',
                        colors: [
                            '#3a0ca3',
                            '#3f37c9',
                            '#4361ee',
                            '#4895ef',
                            '#4cc9f0',
                        ],
                    }"
                    :data="[
                        [
                            'Financial accounts',
                            Data?.latest_report?.assets
                                ?.financial_accounts_total,
                        ],
                        [
                            'Financial assets',
                            Data?.latest_report?.assets
                                ?.lt_financial_assets_total,
                        ],
                        [
                            'Intangible assets',
                            Data?.latest_report?.assets
                                ?.lt_intangible_assets_total,
                        ],
                        [
                            'Tangible assets',
                            Data?.latest_report?.assets
                                ?.lt_tangible_assets_total,
                        ],
                        [
                            'Recievables total',
                            Data?.latest_report?.assets?.st_receivables_total,
                        ],
                    ]"
                ></pie-chart>
                <GoogleCharts :data="dataTable" :options="options" />
                <div class="flex flex-col grid grid-cols-2 text-center legend">
                    <div class="flex leg">
                        <h4 class="leg text-white bg-blue rounded"></h4>
                        <h4 class="leg">Financial accounts</h4>
                    </div>
                    <div class="flex leg">
                        <h4 class="leg text-white bg-red rounded"></h4>
                        <h4 class="leg">Financial assets</h4>
                    </div>
                    <div class="flex leg">
                        <h4 class="leg text-white bg-yell rounded"></h4>
                        <h4 class="leg">Intangible assets</h4>
                    </div>
                    <div class="flex leg">
                        <h4 class="leg text-white bg-green rounded"></h4>
                        <h4 class="leg">Tangible assets</h4>
                    </div>
                    <div class="flex leg">
                        <h4 class="leg text-white bg-purp rounded"></h4>
                        <h4 class="leg">Receivables total</h4>
                    </div>
                </div>
            </div>
            <div class="box">
                <h2>Pasíva</h2>
                <pie-chart
                    suffix="€"
                    legend="bottom"
                    thousands=" "
                    :library="{
                        is3D: true,
                        legend: 'none',
                        backgroundColor: '#EFEFEF',
                    }"
                    :data="[
                        [
                            'Bank loans',
                            Data?.latest_report?.liabilities?.bank_loans,
                        ],
                        [
                            'Base capital',
                            Data?.latest_report?.liabilities?.base_capital,
                        ],
                        [
                            'Profit after tax',
                            Data?.latest_report?.liabilities
                                ?.profit_for_period_after_tax,
                        ],
                        [
                            'Reserves',
                            Data?.latest_report?.liabilities?.reserves,
                        ],
                        [
                            'LY result',
                            Data?.latest_report?.liabilities?.result_last_year,
                        ],
                        [
                            'Liabilities',
                            Data?.latest_report?.liabilities?.st_labilities,
                        ],
                    ]"
                ></pie-chart>
                <div class="flex flex-col grid grid-cols-2 text-center mb-6">
                    <div class="flex">
                        <h4 class="leg text-white bg-blue rounded"></h4>
                        <h4 class="leg">Bank loans</h4>
                    </div>
                    <div class="flex">
                        <h4 class="leg text-white bg-red rounded"></h4>
                        <h4 class="leg">Base capital</h4>
                    </div>
                    <div class="flex">
                        <h4 class="leg text-white bg-yell rounded"></h4>
                        <h4 class="leg">Profit after tax</h4>
                    </div>
                    <div class="flex">
                        <h4 class="leg text-white bg-purp rounded"></h4>
                        <h4 class="leg">LY result</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            Data: [],
        };
    },
    name: "CompanyPage",
    async mounted() {
        try {
            let ico = this.$route.params.ico;
            console.log(ico);
            await axios.get("/companies/" + ico).then((response) => {
                console.log(response);
                this.Data = response.data.data;
                console.log(this.Data); // toto odstranit potom
            });
        } catch (errors) {
            console.log(errors);
        }
    },
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    h1 {
        @apply text-lg;
    }

    h2 {
        @apply text-dark text-lg;
    }

    li {
        @apply text-dark text-sm text-center;
    }

    .leg {
        @apply text-sm pr-2 pl-2 mb-1 mr-2 h-4;
    }

    .value-wrapper-div {
        @apply border-b flex place-content-between py-2 border-b-navtext w-full;
    }

    .value-description-div {
        @apply flex flex-col justify-center w-1/2;
    }

    .value-description {
        @apply text-dark text-lg items-start text-start font-rubik;
    }

    .value-div {
        @apply flex flex-col justify-center w-1/2;
    }

    .value {
        @apply text-dark opacity-70 items-end text-end;
    }

    .box {
        @apply flex flex-col items-start px-6 py-2;
    }
}
</style>
