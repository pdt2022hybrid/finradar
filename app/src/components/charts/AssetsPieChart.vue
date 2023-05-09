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
                @click="toggleData(index)"
                class="legend-item"
            >
                <div class="legend-label-container">
                    <span
                        class="legend-color"
                        :style="{ backgroundColor: item.color }"
                    >
                    </span>
                    <span class="legend-label">
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
                        position: "bottom",
                        labels: {
                            font: {
                                size: 14,
                            },
                        },
                        align: "start",
                    },
                    title: {
                        display: true,
                        text: "Zisky",
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
                "#001f3f",
                "#006400",
                "#DC143C",
                "#A9A9A9",
                "#4169E1",
                "#228B22",
                "#800000",
                "#708090",
                "#A0522D",
                "#00BFFF",
            ],
        };
    },
    props: {
        data: {
            type: Array,
            required: true,
        },
    },
    methods: {
        toggleData() {},
        enableData() {},
        disableData() {},
        removeDataset(index) {
            let chart = this.$refs.pie.chart;
            chart.data.labels.splice(-1, 1); // remove the label first

            // ide
            //chart.data.datasets[0].data = [100, 200, 300];

            //nejde
            // chart.data.datasets[0].data.splice(index, 1);

            //ide
            // const dataRef = toRef(chart.data.datasets[0], "data");
            // dataRef.value = dataRef.value.filter((_, i) => i !== index);

            //ide
            // chart.data.datasets[0].data = chart.data.datasets[0].data.filter(
            //     (_, i) => i !== index
            // );

            chart.data.datasets[0].data = chart.data.datasets[0].data.filter(
                function (value, i) {
                    return i !== index;
                }
            );

            //simpler version - ide
            // Get the first dataset in the chart's data object
            // const dataset = chart.data.datasets[0];

            // Get the data array for that dataset
            // let data = dataset.data;

            // Filter the data array to exclude the element at the specified index
            // data = data.filter((_, i) => i !== index);

            // Assign the filtered data array back to the dataset's data property
            // dataset.data = data;

            chart.update();
        },
        processNumberForLabel(number) {
            return new Intl.NumberFormat("sk-SK", {
                style: "currency",
                currency: "EUR",
                maximumFractionDigits: 0,
            }).format(number);
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
        @apply w-full;
    }

    .legend-label-container {
        @apply inline;
    }

    .legend-value {
        @apply inline text-right float-right;
    }
}
</style>
