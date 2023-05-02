<template>
    <div class="z-50">
        <form
            id="Login"
            class="bg-light flex w-1/5 items-center absolute right-32 border-2 rounded-xl p-5 mt-2 flex-col"
        >
            <h1 class="text-4xl">Log In</h1>
            <input
                type="text"
                class="w-52 inputs mt-4 mb-2 rounded focus:outline-none focus:ring-2 focus:ring-sky-500 focus:shadow-2xl"
                placeholder="e-mail"
            />
            <input
                type="text"
                class="w-52 inputs rounded focus:outline-none focus:ring-2 focus:ring-sky-500 focus:shadow-2xl"
                placeholder="heslo"
            />
            <div class="w-full pl-7 flex items-center justify-start">
                <input type="checkbox" class="inputs ml-9" />
                <p class="ml-2 font-varela">Zapamätať si ma</p>
            </div>
            <button
                type="submit"
                form="Login"
                value="Submit"
                class="bg-blue border p-1 w-52 py-1 rounded-xl border-dark border-opacity-75 border-2 font-medium font-varela hover:font-semibold focus:outline-none focus:ring-2 focus:ring-blue_light focus:shadow-2xl"
            >
                Prihlásiť sa
            </button>
            <div
                class="pt-4 text-xs font-varela w-full text-underline underline underline-offset-1 flex justify-around"
            >
                <router-link to="/register" class="w-18 hover:font-semibold"
                    >Registrovať sa</router-link
                >
                <router-link to="/" class="w-30 hover:font-semibold">
                    Zabudli ste heslo?</router-link
                >
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "MiniLogin",
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
