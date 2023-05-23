<template>
    <div
        class="bg-dark flex w-1/6 absolute right-32 border-2 rounded-xl p-5 mt-2 flex-col indent-2 text-background z-50"
    >
        <header class="font-rubik font-medium text-lg">
            {{ name + " " + surname }}
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
        <div class="pt-2 pb-2 flex cursor-pointer" @click="logout">
            <i class="bi bi-box-arrow-right text-green"></i>
            <p class="indent-3">Odhlásiť sa</p>
        </div>
    </div>
</template>

<script>
import { useUserInfo } from "@/stores/userData";
import router from "@/router";
export default {
    name: "UserMiniSettings",
    data() {
        return {
            name: localStorage.getItem("Username"),
            surname: localStorage.getItem("UserSurname")
        }
    },
    methods: {
        logout() {
            const store = useUserInfo()
            store.$reset()
            console.log(store.UserData)
            localStorage.clear()
            this.$emit('hide')
            router.push({path: 'home'})
        }
    }
};
</script>
