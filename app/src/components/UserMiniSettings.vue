<template>
    <div
        class="bg-dark flex w-1/6 absolute right-32 rounded-xl pt-4 pb-2 px-2 mt-2 flex-col indent-2 text-background z-50"
    >
        <header class="font-rubik font-medium text-lg">
            Smigus Dyngus
        </header>
        <router-link
            to="/dashboard"
            class="pt-2 pb-2 font-normal flex"
        >
            <i class="bi bi-bar-chart-line-fill text-green"></i>
            <p class="indent-3">Dashboard</p>
        </router-link>
        <router-link to="/" class="pt-2 pb-2 flex">
            <i class="bi bi-gear-fill text-green"></i>
            <p class="indent-3">Nastavenia</p>
        </router-link>
        <router-link to="/" class="pt-2 pb-2 flex">
            <i class="bi bi-box-arrow-right text-green"></i>
            <p class="indent-3">Odhlásiť sa</p>
        </router-link>
    </div>
</template>

<script>
export default {
    name: "UserMiniSettings",
};
</script>
