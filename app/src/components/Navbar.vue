<template>
  <nav class="navbar h-20 min-w-fit">
    <div class=" ml-40 mt-2 text-lg ">
      <router-link class=" mr-24 text-navtext" to="/">Logo Space</router-link>
      <router-link to="/databazy" class="text-navtext mr-24">Databázy</router-link>
<!--      <router-link to="/" class="text-navtext">API</router-link>-->
    </div>
    <div class=" flex mr-32">
      <input type="text" class="search">
      <div class="text-navtext mb-2 flex" @click="this.ShowMenu()">
	      <img class="ml-10 w-14 h-14 bottom-2 rounded-full flex cursor-pointer"
             src="https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png"
             alt=""
        >
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