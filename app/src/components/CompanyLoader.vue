<template>
    <div class="absolute min-w-full min-h-screen bg-background flex flex-row items-center justify-center">
        <span class="loading-ball"></span>
        <span class="loading-ball" style="animation-delay: 150ms"></span>
        <span class="loading-ball" style="animation-delay: 300ms"></span>
    </div>
</template>

<script>
export default {
    name: "CompanyLoader"
}
</script>
z-10
<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    .loading-ball {
        @apply animate-bounce bg-green md:h-10 md:w-10 h-5 w-5 rounded-full md:mr-5 mr-3
    }
}
</style>