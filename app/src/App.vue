<template>
  <NavbarPC v-if="screenWidth > 999"/>
  <MobileNavbar v-else/>
  <div class="min-h-screen">
    <router-view/>
  </div>
  <Footer/>
</template>

<script>
import Footer from "@/components/layout/Footer.vue";
import NavbarPC from "@/components/layout/Navbar.vue";
import MobileNavbar from "@/components/layout/MobileNavbar.vue";

export default {
  components: {
    NavbarPC,
    Footer,
    MobileNavbar
  },
    data() {
      return {
          screenWidth: 0,
      }
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
}
</script>
