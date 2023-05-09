<template>
    <nav class="navbar lg:h-20 lg:min-w-fit bg-navbar">
        <div class="lg:text-lg flex flex-row items-center w-3/5 ml-40 pr-20">
            <router-link class="text-navtext font-bold mr-5" to="/">
                <img
                    src="../assets/brand/logo_text.svg"
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
        <div class="lg:flex lg:mr-32">
            <div
                    class="relative flex items-center items-center w-full h-10 rounded-lg shadow-xl focus-within:shadow-xl bg-white overflow-hidden focus-within:border-green focus-within:border-2 mt-1 mr-14"
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
            <div class="text-navtext lg:flex lg:items-center" @click="ShowMenu">
                <i
                    class="bi bi-person-circle lg:ml-10 lg:rounded-full lg:flex lg:cursor-pointer text-green lg:text-5xl"
                ></i>
            </div>
            <div class="absolute flex w-3/4 mt-9" v-if="name !== ''">
                <ul class="absolute w-64 bg-white rounded-sm border-searchborder border-2 mx-auto top-3 z-10">
                    <li
                        class="border-light border-b-2 p-1.5"
                        v-for="item in this.companies"
                    >
                        <router-link
                            :to="{ name: 'company', params: { ico: item.ico } }"
                            v-slot="{ redirect }"
                        >
                            <h4
                                class="cursor-pointer lg:w-fit mx-auto font-varela font-medium text-center hover:font-semibold hover:decoration-1 hover:underline decoration-underline active:text-blue"
                                @click="redirect"
                            >
                                {{ item.name }}
                            </h4>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <MiniLogin v-if="MiniLogIn" />
    <UserMiniSettings v-if="UserSettingsWindow" />
</template>

<script>
import UserMiniSettings from "@/components/UserMiniSettings.vue";
import MiniLogin from "@/components/MiniLogin.vue";
import axios from "axios";

export default {
    name: "NavbarPC",
    components: {
        MiniLogin,
        UserMiniSettings,
    },
    // premenne vo vue
    data() {
        return {
            // potom zmenime
            isHome : true,
            LoggedIn: true,
            MiniLogIn: false,
            UserSettingsWindow: false,
            name: null,
            companies: [],
            Visible: true,
        };
    },
    methods: {
        // when clicking on user pfp
        // if not logged in show miniLogin else show userSettings
        ShowMenu() {
            if (this.LoggedIn) {
                this.UserSettingsWindow = !this.UserSettingsWindow;
            } else {
                this.MiniLogIn = !this.MiniLogIn;
            }
        },
        async Search() {
            if (this.name !== "") {
                try {
                    await axios({
                        url: "/companies",
                        method: "get",
                        params: {
                            search_query: this.name,
                            per_page: 5,
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
            if (this.$route.name === 'Home') {
                this.isHome = true
            }  else {
                this.isHome = false
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
