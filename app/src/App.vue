<template>
    <NavbarPC v-if="screenWidth > 1024" />
    <MobileNavbar v-else />
    <div class="min-h-screen">
        <router-view />
    </div>
    <Footer />
</template>

<script>
import Footer from "@/layout/Footer.vue";
import NavbarPC from "@/layout/Navbar.vue";
import MobileNavbar from "@/layout/MobileNavbar.vue";

export default {
    components: {
        NavbarPC,
        Footer,
        MobileNavbar,
    },
    data() {
        return {
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
