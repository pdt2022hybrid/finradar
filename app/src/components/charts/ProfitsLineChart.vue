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

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
);

export default {
    name: "ProfitsLineChart",
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
                        text: "Zisky",
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
                                yMin: undefined,
                                yMax: undefined,
                                borderColor: "#ababab",
                                borderWidth: 2,
                                label: {
                                    display: false,
                                    content: "Priemerná hodnota",
                                },
                            },
                            loss: {
                                type: "line",
                                yMin: 0,
                                yMax: 0,
                                borderColor: "red",
                                borderWidth: 2,
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
                    label: "Zisky",
                    backgroundColor: (ctx) => {
                        return ctx.raw > 0 ? "green" : "red";
                    },
                    data: Object.values(this.data.data),
                    tension: 0.3,
                    pointStyle: "circle",
                    pointRadius: 4,
                    pointHoverRadius: 8,
                    fill: true,
                    segment: {
                        borderColor: (ctx) => {
                            return ctx.p1.raw > 0 ? "green" : "red";
                        },
                    },
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
