<template>
    <div class="mb-20">
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
                                    class="label placeholder-dark placeholder:font-rubik inputFocus"
                                    placeholder="Meno / IČO firmy"
                                    v-model="name"
                                />
                                <span
                                    class="inline-grid lg:grid-cols-2 grid-cols-1"
                                >
                                    <input
                                        class="label inputFocus"
                                        type="number"
                                        placeholder="Zisk od"
                                        v-model="profit.min"
                                    />
                                    <input
                                        class="label inputFocus"
                                        type="number"
                                        placeholder="Zisk do"
                                        v-model="profit.max"
                                    />
                                    <input
                                        class="label inputFocus"
                                        type="number"
                                        placeholder="Tržby od"
                                        v-model="revenue.min"
                                    />
                                    <input
                                        class="label inputFocus"
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
                                    class="w-3/5 bg-green p-1.5 rounded text-white hover:border-2 hover:font-semibold active: font-varela lg:h-1/3"
                                    @click="search"
                                >
                                    Hľadaj
                                </button>
                            </div>
                        </div>
                    </transition>
                </div>
                <Table
                    :per_page="per_page"
                    :page="page"
                    :companies="companies"
                    @search="search"
                    @setPage="page"
                    @firstPage="search((page = 1))"
                    @nextPage="search(page++)"
                    @prevPage="search(page--)"
                    @lastPage="search((page = companies.meta.last_page))"
                />
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Table from "@/components/Table.vue";

export default {
    name: "Databazy",
    components: {Table},
    data() {
        return {
            mobile: false,
            companies: null,
            per_page: 20,
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
    .label {
        @apply m-1.5 p-1 bg-background rounded placeholder-dark placeholder-opacity-70 placeholder:font-rubik;
    }
}
</style>
