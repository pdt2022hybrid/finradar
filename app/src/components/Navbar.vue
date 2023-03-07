<template>
  <nav class="navbar">
    <div class=" ml-40">
      <router-link class=" mr-24 text-navtext" to="/">logo space</router-link>
      <router-link to="/databazy" class="text-navtext mr-24">databazy</router-link>
      <router-link to="/" class="text-navtext">API</router-link>
    </div>
    <div class=" mr-40">
      <input type="text" class="search">
      <router-link to="/register" class="text-navtext">user space</router-link>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Navbar"
}
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {

  .navbar {
    @apply flex place-content-between bg-dark p-4
  }
  .search {
    @apply mr-24 bg-search text-dark text-center rounded
  }
}
</style>