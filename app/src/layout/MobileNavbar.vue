<template>
    <nav class="bg-dark text-background mim-w-fit ">
        <div class="w-full z-20 fixed">
            <div class="flex justify-between p-4 bg-dark items-center">
                <router-link to="/home" class="md:w-80 w-40">
                    <img
                        src="../assets/brand/logo_text.png"
                        alt="logo"
                        class="md:w-2/3"
                    />
                </router-link>
                <button @click="toggle">
                    <i class="bi bi-list text-2xl md:text-4xl"></i>
                </button>
            </div>
        </div>
        <transition class="mt-16">
            <div
                v-if="!collapsed"
                class="px-4 bg-dark flex flex-col items-start fixed-top w-full top-14 z-10"
            >
                <ul class="font-bold">
                    <li @click="toggle" class="p-2.5 my-2">
                        <i class="bi bi-card-list mr-1 text-lg"></i>
                        <router-link to="/database"> Databázy</router-link>
                    </li>
                    <!-- TODO: urobit selective loading podla usera -->
                    <li
                        @click="toggle"
                        v-if="store.LoggedIn"
                        class="p-2.5 mb-2"
                    >
                        <i
                            class="bi bi-bar-chart-line-fill text-navtext mr-1 text-lg"
                        ></i>
                        <router-link to="/dashboard">Dashboard</router-link>
                    </li>
                    <li
                        @click="toggle"
                        v-if="store.LoggedIn"
                        class="p-2.5 mb-2"
                    >
                        <i
                            class="bi bi-box-arrow-right text-navtext mr-1 text-lg"
                        ></i>
                        <router-link to="/dashboard">Odhlásiť sa</router-link>
                    </li>
                    <li
                        @click="toggle"
                        v-if="!store.LoggedIn"
                        class="p-2.5 mb-2"
                    >
                        <i
                            class="bi bi-person-add text-navtext mr-1 text-lg"
                        ></i>
                        <router-link to="/login">Prihlásiť sa</router-link>
                    </li>
                    <li
                        @click="toggle"
                        v-if="!store.LoggedIn"
                        class="p-2.5 mb-2"
                    >
                        <i class="bi bi-person text-navtext mr-1 text-lg"></i>
                        <router-link to="/register">Registrovať sa</router-link>
                    </li>
                </ul>
            </div>
        </transition>
    </nav>
</template>

<script>
import { useUserInfo } from "@/stores/userData";
import router from "@/router";

export default {
    name: "MobileNavbar",
    data() {
        return {
            collapsed: true,
            store: useUserInfo()
        };
    },
    methods: {
        toggle() {
            this.collapsed = !this.collapsed;

            if (!this.collapsed) {
                window.scrollTo(0, 0);
            }
        },
        logout() {
            const store = useUserInfo();
            store.$reset();
            localStorage.clear();
            router.push({ path: "home" });
        },
    },
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    .v-enter-active {
        @apply transition-all ease-in duration-200;
    }

    .v-leave-active {
        @apply transition-all ease-out duration-200;
    }

    .v-enter-from,
    .v-leave-to {
        @apply transform -translate-y-full;
    }
}
</style>
