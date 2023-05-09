<template>
    <Line
        v-if="loaded"
        id="revenue-line-chart"
        :options="chartOptions"
        :data="chartData"
    />
</template>

<script>
import { Line } from "vue-chartjs";
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
} from "chart.js";
import annotationPlugin from "chartjs-plugin-annotation";

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
    annotationPlugin
);

export default {
    name: "RevenueLineChart",
    components: { Line },
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
                        text: "Tržby",
                        font: {
                            size: 22,
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = "";

                                if (context.parsed.y !== null) {
                                    label = new Intl.NumberFormat("sk-SK", {
                                        style: "currency",
                                        currency: "EUR",
                                        maximumFractionDigits: 0,
                                    }).format(context.parsed.y);
                                }

                                return label;
                            },
                        },
                    },
                    annotation: {
                        annotations: {
                            average: {
                                type: "line",
                                yMin: 60,
                                yMax: 60,
                                z: -10,
                                borderColor: "#ababab",
                                borderWidth: 2,
                                label: {
                                    display: false,
                                    content: "Priemerná hodnota",
                                },
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: "Rok",
                        },
                    },
                    y: {
                        display: true,
                        title: {
                            display: false,
                            text: "Eur",
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return new Intl.NumberFormat("sk-SK", {
                                    style: "currency",
                                    currency: "EUR",
                                    maximumFractionDigits: 0,
                                }).format(value);
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
        };
    },
    props: {
        data: {
            type: Object,
            required: true,
        },
    },
    mounted() {
        this.chartData = {
            labels: Object.values(this.data.labels),
            datasets: [
                {
                    label: "Tržby",
                    backgroundColor: "green",
                    data: Object.values(this.data.data),
                    tension: 0.3,
                    pointStyle: "circle",
                    pointRadius: 4,
                    pointHoverRadius: 8,
                    fill: true,
                    borderColor: "green",
                },
            ],
        };

        let average =
            this.chartData.datasets[0].data.reduce((a, b) => a + b, 0) /
            this.chartData.datasets[0].data.length;

        this.chartOptions.plugins.annotation.annotations.average.yMin = average;
        this.chartOptions.plugins.annotation.annotations.average.yMax = average;

        this.loaded = true;
    },
};
</script>
