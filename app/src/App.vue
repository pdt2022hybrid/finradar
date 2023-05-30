<template>
    <NavbarPC v-if="screenWidth > 1024" />
    <MobileNavbar v-else />
    <div>
        <router-view />
    </div>
    <Footer />
</template>

<script>
import Footer from "@/layout/Footer.vue";
import NavbarPC from "@/layout/Navbar.vue";
import MobileNavbar from "@/layout/MobileNavbar.vue";
import { useUserInfo } from "@/stores/userData";

export default {
    components: {
        NavbarPC,
        Footer,
        MobileNavbar,
    },
    data() {
        return {
            screenWidth: 0,
            store: useUserInfo(),
            token: localStorage.getItem("UserToken")
        };
    },
    mounted() {
        this.updateScreenWidth();
        this.onScreenResize();
        this.store.refreshToken(this.token)

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
