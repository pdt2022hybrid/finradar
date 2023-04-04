<template>
  <Navbar/>
  <div class="lg:min-h-screen">
    <router-view/>
  </div>
  <Footer/>
</template>

<script>
import Footer from "@/components/Footer.vue";
import Navbar from "@/components/Navbar.vue";

export default {
  components: {
    Navbar,
    Footer
  }
}
</script>

<style>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {  }
</style>
