<template>
    <Loader v-if="!loaded"/>
    <div class="mb-20">
        <div class="flex-col lg:mt-16 flex items-center font-rubik w-full">
            <div class="w-4/5">
                <h1 class="text-4xl mb-10 font-extrabold">Dashboard</h1>
                <h3 class="text-xl font-bold">Pripnuté firmy</h3>
            </div>

        <div class="w-4/5 flex">
            <Table
                :per_page="per_page"
                :page="page"
                :companies="companies"
                :last_page="last_page"
                @setPage="page"
            />
<!--                @firstPage="firstPage"-->
<!--                @nextPage="nextPage"-->
<!--                @prevPage="prevPage"-->
<!--                @lastPage="lastPage"-->
        </div>
		</div>
    </div>
</template>

<script>
import Loader from "@/components/Loader.vue";
import Table from "@/components/Table.vue";
import { useUserInfo } from "@/stores/userData";
import axios from "axios";

export default {
    name: "UserDashboard",
    components: {
        Loader,
        Table
    },
    data() {
        return {
            loaded: true,
            companies: null,
            per_page: 20,
            page: 1,
            token: "",
            last_page: 1
        }
    },
    async mounted() {
        this.token = localStorage.getItem("UserToken")
        try {
            axios({
                method: "get",
                url: "/dashboards",
                headers: {
                    Authorization: 'Bearer' + this.token
                }
            }).then((response) => {
                this.loaded = true
                if (response.data.data.companies.length > 1) {
                    this.companies = response.data.data.companies
                }
                console.log(this.companies)
                console.log(response)
            })
        } catch (errors) {
            console.log(errors)
        }
        },
    // methods: {
    //     nextPage() {
    //         this.page++;
    //         this.search();
    //     },
    //     prevPage() {
    //         this.page--;
    //         this.search();
    //     },
    //     firstPage() {
    //         this.page = 1;
    //         this.search();
    //     },
    //     lastPage() {
    //         this.page = this.companies?.meta?.last_page;
    //         this.search();
    //     },
    // }
};
</script>
