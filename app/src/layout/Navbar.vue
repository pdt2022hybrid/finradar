<template>
  <nav class="navbar lg:h-20 lg:min-w-fit">
    <div class="lg:block lg:ml-40 lg:mt-2 lg:text-lg">
      <router-link class=" lg:mr-24 text-navtext font-bold" to="/">Logo Space</router-link>
      <router-link to="/databazy" class="text-navtext font-bold lg:mr-24 active:text-blue_light">Databázy</router-link>
<!--      <router-link to="/" class="text-navtext">API</router-link>-->
    </div>
    <div class="lg:flex lg:mr-32">
      <input type="text" class="search ml-8 focus:outline-none focus:ring-2 focus:ring-blue_light focus:shadow-2xl"
             v-model="name" placeholder="Vyhľadať firmu" @keyup="Search">
      <div class="text-navtext lg:flex lg:items-center" @click="ShowMenu">
			 <i class="bi bi-person-circle lg:ml-10 lg:rounded-full lg:flex lg:cursor-pointer text-blue lg:text-5xl"></i>
      </div>
        <div class="absolute flex w-3/4 mt-9" v-if="name !== ''">
            <ul class="absolute w-64 bg-light rounded-md mx-auto z-10">
                <li class="border-background border-b-2 px-3" v-for="item in this.companies">
                    <router-link :to="{ name: 'company', params: { ico: item.ico } }" v-slot="{ redirect }">
                        <h4 class="cursor-pointer lg:w-fit mx-auto font-varela font-medium text-center hover:font-semibold" @click="redirect"> {{ item.name }} </h4>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
  </nav>
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
      companies: [],
      Visible: true
    }
  },
  methods: {
    // when clicking on user pfp
    // if not logged in show miniLogin else show userSettings
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
            this.companies = response.data.data
          })
        } catch (errors) {
          console.log(errors)
        }
      } else {
        this.companies = [];
      }
    }
  },
  watch: {
    $route() {
      this.UserSettingsWindow = false
      this.MiniLogIn = false
      this.companies = []
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