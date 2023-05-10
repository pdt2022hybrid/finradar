<template>
    <div class="chart-container">
        <Pie
            id="revenue-line-chart"
            class="w-full h-full"
            ref="pie"
            v-if="loaded"
            :data="chartData"
            :options="chartOptions"
        />
    </div>
    <div class="legend-container">
        <ul class="legend-list">
            <li
                v-for="(item, index) in data"
                :key="index"
                @click="toggleData(item, index)"
                class="legend-item"
                :class="{ 'legend-item-disabled': !item.enabled }"
            >
                <div class="legend-label-container">
                    <i
                        class="bi bi-square-fill legend-color"
                        :style="{ color: getLegendItemColor(item) }"
                    ></i>
                    <span
                        class="legend-label cursor-pointer"
                        :class="{ 'legend-label-disabled': !item.enabled }"
                    >
                        {{ item.label }}
                    </span>
                </div>
                <div class="legend-value">
                    {{ processNumberForLabel(item.value) }}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { Pie } from "vue-chartjs";
import { Chart as ChartJS, ArcElement, Title, Tooltip, Legend } from "chart.js";

ChartJS.register(Title, ArcElement, Tooltip, Legend);

export default {
    name: "AssetsPieChart",
    components: { Pie },
    data() {
        return {
            chartOptions: {
                locale: "sk-SK",
                responsive: true,
                interaction: {
                    mode: "index",
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: "Aktíva",
                        font: {
                            size: 22,
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = "";

                                if (context.parsed !== null) {
                                    label = new Intl.NumberFormat("sk-SK", {
                                        style: "currency",
                                        currency: "EUR",
                                        maximumFractionDigits: 0,
                                    }).format(context.parsed);
                                }

                                return label;
                            },
                        },
                    },
                },
            },
            chartData: {
                labels: [],
                datasets: {},
            },
            loaded: false,
            availableColors: [
                "#00876c",
                "#63b179",
                "#aed987",
                "#ffff9d",
                "#fcc267",
                "#ef8250",
                "#d43d51",
            ],
            disabledColor: "#D3D3D3",
        };
    },
    props: {
        data: {
            type: Array,
            required: true,
        },
    },
    methods: {
        toggleData(item, index) {
            item.enabled = !item.enabled;
            this.updateChart();
        },
        updateChart() {
            const chart = this.$refs.pie.chart;

            chart.data.datasets[0].data = this.data
                .filter((item) => item.enabled)
                .map((item) => item.value);

            chart.data.labels = this.data
                .filter((item) => item.enabled)
                .map((item) => item.label);

            chart.data.datasets[0].backgroundColor = this.data
                .filter((item) => item.enabled)
                .map((item) => item.color);

            chart.update();
        },
        processNumberForLabel(number) {
            return new Intl.NumberFormat("sk-SK", {
                style: "currency",
                currency: "EUR",
                maximumFractionDigits: 0,
            }).format(number);
        },
        getLegendItemColor(item) {
            if (item.enabled) {
                return item.color;
            } else {
                return this.disabledColor;
            }
        },
    },
    created() {
        this.data.map((item) => {
            item.enabled = true;
            item.color = this.availableColors.pop();
        });
        this.chartData = {
            labels: this.data.map((item) => item.label),
            datasets: [
                {
                    label: "Aktíva",
                    data: this.data.map((item) => item.value),
                    backgroundColor: this.data.map((item) => item.color),
                },
            ],
        };
        this.loaded = true;
    },
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    .chart-container {
        @apply w-full h-full;
    }

    .legend-container {
        @apply w-full my-5;
    }

    .legend-item:not(:last-child) {
        @apply border-b border-b-light;
    }

    .legend-label-container {
        @apply inline;
    }

    .legend-label-disabled {
        @apply line-through;
    }

    .legend-color {
        @apply mx-1;
    }

    .legend-value {
        @apply inline text-right float-right text-dark;
    }
}
</style>
