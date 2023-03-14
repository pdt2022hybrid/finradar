<template>
  <!-- alex pls tailwind treba urobit
  ked Visible === true tak sa tomu da visibility: invisible -->
   <div :class="{invisible: this.Visible}"
        class="bg-light flex w-1/6 fixed right-32 border-2 rounded-xl p-5 mt-2 flex-col"
   >
     <header> Smigus Dyngus </header>
     <router-link to="/dashboard">
       <img src="" alt="dashboard">
       Dashboard
     </router-link>
     <router-link to="/">
       <img src="" alt="settings">
       Settings
     </router-link>
     <button>
       <img src="" alt="logout">
       Log out
     </button>
   </div>
</template>

<script >
export default {
  name: "UserMiniSettings",
  props: {
    Visible: {
      type: Boolean,
    }
  }
}
</script>

<style scoped>

</style>