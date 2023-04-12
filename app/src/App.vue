<template>
  <NavbarPC v-if="screenWidth > 999"/>
  <MobileNavbar v-else/>
  <div class="min-h-screen">
    <router-view/>
  </div>
  <Footer/>
</template>

<script>
import Footer from "@/components/Footer.vue";
import NavbarPC from "@/components/Navbar.vue";
import MobileNavbar from "@/components/MobileNavbar.vue";

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

<style>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {  }
</style>
