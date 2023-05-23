<template>
    <div class="text-background">
        <form
            onsubmit="return false"
            class="z-50 bg-dark flex w-1/5 items-center absolute right-32 rounded-xl p-5 mt-2 flex-col"
        >
            <h1 class="text-4xl">Log In</h1>
            <input
                type="email"
                name="email"
                class="w-52 inputs mt-4 mb-2 rounded focus:outline-none focus:ring-2 focus:ring-green focus:shadow-2xl text-dark"
                placeholder="name@example.com"
                v-model="email"
            />
            <input
                type="password"
                name="passw"
                class="w-52 inputs rounded focus:outline-none focus:ring-2 focus:ring-green focus:shadow-2xl text-dark"
                placeholder="Vaše heslo"
                v-model="password"
            />
<!--            <div class="w-full pl-7 flex items-center justify-start">-->
<!--                <input type="checkbox" class="inputs ml-9" />-->
<!--                <p class="ml-2 font-varela">Zapamätať si ma</p>-->
<!--            </div>-->
            <button
                class="bg-green p-1 w-52 py-1 text-dark rounded-xl border-dark border-opacity-75 font-medium font-varela hover:text-white active:ring-2 active:ring-background focus:shadow-2xl"
                @click="checkForm"
            >
                Prihlásiť sa
            </button>
            <div
                class="pt-4 text-xs font-varela w-full text-underline underline underline-offset-1 flex justify-around"
            >
                <router-link to="/register" class="w-18 hover:font-semibold"
                    >Registrovať sa
                </router-link>
                <router-link to="/" class="w-30 hover:font-semibold">
                    Zabudli ste heslo?
                </router-link>
            </div>
        </form>
    </div>
</template>

<script>
import {useUserInfo} from "@/stores/userData";
import router from "@/router";
export default {
    name: "MiniLogin",
    data() {
        return {
            email: "",
            password: ""
        }
    },
    methods: {
        checkForm() {
            const store = useUserInfo()
            store.login(this.password, this.email)
            this.$emit('hide')
            router.push({path: 'dashboard'})
        }
    }
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    .inputs {
        @apply bg-background h-1/4 my-2.5 py-1 px-3;
    }
}
</style>
