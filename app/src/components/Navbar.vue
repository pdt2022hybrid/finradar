<template>
  <nav class="navbar h-20 min-w-fit">
    <div class=" ml-40 mt-2 text-lg ">
      <router-link class=" mr-24 text-navtext" to="/">Logo Space</router-link>
      <router-link to="/databazy" class="text-navtext mr-24">Databázy</router-link>
<!--      <router-link to="/" class="text-navtext">API</router-link>-->
    </div>
    <div class=" flex mr-32">
      <input type="text" class="search">
      <div class="text-navtext flex items-center" @click="this.ShowMenu()">
			 <i class="bi bi-person-circle ml-10 rounded-full flex cursor-pointer text-blue text-5xl"></i>
      </div>
    </div>
  </nav>
  <!-- tunak passujeme opak premennych do Visible prop na komponentoch -->
  <MiniLogin :Visible="!this.MiniLogIn"/>
  <UserMiniSettings :Visible="!this.UserSettingsWindow"/>
</template>

<script>
import UserMiniSettings from "@/components/UserMiniSettings.vue";
import MiniLogin from "@/components/MiniLogin.vue";

export default {
  name: "Navbar",
  components: {
    MiniLogin,
    UserMiniSettings,
  },
  // premenne vo vue
  data() {
    return {
      // potom zmenime
      LoggedIn: true,
      MiniLogIn: false,
      UserSettingsWindow: false,
    }
  },
  methods: {
    // when clicking on user pfp
    // if not logged in show mini login
    // if logged in show the other window
    ShowMenu() {
      if (this.LoggedIn) {
        this.UserSettingsWindow = !this.UserSettingsWindow;
      } else {
        this.MiniLogIn = !this.MiniLogIn;
      }
    }
  }
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
    @apply mr-24 h-10 mt-1 bg-search text-dark text-center rounded
  }
}
</style>