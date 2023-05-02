<template>
    <div class="mb-40">
        <div class="flex-col lg:mt-16 flex items-center font-rubik w-full">
            <div class="w-4/5">
                <h1 class="text-4xl mb-10 font-extrabold"> Databázy </h1>
                <h3 class="text-xl font-bold mb-4 indent-8"> Filtrovanie v databáze</h3>
            </div>
        </div>
        <div class="flex flex-col items-center">
            <div class="flex-col flex w-3/4">
                <div v-if="mobile" class="lg:hidden bg-tables border p-0.5" @click="mobile = !mobile">
                    <i class="bi bi-chevron-down m-2"></i>
                    Show filters
                </div>
                <div v-else class="lg:hidden bg-tables border p-0.5" @click="mobile = !mobile">
                    <i class="bi bi-chevron-up mx-2"></i>
                    Hide filters
                </div>
                <transition>
                    <div v-if="mobile === false" class="border bg-tables flex lg:flex-row flex-col p-6">
                        <div class="lg:w-1/2 lg:grid flex flex-col w-full">
                            <input type="text" class="label placeholder-dark placeholder:font-rubik"
                                   placeholder="Meno / IČO firmy" v-model="name">
                            <span class="inline-grid lg:grid-cols-2 grid-cols-1">
                                <input class="label" type="number" placeholder="Zisk od" v-model="profit.min">
                                <input class="label" type="number" placeholder="Zisk do" v-model="profit.max">
                                <input class="label" type="number" placeholder="Tržby od" v-model="revenue.min">
                                <input class="label" type="number" placeholder="Tržby do" v-model="revenue.max">
                            </span>
                        </div>
                        <div class="lg:w-1/2 w-full flex flex-wrap content-end lg:justify-end justify-center">
                            <button class="w-3/5 bg-blue p-1.5 rounded text-white font-varela lg:h-1/3" @click="Search">
                                Hľadaj
                            </button>
                        </div>
                    </div>
                </transition>
                <table class="bg-tables border-x w-full font-varela mb-20">
                    <thead class="border-b bg-dark">
                        <tr>
                            <th class="border-r">
                                <h4 class="text-background">Názov</h4>
                            </th>
                            <th class="border-r">
                                <h4 class="text-background">Tržby</h4>
                            </th>
                            <th>
                                <h4 class="text-background">Zisk</h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody v-if="companies === null">
                        <!--          todo:urobit nech sa to hybe a nepulzuje-->
                        <tr v-for="item in Loading" class="animate-pulse">
                            <td class="border-x tab w-4/6">
                                <div class="p-3 m-2 bg-background rounded"></div>
                            </td>
                            <td class="w-1/6">
                                <div class="p-3 m-2 bg-background rounded"></div>
                            </td>
                            <td class="border-x tab w-1/6">
                                <div class="p-3 m-2 bg-background rounded"></div>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr v-for="item in companies.data">
                            <td class="border-r border-l tab w-4/6">
                                <router-link :to="{ name: 'company', params: { ico: item.ico } }" v-slot="{ redirect }">
                                    <h4 class="cursor-pointer w-fit" @click="redirect"> {{ item.name }} </h4>
                                </router-link>
                            </td>
                            <td class="border-r tab text-center w-1/6"> {{ item.latest_data.revenue }} €</td>
                            <td class="text-center border-r tab w-1/6"> {{ item.latest_data.profits }} €</td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="companies !== null" class="flex flex-row justify-center">
                    <div>
                        <button class="focused p-3 bg-tables rounded-tl-lg rounded-bl-lg border" @click="Search(page = 1)">
                            <i class="bi bi-chevron-double-left"></i>
                        </button>
                        <button class="focused p-3 bg-tables border-y" @click="Search(page--)">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <input type="number" :max="companies.meta.last_page" min="1" class="p-3 bg-tables text-center border" @keypress.enter="Search" v-model="page">
                        <button class="focused p-3 bg-tables border-y" @click="Search(page++)">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                        <button class="focused p-3 bg-tables rounded-tr-lg rounded-br-lg border" @click="Search(page = companies.meta.last_page)">
                            <i class="bi bi-chevron-double-right"></i>
                        </button>
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
            Loading: [[], [], [], [], [], [], [], [], [], [], [], [], [], [], []],
            per_page: 1,
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
        }
    },
    methods: {
        async Search() {
            if (this.page > this.companies.meta.last_page) {
                this.page = 1
            } else if (this.page < 1) {
                this.page = this.companies.meta.last_page
            }
            this.companies = null;
            try {
                await axios({
                    url: '/companies',
                    method: "get",
                    params: {
                        revenue_max: this.revenue.max,
                        revenue_min: this.revenue.min,
                        profits_max: this.profit.max,
                        profits_min: this.profit.min,
                        search_query: this.name,
                        per_page: this.per_page,
                        page: this.page
                    }
                }).then((response) => {
                    this.companies = response.data
                    console.log(this.companies)
                })
            } catch (errors) {
                console.log(errors)
            }
        }
    },
    async mounted() {
        window.addEventListener("resize", () => {
            if (window.innerWidth > 1024) {
                this.mobile = false
            } else {
                this.mobile = true
            }
        });
        try {
            await axios({
                url: '/companies',
                method: "get",
                params: {
                    per_page: 1
                }
            }).then((response) => {
                this.companies = response.data
                console.log(this.companies)
            })
        } catch (errors) {
            console.log(errors);
        }
    }
}
</script>
//TODO: ak je scoped, tak nemozeme odstranit @tailwind
<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {

    tr > th, tr > td {
        @apply border-y-background p-1.5
    }

    td, th {
        @apply p-1.5
    }

    .tab {
        @apply border-r-background border-l-background
    }

    .label {
        @apply m-1.5 p-1 bg-background rounded placeholder-dark placeholder-opacity-70 placeholder:font-rubik
    }

    .focused {
        @apply focus:bg-blue hover:bg-blue_light
    }

}
</style>
