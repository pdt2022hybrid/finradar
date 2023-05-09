<template>
    <!-- footer treba potom tiez -->
    <div class="bg-dark w-full py-5 justify-center flex font-varela">
        <div class="grid-cols-4 grid w-4/5">
            <router-link to="/Pages">
                <p>Mapa Stranok</p>
            </router-link>
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
