<template>
    <!-- footer treba potom tiez -->
    <div class="bg-dark w-full py-5 justify-center flex font-varela">
        <div class="flex flex-row w-full items-center justify-evenly">
            <router-link to="/Pages">
                <p class="active:text-green">Mapa Stránok</p>
            </router-link>

			<p>Developeri</p>

			<p>Kontakt</p>

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
