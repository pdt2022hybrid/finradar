<template>
    <!-- alex pls tailwind treba urobit
    ked Visible === true tak sa tomu da visibility: invisible -->
    <div
        class="bg-light flex w-1/6 absolute right-32 border-2 rounded-xl p-5 mt-2 flex-col indent-2"
    >
        <header class="font-rubik font-medium text-lg border-b-2"> Smigus Dyngus</header>
        <router-link to="/dashboard" class="border-b-2 pt-2 pb-2 font-normal flex">
            <i class="bi bi-bar-chart-line-fill text-blue"></i>
            <p class="indent-3">Dashboard</p>
        </router-link>
        <router-link to="/" class="border-b-2 pt-2 pb-2 flex">
            <i class="bi bi-gear-fill text-blue"></i>
            <p class="indent-3">Settings</p>
        </router-link>
        <router-link to="/" class="border-b-2 pt-2 pb-2 flex">
            <i class="bi bi-box-arrow-right text-blue"></i>
            <p class="indent-3">Log Out</p>
        </router-link>
    </div>
</template>

<script>
export default {
    name: "UserMiniSettings",
}
</script>
