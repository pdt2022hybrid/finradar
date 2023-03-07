<template>
  <nav>
    <div>
      <router-link to="/">logo space</router-link>
      <router-link to="/databazy">databazy</router-link>
    </div>
    <div>
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