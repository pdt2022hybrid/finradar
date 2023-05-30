<template>
    <div class="wrapper">
        <div class="homepageHeader bg-gradient-to-r from-background to-light">
            <h1 class="header-text">Vyhľadávanie v Databáze Firiem</h1>
            <div class="max-w-lg lg:mx-auto mt-12 mb-24">
                <div
                    class="relative flex items-center lg:w-full h-12 rounded-lg shadow-dark shadow-sm bg-white overflow-hidden inputFocusWithin lg:mx-0 mx-5"
                >
                    <div
                        class="grid place-items-center h-full w-12 text-gray-300"
                    >
                        <i class="bi bi-search scale-150 text-green"></i>
                    </div>
                    <input
                        class="peer h-full w-full outline-none text-sm text-gray-700 pr-2 placeholder:font-varela font-varela focus:placeholder:opacity-0"
                        type="text"
                        placeholder="Vyhľadať firmu..."
                        @keyup="Search"
                        v-model="name"
                    />
                </div>
            </div>

            <div
                class="flex justify-center"
                v-if="name !== '' && companies.length > 0"
            >
                <ul
                    class="w-64 bg-white rounded-sm mx-auto z-10 border-searchborder border-2 absolute top-96 mt-2"
                >
                    <li
                        v-for="item in companies"
                        class="border-light border-b-2 p-1.5"
                    >
                        <router-link
                            :to="{ name: 'company', params: { ico: item.ico } }"
                            v-slot="{ redirect }"
                        >
                            <h4
                                class="cursor-pointer lg:w-fit mx-auto font-varela font-medium hover:font-semibold hover:decoration-1 hover:underline decoration-underline active:text-green"
                                @click="redirect"
                            >
                                {{ item.name }}
                            </h4>
                        </router-link>
                    </li>
                </ul>
            </div>

            <div class="overflow-hidden flex place-content-center">
                <img
                    src="../assets/images/HomepageImage.svg"
                    alt=""
                    class="w-full min-w-md"
                />
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 py-12">
            <div class="mainContentText">
                <h2 class="pb-6">Vitajte na stránke FinRadar!</h2>
                <p class="px-8 lg:px-0 text-center">
                    Sme váš zdroj pre aktuálne finančné štatistiky a poznatky!
                    FinRadar ako online platforma poskytuje komplexné a
                    spoľahlivé informácie o rôznych finančných ukazovateľoch a
                    analýze údajov. Bez ohľadu na to, či ste investor, obchodný
                    profesionál alebo len záujemca o finančný svet, FinRadar je
                    váš zdroj pre všetko súvisiace s finančnými štatistikami.
                </p>
            </div>
            <div class="mainContentText">
                <h2 class="pb-6">Užívateľsky prívetivé rozhranie</h2>
                <p class="px-8 lg:px-0 text-center">
                    FinRadar vám poskytuje všetko, čo potrebujete. Od
                    interaktívnych grafov až po nekonečné databázy informácií.
                    Vo FinRadare sa snažíme posilniť našich používateľov
                    vedomosťami a nástrojmi, ktoré potrebujú na úspech v
                    komplexnom svete financií. Pripojte sa k nám na tejto
                    finančnej ceste s FinRadarom, najlepším zdrojom pre
                    spoľahlivé finančné štatistiky a poznatky.
                </p>
            </div>
        </div>
    </div>
    <!--
    <div class="mainContentText flex flex-col justify-center items-center mb-20">
        <h2>Čo sa dá na našej stránke robiť?</h2>
        <div class="w-1/2 mt-6 font-rubik">
            <ul style="text-align: center;">
                <li class="lg:w-full w-64">Vyhľadávať v databáze firiem,</li>
                <li class="lg:w-full w-64">Zobrazovať detailné štatistiky a údaje firiem,</li>
                <li class="lg:w-full w-64">
                    Registrovaný používatelia majú taktiež možnosť pripnúť si
                    firmu do vlastného listu na vlastnom dashboarde
                </li>
            </ul>
        </div>
    </div>
    -->
    <div class="mainContentText">
        <h2 class="mb-10">Čo sa dá na našej stránke robiť?</h2>

        <div class="grid lg:grid-cols-3 flex">

            <div class="card">
                <img src="../assets/images/Card1.svg" alt="" class="w-20 mb-2">
                <h3 class="font-bold text-2xl mb-3">Vyhľadávanie</h3>
                <p class="text-lg text-center">Vyhľadávajte v našej databáze firiem</p>
            </div>

            <div class="card">
                <img src="../assets/images/Card2.svg" alt="" class="w-20 mb-2">
                <h3 class="font-bold text-2xl mb-3">Štatistiky</h3>
                <p class="text-lg text-center">Prehľadávajte detailné štatistiky a údaje firiem</p>
            </div>

            <div class="card">
                <img src="../assets/images/Card3.svg" alt="" class="w-20 mb-2">
                <h3 class="font-bold text-2xl mb-3">Dashboard</h3>
                <p class="text-lg text-center">Registrujte sa a pripnite si
                    firmu do vlastného listu na vlastnom dashboarde</p>
            </div>
        
        </div>

    </div>


</template>

<script>
import axios from "axios";

export default {
    name: "HomePage",
    data() {
        return {
            name: null,
            companies: [],
        };
    },
    methods: {
        async Search() {
            if (this.name !== "" && this.name.length > 2) {
                try {
                    await axios({
                        url: "/companies/search",
                        method: "get",
                        params: {
                            query: this.name,
                            per_page: 10,
                        },
                    }).then((response) => {
                        console.log(response);
                        this.companies = response.data.data;
                    });
                } catch (errors) {
                    console.log(errors);
                }
            } else {
                this.companies = [];
            }
        },
    },
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    p {
        @apply sm:px-14 md:px-6 text-justify;
    }

    .wrapper {
        @apply lg:min-h-screen bg-background;
    }

    .homepageHeader {
        @apply lg:items-center text-center w-full pt-44;
    }

    .header-text {
        @apply lg:block font-rubik font-bold text-dark text-5xl mx-5;
    }

    .mainContentText {
        @apply leading-8 text-xl text-dark font-normal lg:text-left mb-14 lg:px-24;
    }

    .mainContentText h2 {
        @apply text-center text-3xl font-rubik text-dark font-semibold;
    }

    .card{
        @apply bg-gray flex flex-col items-center rounded-lg mx-10 lg:mb-0 mb-10 p-4
    }
}
</style>
