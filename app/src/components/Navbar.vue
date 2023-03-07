<template>
  <nav class="flex place-content-between bg-slate-700">
    <div class=" ml-40">
      <router-link class=" mr-24 text-white" to="/">logo space</router-link>
      <router-link to="/databazy" class="text-white mr-24">databazy</router-link>
      <router-link to="/" class="text-white">API</router-link>
    </div>
    <div class=" mr-40">
      <input type="text" class="mr-24" disabled>
      <router-link to="/register" class="text-white">user space</router-link>

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