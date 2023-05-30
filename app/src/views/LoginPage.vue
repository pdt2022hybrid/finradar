<template>
    <div class="items-center flex flex-col mb-10 mt-14">
        <div class="lg:w-1/2 flex-col flex items-center w-full">
            <h1 class="lg:mt-16 text-4xl font-bold lg:w-3/4 text-center">
                Prihlásenie
            </h1>
            <h2
                class="mb-4 text-xl mt-10 font-semibold w-3/4 lg:indent-5 text-center"
            >
                Sem zadajte Vaše informácie na prihlásenie
            </h2>
        </div>
        <div class="flex justify-center lg:w-1/2">
            <form class="bg-gray p-6 px-16 lg:w-3/4" onsubmit="return false">
                <label class="block">
                    <span
                        class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700 my-2"
                    >
                        E-mail
                    </span>
                    <input
                        type="email"
                        name="email"
                        class="mt-1 px-3 py-2 bg-background shadow-sm border-slate-300 placeholder-slate-400 outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                        placeholder="Váš e-mail"
                        v-model="email"
                    />
                </label>
                <label class="block">
                    <span
                        class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700 my-2"
                    >
                        <span>Heslo</span>
                    </span>
                    <input
                        type="password"
                        name="passw"
                        class="mt-1 px-3 py-2 bg-background shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                        placeholder="Vaše heslo"
                        v-model="password"
                    />
                </label>
                <button
                    class="bg-green rounded mt-6 mb-2 w-full text-dark font-bold h-9"
                    @click="checkForm"
                >
                    Potvrdiť
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import { useUserInfo } from "@/stores/userData";
import router from "@/router";

const store = useUserInfo();
export default {
    name: "LoginPage",
    data() {
        return {
            email: null,
            password: null,
        };
    },
    methods: {
        checkForm() {
            if(this.email === null || this.email === "") {
                alert("E-mail missing")
                return false
            }
            if(this.password === null || this.password === "") {
                alert("Password missing")
                return false
            }
            store.login(this.password, this.email);
            router.push({ path: "dashboard" });
        },
    },
};
</script>
