<template>
    <Loader v-if="!loaded" />
    <div v-else class="sm:py-5 flex flex-col items-center lg:py-10 py-20">
        <div class="w-4/5">
            <div class="flex">
                <h1
                    class="text-3xl mt-12 sm:mt-28 md:mt-2 lg:mt-2 mb-7 lg:text-start text-center"
                >
                    {{ companyData?.name }}
                </h1>
                <i
                    v-if="logged === true"
                    @click="togglePinCompany"
                    class="bi bi-pin-angle-fill text-3xl ml-4 lg:mt-1 mt-11 pl-2 hover:cursor-pointer hover:text-green"
                    :class="{
                        textGreen: companyData.pinned
                    }"
                >
                </i>
            </div>
        </div>
        <div class="lg:w-4/5 w-full">
            <div
                class="bg-gray lg:rounded-lg lg:grid-cols-3 grid-cols-1 grid w-full"
            >
                <div class="box lg:border-r-light border-r-2 lg:row-span-3">
                    <div class="value-wrapper-div">
                        <div class="value-description-div">
                            <p class="value-description">IČO</p>
                        </div>
                        <div class="value-div">
                            <p class="value">{{ companyData?.ico }}</p>
                        </div>
                    </div>
                    <div class="value-wrapper-div">
                        <div class="value-description-div">
                            <p class="value-description">Vznik</p>
                        </div>
                        <div class="value-div">
                            <p class="value">
                                {{ companyData?.date_of_establishment }}
                            </p>
                        </div>
                    </div>
                    <div class="value-wrapper-div columns-2">
                        <div class="value-description-div">
                            <p class="value-description">Sídlo</p>
                        </div>
                        <div class="value-div">
                            <p class="value">
                                {{ companyData?.address?.city }}
                                {{ companyData?.address?.street }}
                            </p>
                        </div>
                    </div>
                    <div class="value-wrapper-div">
                        <div class="value-description-div">
                            <p
                                v-if="companyData?.directors?.length === 1"
                                class="value-description"
                            >
                                Konateľ
                            </p>
                            <p v-else class="value-description">Konatelia</p>
                        </div>
                        <div class="value-div">
                            <p
                                class="value"
                                v-if="!companyData?.directors?.length > 0"
                            >
                                Nie je dostupné
                            </p>
                            <ul>
                                <li
                                    class="value"
                                    v-for="director in companyData?.directors"
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
                <div class="box z-0 lg:col-span-2 lg:border-light lg:border-b">
                    <RevenueLineChart
                        v-if="loaded"
                        :data="companyData?.graph_data?.revenue"
                    />
                </div>
                <div class="box z-0 lg:col-span-2 lg:border-light lg:border-b">
                    <ProfitsLineChart
                        v-if="loaded"
                        :data="companyData?.graph_data?.profits"
                    />
                </div>
                <!--            <div class="box border-r-2">stuff here</div>-->
                <div class="box z-0">
                    <AssetsPieChart
                        v-if="loaded"
                        :data="companyData?.graph_data?.assets"
                    />
                </div>
                <div class="box z-0">
                    <LiabilitiesPieChart
                        v-if="loaded"
                        :data="companyData?.graph_data?.liabilities"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import RevenueLineChart from "@/components/charts/RevenueLineChart.vue";
import ProfitsLineChart from "@/components/charts/ProfitsLineChart.vue";
import AssetsPieChart from "@/components/charts/AssetsPieChart.vue";
import LiabilitiesPieChart from "@/components/charts/LiabilitiesPieChart.vue";
import Loader from "@/components/Loader.vue";
import { useUserInfo } from "@/stores/userData";

export default {
    name: "CompanyPage",
    components: {
        LiabilitiesPieChart,
        Loader,
        RevenueLineChart,
        ProfitsLineChart,
        AssetsPieChart,
    },
    data() {
        const store = useUserInfo();
        return {
            store: useUserInfo(),
            loaded: false,
            companyData: [],
            logged: store.getLoggedIn,
        };
    },

    watch: {
        $route(to, from) {
            this.changeRouter();
        },
    },

    methods: {
        async changeRouter() {
            this.loaded = false
            try {
                let ico = this.$route.params.ico;
                await axios
                    .get("/companies/" + ico, {
                        headers: {
                            Authorization: "Bearer" + this.store.getUserToken,
                        },
                    })
                    .then((response) => {
                        this.companyData = response.data.data;
                        console.log(this.companyData)
                    })
            } catch (errors) {
                console.log(errors);
            }
            this.loaded = true;
        },
        togglePinCompany() {
            if (this.companyData.pinned === false) {
                this.store.pinCompany(this.companyData.ico)
                this.companyData.pinned = true
            } else {
                this.store.unpinCompany(this.companyData.ico)
                this.companyData.pinned = false
            }
        },
    },
    mounted() {
        this.changeRouter();
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
        @apply border-b flex place-content-between py-2 border-b-light w-full;
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
    .textGreen {
        @apply text-green
    }
}
</style>
