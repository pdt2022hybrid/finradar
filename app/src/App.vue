<template>
  <MobileNavbar/>
  <NavbarPC/>
  <div class="lg:min-h-screen">
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
  }
}
</script>

<style>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {  }
</style>
