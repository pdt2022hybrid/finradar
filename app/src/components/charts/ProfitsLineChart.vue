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
            chartData: {
                labels: [],
                datasets: {},
            },
            loaded: false,
            greenColor: "#63b179",
            redColor: "rgba(212,61,81,0.49)",
            averageColor: "rgba(114,114,114,0.36)",
            mobile: false,
        };
    },
    props: {
        data: {
            type: Object,
            required: true,
        },
    },
    computed: {
        chartOptions() {
            return {
                locale: "sk-SK",
                responsive: true,
                interaction: {
                    mode: "index",
                },
                aspectRatio: this.mobile ? 1.1 : 2,
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
                                borderColor: this.averageColor,
                                borderWidth: 2,
                                borderDash: [10, 10],
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
                                borderDash: [5, 5],
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
            };
        },
    },
    methods: {
        resizeEventListener() {
            window.addEventListener("resize", () => {
                this.mobile = window.innerWidth <= 1024;
            });
        },
        determineIfMobile() {
            this.mobile = window.innerWidth <= 1024;
        },
    },
    mounted() {
        this.resizeEventListener();
        this.determineIfMobile();

        this.chartData = {
            labels: Object.values(this.data.labels),
            datasets: [
                {
                    label: "Zisky",
                    backgroundColor: (ctx) => {
                        return ctx.raw > 0 ? this.greenColor : this.redColor;
                    },
                    data: Object.values(this.data.data),
                    tension: 0.1,
                    pointStyle: "circle",
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    segment: {
                        borderColor: (ctx) => {
                            return ctx.p1.raw > 0
                                ? this.greenColor
                                : this.redColor;
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
