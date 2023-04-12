<template>
  <nav class="lg:hidden bg-dark p-4 text-background">
    <div class="flex justify-between">
        <router-link to="/home">
            <img src="" alt="logo">
        </router-link>
        <button @click="collapsed = !collapsed">
            <i class="bi bi-list"></i>
        </button>
    </div>
      <transition name="slide-in">
        <div v-if="collapsed" class="flex flex-col items-start">
            <ul>
                <li class="p-2"> <router-link to="/databazy"> Databazy </router-link> </li>
            </ul>
            <button class="p-2" @click="this.$router.push('/login')">prihlasit sa</button>
            <button class="p-2" @click="this.$router.push('/register')">registrovat sa</button>
        </div>
      </transition>
  </nav>
</template>

<script>
export default {
    name: "MobileNavbar",
    data() {
        return {
            collapsed: false,
        }
    }
}
</script>

<style scoped>

</style>