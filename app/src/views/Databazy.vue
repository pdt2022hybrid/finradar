<template>
    <div class="mb-40">
        <div class="flex-col lg:mt-16 flex items-center font-rubik w-full">
            <div class="w-4/5">
                <h1 class="text-4xl mb-10 font-extrabold">Databázy</h1>
                <h3 class="text-xl font-bold mb-4">Filtrovanie v databáze</h3>
            </div>
            <div class="flex flex-col items-center w-4/5">
                <div class="flex-col flex w-full">
                    <div
                        v-if="!show_filters"
                        class="lg:hidden bg-gray p-0.5 rounded-lg"
                        @click="show_filters = !show_filters"
                    >
                        <i class="bi bi-chevron-down m-2"></i>
                        Show filters
                    </div>
                    <div
                        v-else
                        class="lg:hidden bg-gray p-0.5 rounded-t-lg"
                        @click="show_filters = !show_filters"
                    >
                        <i class="bi bi-chevron-up mx-2"></i>
                        Hide filters
                    </div>
                    <transition>
                        <div
                            v-if="show_filters"
                            class="bg-gray flex lg:flex-row flex-col p-6 rounded-b-lg"
                            :class="{ 'rounded-t-lg': !mobile }"
                        >
                            <div class="lg:w-1/2 lg:grid flex flex-col w-full">
                                <input
                                    type="text"
                                    class="label placeholder-dark placeholder:font-rubik"
                                    placeholder="Meno / IČO firmy"
                                    v-model="name"
                                />
                                <span
                                    class="inline-grid lg:grid-cols-2 grid-cols-1"
                                >
                                    <input
                                        class="label"
                                        type="number"
                                        placeholder="Zisk od"
                                        v-model="profit.min"
                                    />
                                    <input
                                        class="label"
                                        type="number"
                                        placeholder="Zisk do"
                                        v-model="profit.max"
                                    />
                                    <input
                                        class="label"
                                        type="number"
                                        placeholder="Tržby od"
                                        v-model="revenue.min"
                                    />
                                    <input
                                        class="label"
                                        type="number"
                                        placeholder="Tržby do"
                                        v-model="revenue.max"
                                    />
                                </span>
                            </div>
                            <div
                                class="lg:w-1/2 w-full flex flex-wrap content-end lg:justify-end justify-center"
                            >
                                <button
                                    class="w-3/5 bg-green p-1.5 rounded text-dark hover:border-2 hover:font-semibold active: font-varela lg:h-1/3"
                                    @click="search"
                                >
                                    Hľadaj
                                </button>
                            </div>
                        </div>
                    </transition>
                    <table
                        class="bg-gray w-full font-varela mt-5 mb-4 lg:mt-16 rounded-lg"
                    >
                        <thead class="bg-dark rounded-t-lg border-green">
                            <tr class="">
                                <th class="rounded-tl-xl">
                                    <h4 class="text-background text-left pl-1">
                                        Názov
                                    </h4>
                                </th>
                                <th class="">
                                    <h4 class="text-background">Tržby</h4>
                                </th>
                                <th class="rounded-tr-lg">
                                    <h4 class="text-background">Zisk</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody v-if="companies === null">
                            <!--          todo:urobit nech sa to hybe a nepulzuje-->
                            <tr v-for="item in loading" class="animate-pulse">
                                <td class="border-l border-b border-light tab tab w-4/6">
                                    <div
                                        class="p-2.5 m-1 bg-background rounded"
                                    ></div>
                                </td>
                                <td class="border-l border-b border-light tab w-1/6">
                                    <div
                                        class="p-2.5 m-1 bg-background rounded"
                                    ></div>
                                </td>
                                <td class="tab border-l border-b border-light tab w-1/6">
                                    <div
                                        class="p-2.5 m-1 bg-background rounded"
                                    ></div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr v-for="item in companies.data">
                                <td class="tab lg:w-4/6 w-3/6 lg:text-md border-b border-light">
                                    <router-link
                                        :to="{
                                            name: 'company',
                                            params: { ico: item.ico },
                                        }"
                                        v-slot="{ redirect }"
                                    >
                                        <h4
                                            class="cursor-pointer w-fit pl-1"
                                            @click="redirect"
                                        >
                                            {{ item.name }}
                                        </h4>
                                    </router-link>
                                </td>
                                <td
                                    class="text-center border-l border-b lg:text-md border-light tab lg:w-2/12 w-3/12"
                                >
                                    {{ item.latest_data.revenue }} €
                                </td>
                                <td
                                    class="text-center border-l border-b lg:text-md border-light tab lg:w-2/12 w-3/12"
                                >
                                    {{ item.latest_data.profits }} €
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div
                        v-if="companies !== null"
                        class="flex flex-row justify-center"
                    >
                        <div>
                            <button
                                class="focused p-3 bg-gray rounded-tl-lg rounded-bl-lg"
                                @click="search((page = 1))"
                            >
                                <i class="bi bi-chevron-double-left"></i>
                            </button>
                            <button
                                class="focused p-3 bg-gray"
                                @click="search(page--)"
                            >
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <input
                                type="number"
                                :max="companies.meta.last_page"
                                min="1"
                                class="p-3 bg-gray text-center"
                                @keypress.enter="search"
                                v-model="page"
                            />
                            <button
                                class="focused p-3 bg-gray"
                                @click="search(page++)"
                            >
                                <i class="bi bi-chevron-right"></i>
                            </button>
                            <button
                                class="focused p-3 bg-gray rounded-tr-lg rounded-br-lg"
                                @click="
                                    search((page = companies.meta.last_page))
                                "
                            >
                                <i class="bi bi-chevron-double-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Databazy",
    data() {
        return {
            mobile: false,
            companies: null,
            per_page: 10,
            revenue: {
                max: null,
                min: null,
            },
            profit: {
                max: null,
                min: null,
            },
            name: null,
            page: 1,
            show_filters: true,
        };
    },
    computed: {
        loading() {
            return Array.from({ length: this.per_page }, () => []);
        },
    },
    methods: {
        async search() {
            if (this.page > this.companies?.meta?.last_page) {
                this.page = 1;
            } else if (this.page < 1) {
                this.page = this.companies?.meta?.last_page;
            }
            this.companies = null;
            try {
                await axios({
                    url: "/companies",
                    method: "get",
                    params: {
                        revenue_max: this.revenue.max,
                        revenue_min: this.revenue.min,
                        profits_max: this.profit.max,
                        profits_min: this.profit.min,
                        search_query: this.name,
                        per_page: this.per_page,
                        page: this.page,
                    },
                }).then((response) => {
                    this.companies = response.data;
                    console.log(this.companies);
                });
            } catch (errors) {
                console.log(errors);
            }
        },
    },
    async mounted() {
        window.addEventListener("resize", () => {
            if (window.innerWidth > 1024) {
                this.mobile = false;
            } else {
                this.mobile = true;
            }
        });

        await this.search();

        this.show_filters = !this.mobile;
    },
};
</script>
//TODO: ak je scoped, tak nemozeme odstranit @tailwind
<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    tr > th,
    tr > td {
        @apply p-1.5;
    }

    td,
    th {
        @apply p-1.5;
    }

    .label {
        @apply m-1.5 p-1 bg-background rounded placeholder-dark placeholder-opacity-70 placeholder:font-rubik;
    }

    .focused {
        @apply focus:bg-blue hover:bg-blue_light;
    }
}
</style>
