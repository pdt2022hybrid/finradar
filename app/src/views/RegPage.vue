<template>
    <div class="items-center flex flex-col lg:mb-20 mb-16">
        <div class="lg:w-1/2 flex-col flex items-center w-full">
            <h1 class="mt-16 text-4xl font-bold lg:w-3/4 text-center">
                Registrácia
            </h1>
            <h2
                class="mb-4 text-xl mt-10 font-semibold w-3/4 lg:indent-5 text-center"
            >
                Sem zadajte Vaše informácie na registráciu profilu
            </h2>
        </div>
        <div class="flex justify-center lg:w-1/2">
            <form
                class="bg-gray p-6 px-16 lg:w-3/4 rounded-md"
                onsubmit="return false"
            >
                <label class="block">
                    <span
                        class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700 mb-2"
                    >
                        Meno a Priezvisko
                    </span>
                    <input
                        type="text"
                        name="full name"
                        class="mt-1 px-3 py-2 bg-background shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-md sm:text-sm inputFocus focus:placeholder:text-background"
                        placeholder="Vaše meno a priezvisko"
                        v-model="fullName"
                    />
                </label>
                <label class="block">
                    <span
                        class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700 my-2"
                    >
                        E-mail
                    </span>
                    <input
                        type="email"
                        name="email"
                        class="mt-1 px-3 py-2 bg-background shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-md sm:text-sm inputFocus focus:placeholder:text-background"
                        placeholder="Váš e-mail"
                        v-model="email"
                    />
                </label>
                <label class="block">
                    <span
                        class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700 my-2"
                    >
                        <span>Heslo (min. 8 znakov)</span>
                    </span>
                    <input
                        type="password"
                        name="passw"
                        class="mt-1 px-3 py-2 bg-background shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-md sm:text-sm inputFocus focus:placeholder:text-background"
                        placeholder="Vaše heslo"
                        v-model="password"
                    />
                </label>
                <label class="block">
                    <span
                        class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700 my-2"
                    >
                        Potvrdenie Hesla
                    </span>
                    <input
                        type="password"
                        name="confpass"
                        class="mt-1 px-3 py-2 bg-background shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-md sm:text-sm inputFocus focus"
                        placeholder=""
                        v-model="password_confirm"
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
    name: "RegPage",
    data() {
        return {
            email: null,
            fullName: null,
            name: null,
            surname: null,
            password: null,
            password_confirm: null,
        };
    },
    methods: {
        checkForm() {
            if (this.email === null || this.email === "") {
                alert("Prosím, zadajte e=mail")
                return false
            }
            if (this.fullName === null || this.fullName === "") {
                alert("Prosím, zadajte meno a priezvisko")
                return false
            }
            if (this.password === null || this.password === "") {
                alert("Prosím, zadajte heslo")
                return false
            }
            if (
                this.password_confirm === null ||
                this.password_confirm === ""
            ) {
                alert("Prosím potvrďte svoje heslo")
                return false
            }
            if (this.password.length < 8) {
                alert("Vaše heslo je krátke")
                return false;
            } else if (this.password.length > 20) {
                alert("Vaše heslo je dlhé")
                return false;
            }
            this.splitName();
            store.register(
                this.name,
                this.surname,
                this.email,
                this.password,
                this.password_confirm
            );
            router.push({ path: "/dashboard" })
        },
        splitName() {
            console.log(this.fullName);
            const names = this.fullName.split(" ");
            this.name = names[0];
            this.surname = names[names.length - 1];
            if (this.name === this.surname) {
                this.surname = "";
            }
        }
    }
};
</script>
