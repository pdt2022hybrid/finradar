<template>
    <div class="flex justify-center">
        <div class="py-20 flex flex-col w-3/6 items-start">
            <router-link to="/home"><h1>Home</h1></router-link>
            <router-link to="/databazy"><h1>Databazy</h1></router-link>
            <router-link to="/company"><h1>Company </h1></router-link>
            <router-link to="/register"><h1>Register / Login</h1></router-link>
            <router-link to="/dashboard"><h1>Dashboard</h1></router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'IndexOfPages'
}
</script>

<style scoped>
@tailwind base;
@tailwind utilities;
@tailwind components;

@layer base {

    h1 {
        @apply my-1.5 font-varela font-semibold
    }

    p {
        @apply my-0.5 font-varela
    }
}
</style>
