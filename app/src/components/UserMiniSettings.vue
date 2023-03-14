<template>
  <!-- alex pls tailwind treba urobit
  ked Visible === true tak sa tomu da visibility: invisible -->
   <div :class="{invisible: this.Visible}"
        class="bg-light flex w-1/6 fixed right-32 border-2 rounded-xl p-5 mt-2 flex-col indent-2"
	>
     <header class="font-rubik font-medium text-lg border-b-2"> Smigus Dyngus </header>
     <router-link to="/dashboard" class="border-b-2 pt-2 pb-2 font-normal flex">
		<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1022px-Placeholder_view_vector.svg.png?20220519031949" alt=""
		class="w-5 h-5 indent-2 ml-2">
		<p>Dashboard</p>
    </router-link>
	<router-link to="/" class="border-b-2 pt-2 pb-2 flex">
		<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1022px-Placeholder_view_vector.svg.png?20220519031949" alt=""
		class="w-5 h-5 ml-2">
       	<p>Settings</p>
	</router-link>
    <router-link to="/" class="border-b-2 pt-2 pb-2 flex">
       		<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1022px-Placeholder_view_vector.svg.png?20220519031949" alt=""
			class="w-5 h-5 m-0 ml-2">
       		<p>Log Out</p>
	 </router-link>
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