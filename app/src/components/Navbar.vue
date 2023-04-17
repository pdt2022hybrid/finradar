<template>
  <nav class="navbar lg:h-20 lg:min-w-fit">
    <div class="lg:block lg:ml-40 lg:mt-2 lg:text-lg">
      <router-link class=" lg:mr-24 text-navtext" to="/">Logo Space</router-link>
      <router-link to="/databazy" class="text-navtext lg:mr-24">Databázy</router-link>
<!--      <router-link to="/" class="text-navtext">API</router-link>-->
    </div>
    <form class="lg:flex lg:mr-32" onsubmit="return false">
      <input type="text" class="search" v-model="name" placeholder="search" @keyup="Search">
      <button class="hidden" @click="Search"></button>
      <div class="text-navtext lg:flex lg:items-center" @click="ShowMenu">
			 <i class="bi bi-person-circle lg:ml-10 lg:rounded-full lg:flex lg:cursor-pointer text-blue lg:text-5xl"></i>
      </div>
    </form>
  </nav>
<!--  ma asi drbnhe dnes do rana -->
  <div class="lg:flex lg:place-content-end lg:mr-32">
    <ul>
      <li class="px-2 mt-2 bg-light border-2 rounded-md" v-for="item in this.Data">
        <router-link :to="{ name: 'company', params: { ico: item.ico } }" v-slot="{ redirect }">
          <h4 class=" cursor-pointer w-fit py-1 font-medium" @click="redirect"> {{ item.name }} </h4>
        </router-link>
      </li>
    </ul>
  </div>
  <!-- tunak passujeme opak premennych do Visible prop na komponentoch (retardovana metoda) -->
  <MiniLogin v-if="MiniLogIn"/>
  <UserMiniSettings v-if="UserSettingsWindow"/>
</template>

<script>
import UserMiniSettings from "@/components/UserMiniSettings.vue";
import MiniLogin from "@/components/MiniLogin.vue";
import axios from "axios";

export default {
  name: "NavbarPC",
  components: {
    MiniLogin,
    UserMiniSettings,
  },
  // premenne vo vue
  data() {
    return {
      // potom zmenime
      LoggedIn: false,
      MiniLogIn: false,
      UserSettingsWindow: false,
      name: null,
      Data: [],
      Visible: true
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
    },
    async Search() {
      if(this.name !== '') {
        try {
          await axios({
            url: '/companies',
            method: "get",
            params: {
              search_query: this.name,
              per_page: 5,
            }
          }).then((response) => {
            console.log(response)
            this.Data = response.data.data
          })
        } catch (errors) {
          console.log(errors)
        }
      } else {
        this.Data = [];
      }
    }
  },
  watch: {
    $route() {
      this.UserSettingsWindow = false
      this.MiniLogIn = false
      this.Data = []
      this.name = ''
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
    @apply lg:flex lg:place-content-between bg-dark lg:p-4 hidden
  }
  .search {
    @apply lg:mr-24 lg:h-10 lg:mt-1 bg-search text-dark text-center rounded
  }
}
</style>