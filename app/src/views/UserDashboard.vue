<template>
    <Loader v-if="!loaded" />
    <div class="mb-20 mt-14">
        <div class="flex-col lg:mt-16 flex items-center font-rubik w-full">
            <div class="w-4/5">
                <span class="flex">
                    <h1 class="text-4xl mb-10 font-extrabold">Dashboard</h1>
                    <i class="bi bi-pin-angle text-3xl ml-4 text-green"></i>
                </span>
                <h3 class="text-2xl font-bold">Pripnuté firmy</h3>
            </div>

            <div class="w-4/5 flex flex-col">
                <Table
                    :per_page="per_page"
                    :page="page"
                    :companies="store.companies"
                    :last_page="last_page"
                    @setPage="page"
                />
            </div>
        </div>
    </div>
</template>

<script>
import Loader from "@/components/Loader.vue";
import Table from "@/components/Table.vue";
import { useUserInfo } from "@/stores/userData";

export default {
    name: "UserDashboard",
    components: {
        Loader,
        Table,
    },
    data() {
        return {
            loaded: false,
            per_page: 20,
            page: 1,
            token: localStorage.getItem("UserToken"),
            last_page: 1,
            store: useUserInfo(),
        };
    },
    mounted() {
        if (this.store.UserToken !== "") {
            $router.go(-1);
        }
        this.store.getPinnedCompanies(this.token);
        this.loaded = true;
    },
};
</script>
