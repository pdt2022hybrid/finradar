<template>
  <nav class="bg-dark text-background w-full">
      <div class="w-full fixed z-10">
        <div class="flex justify-between p-4 bg-dark">
            <router-link to="/home">
                <img src="" alt="logo">
            </router-link>
            <button @click="collapsed = !collapsed">
                <i class="bi bi-list"></i>
            </button>
        </div>
      </div>
      <transition>
        <div v-if="collapsed" class="px-4 bg-dark flex flex-col items-start fixed w-full top-14 ">
            <ul>
                <li class="p-2"> <router-link to="/databazy " class="font-bold"> Databázy </router-link> </li>
                <!--todo: urobit selective loading podla usera -->
                <li class="p-2">
                    <i></i>
                    <router-link to="/login">Prihlásiť sa</router-link>
                </li>
                <li class="p-2">
                    <i></i>
                    <router-link to="/register">Registrovať sa</router-link>
                </li>
            </ul>
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
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {

    .v-enter-active {
        @apply transition-all ease-in duration-200
    }
    .v-leave-active {
        @apply transition-all ease-out duration-200
    }
    .v-enter-from,
    .v-leave-to {
        @apply transform -translate-y-full
    }
}
</style>