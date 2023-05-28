<template>
    <div class="wrapper">
        <div class="homepageHeader bg-gradient-to-r from-background to-light">
            <h1 class="header-text">Vyhľadávanie v Databáze Firiem</h1>
            <div class="max-w-md mx-auto mt-12 mb-24">
                <div
                    class="relative flex items-center w-full h-12 rounded-lg shadow-dark shadow-sm bg-white overflow-hidden inputFocusWithin"
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
    <div class="mainContentText flex flex-col justify-center items-center">
        <h2>Čo sa dá na našej stránke robiť?</h2>
        <div class="w-1/2 mt-6 font-rubik">
            <ul style="list-style:outside">
              <div class="flex flex-col lg:w-10/12">
                <li class="lg:ml-64 w-64">Vyhľadávať v databáze firiem</li>
                <li class="lg:ml-64 w-64">Zobrazovať detailné štatistiky a údaje firiem</li>
                <li class="lg:ml-64 w-64">
                    Registrovaný používatelia majú taktiež možnosť "pinnúť" si
                    firmu do vlastného listu na vlastnom dashboarde
                </li>
              </div>
            </ul>
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
        @apply leading-8 text-xl text-dark font-normal lg:text-left mb-10 lg:px-24;
    }

    .mainContentText h2 {
        @apply text-center text-3xl font-rubik text-dark font-semibold;
    }
}
</style>
