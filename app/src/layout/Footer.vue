<template>
    <div class="bg-dark w-full py-7 justify-center font-varela mt-auto h-32">
        <div class="flex flex-row w-full items-center justify-evenly">
            <router-link to="/Pages">
                <p class="active:text-green">Mapa Stránok</p>
            </router-link>

            <!-- Sano potom frontend -->
            <p class="hover:cursor-pointer active:text-green disabled opacity-60">Developeri</p>

            <p class="hover:cursor-pointer active:text-green disabled opacity-60">Kontakt</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Footer",
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    p {
        @apply text-navtext;
    }
}
</style>
