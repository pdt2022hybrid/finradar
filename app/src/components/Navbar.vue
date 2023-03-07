<template>
  <nav class="flex place-content-between">
    <div class=" ml-40">
      <router-link class=" mr-24" to="/">logo space</router-link>
      <router-link to="/databazy">databazy</router-link>
    </div>
    <div class=" mr-40">
      <input type="text" disabled>
      <router-link to="/register">user space</router-link>

    </div>
  </nav>
</template>

<script>
export default {
  name: "Navbar"
}
</script>

<style scoped>

</style>