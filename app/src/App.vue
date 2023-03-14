<template>
  <Navbar/>
  <router-view/>
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

@layer base {

  body {
    @apply bg-background
  }

  h1{
	@apply font-rubik font-bold
  }

  p{
	@apply font-varela
  }

  h2 {
	@apply font-rubik font-semibold
  }

}
</style>