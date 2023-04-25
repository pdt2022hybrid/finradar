<template>

<div class="wrapper mb-24">
	<header class="homepageHeader mb-48">
		<h1 class="header-text">Vyhľadávanie v Databáze Firiem</h1>
		<form onsubmit="return false">
      <input type="text" class="header-input placeholder-light placeholder:mx-auto placeholder:font-varela font-varela focus:outline-none focus:ring-2 focus:border-background focus:ring-tables focus:shadow-2xl focus:placeholder-blue"
             v-model="name" placeholder="Vyhľadať firmu" @keyup="Search">
      <button class="hidden" @click="Search"></button>
    </form>
    <div class="flex justify-center">
      <ul class="absolute w-64 bg-light rounded-md mx-auto z-10 -mt-2.5">
        <li v-for="item in this.Data" class="border-background border-b-2">
          <router-link :to="{ name: 'company', params: { ico: item.ico } }" v-slot="{ redirect }">
            <h4 class="cursor-pointer lg:w-fit mx-auto font-varela font-medium hover:font-semibold" @click="redirect"> {{ item.name }} </h4>
          </router-link>
        </li>
      </ul>
    </div>

	</header>
	<ul class="homepageMainContent">
		<li class="mainContentText">
			<h2 class="pb-6">LOREM</h2>
			<p>Lorem ipsum dolor sit amet,
        consectetur adipiscing elit. Proin non ultrices magna.
        Quisque euismod nunc vel enim auctor laoreet. Fusce
        sollicitudin ultrices augue, vitae consequat nulla fermentum
        ac. Morbi maximus.
      </p>
		</li>
		<li>
		  <img class="mainContentImage" src="@/assets/images/placeholder.png" alt="image">
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
              per_page: 8,
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
		@apply
				lg:min-h-screen bg-background
	}

	.homepageHeader{
		@apply  lg:items-center text-center w-full pt-44

	}

	.header-text{
		@apply lg:block font-rubik font-bold text-dark text-5xl

	}

	.header-input{
		@apply text-center items-center mt-20 w-64 lg:w-3/12 h-10 rounded-lg bg-blue lg:h-12

	}

	.homepageMainContent{
		@apply flex items-center flex-col lg:flex-row lg:place-content-evenly h-fit py-16 bg-light
	}

	.mainContentText{
		@apply flex w-96 flex-col text-xl text-dark font-normal text-center lg:text-left my-10
	}

	.mainContentText h2{
		@apply lg:mb-10 text-center text-3xl font-rubik text-dark font-semibold
	}

	.mainContentImage {
		@apply lg:w-32 h-32 flex
	}

}
</style>