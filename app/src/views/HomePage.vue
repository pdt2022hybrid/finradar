<template>
    <div class="wrapper">
        <div class="homepageHeader bg-gradient-to-r from-background to-light">
            <h1 class="header-text">Vyhľadávanie v Databáze Firiem</h1>
            <div class="max-w-md mx-auto mt-12 mb-24">
                <div
                    class="relative flex items-center w-full h-12 rounded-lg shadow-dark shadow-sm bg-white overflow-hidden inputFocusWithin"
                >
                    <div
                        class="grid place-items-center h-full w-12 text-gray-300">

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


            <div class="flex justify-center" v-if="name !== '' && companies.length > 0">
                <ul
                    class="absolute w-64 bg-white rounded-sm mx-auto z-10 border-searchborder border-2 absolute top-96 mt-2"
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
				<img src="../assets/images/HomepageImage.svg" alt="" class="w-full min-w-md">
			</div>

        </div>
        <ul class="homepageMainContent">
            <li class="mainContentText">
                <h2 class="pb-6">Vitajte na stránke FinRadar!</h2>
                <p>
                    Sme váš zdroj pre aktuálne finančné štatistiky a poznatky!
                    FinRadar ako online platforma poskytuje komplexné a
                    spoľahlivé informácie o rôznych finančných ukazovateľoch a
                    analýze údajov. Bez ohľadu na to, či ste investor, obchodný
                    profesionál alebo len záujemca o finančný svet, FinRadar je
                    váš zdroj pre všetko súvisiace s finančnými štatistikami.
                </p>
            </li>
            <li class="mainContentText">
                <h2 class="p-6">Užívateľsky prívetivé rozhranie</h2>
                <p>
                    FinRadar vám poskytuje všetko, čo potrebujete. Od
                    interaktívnych grafov až po nekonečné databázy informácií.
                    Vo FinRadare sa snažíme posilniť našich používateľov
                    vedomosťami a nástrojmi, ktoré potrebujú na úspech v
                    komplexnom svete financií. Pripojte sa k nám na tejto
                    finančnej ceste a odomknite moc dát s FinRadarom, najlepším
                    zdrojom pre spoľahlivé finančné štatistiky a poznatky.
                </p>
            </li>
        </ul>
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
            if (this.name !== "") {
                try {
                    await axios({
                        url: "/companies",
                        method: "get",
                        params: {
                            search_query: this.name,
                            per_page: 8,
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
        @apply lg:block font-rubik font-bold text-dark text-5xl;
    }

    .homepageMainContent {
        @apply flex items-center flex-col lg:flex-row lg:place-content-evenly h-fit py-16;
    }

    .mainContentText {
        @apply flex md:w-2/3 lg:w-1/3 leading-8 flex-col text-xl text-dark font-normal text-center lg:text-left mb-10;
    }

    .mainContentText h2 {
        @apply lg:mb-10 text-center text-3xl font-rubik text-dark font-semibold;
    }

}
</style>
