<template>
    <div class="absolute w-full min-h-screen bg-background flex flex-row items-center justify-center z-50">
        <span class="loading-ball"></span>
        <span class="loading-ball mx-3 md:mx-5" style="animation-delay: 150ms"></span>
        <span class="loading-ball" style="animation-delay: 300ms"></span>
    </div>
</template>

<script>
export default {
    name: "Loader"
}
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    .loading-ball {
        @apply animate-bounce bg-green md:h-10 md:w-10 h-5 w-5 rounded-full
    }
}
</style>