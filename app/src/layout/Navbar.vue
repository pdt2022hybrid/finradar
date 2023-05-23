<template>
    <nav class="lg:h-20 lg:w-full bg-navbar navbar justify-center">
        <div class="navbar w-4/5 p-0">
            <div class="lg:text-lg flex flex-row items-center w-3/5 pr-20">
                <router-link class="text-navtext font-bold mr-5" to="/">
                    <img
                        src="../assets/brand/logo_text.png"
                        class="h-10 w-50 mr-24"
                        alt=""
                    />
                </router-link>
                <router-link
                    to="/database"
                    class="text-navtext font-bold active:text-green"
                    >Databázy
                </router-link>
                <!--      <router-link to="/" class="text-navtext">API</router-link>-->
            </div>
            <div class="lg:flex items-center">
                <div
                    v-if="isHome !== true"
                    class="relative flex items-center w-full h-10 rounded-lg shadow-xl bg-white overflow-hidden mt-1 mr-14 inputFocusWithin"
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
                <div
                    class="text-navtext lg:flex lg:items-center"
                    @click="ShowMenu"
                >
                    <i
                        class="bi bi-person-circle lg:ml-10 lg:rounded-full lg:flex lg:cursor-pointer text-green lg:text-5xl"
                    ></i>
                </div>
                <div
                    class="absolute w-3/4 mt-9"
                    v-if="name !== '' && companies.length > 0"
                >
                    <ul
                        class="fixed w-64 bg-white rounded-sm border-searchborder border-2 mx-auto top-16 right-64 mr-1 z-10"
                    >
                        <li
                            class="border-light border-b-2 p-1.5"
                            v-for="item in this.companies"
                        >
                            <router-link
                                :to="{
                                    name: 'company',
                                    params: { ico: item.ico },
                                }"
                                v-slot="{ redirect }"
                                :key="$route.path"
                            >
                                <h4
                                    class="cursor-pointer lg:w-fit mx-auto font-varela font-medium text-center hover:font-semibold hover:decoration-1 hover:underline decoration-underline active:text-green"
                                >
                                    {{ item.name }}
                                </h4>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <MiniLogin v-if="MiniLogIn"
        @hide="MiniLogIn = false"
    />
    <UserMiniSettings v-if="UserSettingsWindow"
        @hide="UserSettingsWindow = false"
    />
</template>

<script>
import UserMiniSettings from "@/components/UserMiniSettings.vue";
import MiniLogin from "@/components/MiniLogin.vue";
import axios from "axios";
import { useUserInfo } from "@/stores/userData";

export default {
    name: "NavbarPC",
    components: {
        MiniLogin,
        UserMiniSettings,
    },
    data() {
        return {
            isHome: true,
            MiniLogIn: false,
            UserSettingsWindow: false,
            name: null,
            companies: [],
        };
    },
    methods: {
        ShowMenu() {
            if (localStorage.getItem("Logged") === "true") {
                this.UserSettingsWindow = !this.UserSettingsWindow
            } else if (localStorage.getItem("Logged") === null) {
                this.MiniLogIn = !this.MiniLogIn
            }
        },
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
    watch: {
        $route() {
            this.UserSettingsWindow = false;
            this.MiniLogIn = false;
            this.companies = [];
            this.name = "";
            if (this.$route.name === "Home") {
                this.isHome = true;
            } else {
                this.isHome = false;
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
    .navbar {
        @apply lg:flex lg:place-content-between bg-dark lg:p-4 hidden;
    }

    .search {
        @apply lg:mr-24 lg:h-10 lg:mt-1 bg-search text-dark text-center rounded;
    }
}
</style>
