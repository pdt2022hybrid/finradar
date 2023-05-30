<template>
    <NavbarPC v-if="screenWidth > 1024"
        @stopLoad="loading = false"
        @startLoad="loading = true"
    />
    <MobileNavbar v-else />
    <div>
        <Loader v-if="loading" />
        <router-view />
    </div>
    <Footer />
</template>

<script>
import Footer from "@/layout/Footer.vue";
import NavbarPC from "@/layout/Navbar.vue";
import MobileNavbar from "@/layout/MobileNavbar.vue";
import { useUserInfo } from "@/stores/userData";
import Loader from "@/components/Loader.vue";

export default {
    components: {
        Loader,
        NavbarPC,
        Footer,
        MobileNavbar,
    },
    data() {
        return {
            loading: false,
            screenWidth: 0,
            store: useUserInfo(),
            token: localStorage.getItem("UserToken")
        };
    },
    mounted() {
        this.updateScreenWidth();
        this.onScreenResize();
        if(this.store.LoggedIn === true) {
        this.store.refreshToken(this.token)
        }

    },
    methods: {
        onScreenResize() {
            window.addEventListener("resize", () => {
                this.updateScreenWidth();
            });
        },
        updateScreenWidth() {
            this.screenWidth = window.innerWidth;
        },
    },
};
</script>
