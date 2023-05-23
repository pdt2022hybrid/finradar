<template>
    <Loader v-if="!loaded"/>
    <div v-else
        class="w-full flex justify-center"
    >
        <div class="w-4/5">
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
            loaded: false,
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
