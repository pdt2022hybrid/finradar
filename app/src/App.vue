<template>
    <NavbarPC v-if="screenWidth > 1024"
        @startLoad="loading = true"
        @stopLoad="loading = false"
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
        };
    },
    mounted() {
        this.updateScreenWidth();
        this.onScreenResize();
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
