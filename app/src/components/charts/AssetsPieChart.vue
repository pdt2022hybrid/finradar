<template>
    <Pie
        v-if="loaded"
        id="revenue-line-chart"
        :options="chartOptions"
        :data="chartData"
    />
</template>

<script>
import { Pie } from "vue-chartjs";
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
                },
                // scales: {
                //     x: {
                //         display: true,
                //         title: {
                //             display: true,
                //             text: "Rok",
                //         },
                //     },
                //     y: {
                //         display: true,
                //         title: {
                //             display: false,
                //             text: "Eur",
                //         },
                //         ticks: {
                //             beginAtZero: true,
                //             callback: function (value, index, values) {
                //                 return new Intl.NumberFormat("sk-SK", {
                //                     style: "currency",
                //                     currency: "EUR",
                //                     maximumFractionDigits: 0,
                //                 }).format(value);
                //             },
                //         },
                //     },
                // },
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

        this.loaded = true;
    },
};
</script>
