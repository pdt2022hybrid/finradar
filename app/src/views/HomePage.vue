<template>

<div class="wrapper">
	<header class="homepageHeader">
		<h1 class="header-text">Vyhľadávanie v Databáze Firiem</h1>
		<form onsubmit="return false">
      <input type="text" class="header-btn placeholder-white font-varela" v-model="name" placeholder="Vyhľadať firmu" @keyup="Search">
	  <i class="bi bi-search text-sm absolute right-1/2 mr-16 top-2/4 mt-24 pt-9 text-white"></i>
      <button class="hidden" @click="Search"></button>
    </form>
    <ul>
      <li v-for="item in this.Data">
        <router-link :to="{ name: 'company', params: { ico: item.ico } }" v-slot="{ redirect }">
          <h4 class="cursor-pointer w-fit" @click="redirect"> {{ item.name }} </h4>
        </router-link>
      </li>
    </ul>
	</header>
	<ul class="homepageMainContent">
		<li class="mainContentText">
			<h2>LOREM</h2>
			<p>Lorem ipsum dolor sit amet,
        consectetur adipiscing elit. Proin non ultrices magna.
        Quisque euismod nunc vel enim auctor laoreet. Fusce
        sollicitudin ultrices augue, vitae consequat nulla fermentum
        ac. Morbi maximus.
      </p>
		</li>
		<li>
		  <img class="mainContentImage" src="" alt="image">
		</li>
		<li class="mainContentText">
			<h2>LOREM</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin non
        ultrices magna. Quisque euismod nunc vel enim auctor laoreet. Fusce
        sollicitudin ultrices augue, vitae consequat nulla fermentum ac.
        Morbi maximus.
      </p>
		</li>
	</ul>
</div>

</template>

<script>
import axios from "axios";

export default {
  name: "HomePage",
  data() {
    return {
      name: null,
      Data: [],
    }
  },
  methods: {
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
  }
}
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {

	.wrapper{
		@apply min-h-screen bg-background
	}

	.homepageHeader{
		@apply  items-center text-center w-full pt-44
	}

	.header-text{
		@apply block font-rubik font-bold text-dark text-5xl

	}

	.header-btn{
		@apply text-center items-center mt-20 mb-36 w-64 h-10 rounded-lg bg-blue
	}

	.homepageMainContent{
		@apply flex place-content-evenly h-fit py-20 pb-20 pb-40 bg-light
	}

	.mainContentText{
		@apply flex w-96 flex-col text-xl text-dark font-normal
	}

	.mainContentText h2{
		@apply mb-10 text-center text-3xl font-rubik text-dark font-semibold
	}

	.mainContentImage{
		@apply w-32 h-32 flex border-2 mt-40
	}

}
</style>