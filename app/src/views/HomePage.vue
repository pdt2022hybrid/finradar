<template>

<div class="wrapper mb-24">
	<header class="homepageHeader mb-48">
		<h1 class="header-text">Vyhľadávanie v Databáze Firiem</h1>
		<form onsubmit="return false">
      <input type="text" class="header-input placeholder-light placeholder:mx-auto placeholder:font-varela font-varela focus:outline-none focus:ring-2 focus:border-background focus:ring-tables focus:shadow-2xl focus:placeholder-blue"
             v-model="name" placeholder="Vyhľadať firmu" @keyup="Search">
    </form>
    <div class="flex justify-center" v-if="name !== ''">
      <ul class="absolute w-64 bg-light rounded-md mx-auto z-10 -mt-2.5">
        <li v-for="item in this.companies" class="border-background border-b-2">
          <router-link :to="{ name: 'company', params: { ico: item.ico } }" v-slot="{ redirect }">
            <h4 class="cursor-pointer lg:w-fit mx-auto font-varela font-medium hover:font-semibold" @click="redirect"> {{ item.name }} </h4>
          </router-link>
        </li>
      </ul>
    </div>

	</header>
	<ul class="homepageMainContent">
		<li class="mainContentText">
			<h2 class="pb-6">Vitajte na stránke FinRadar!</h2>
			<p>Sme váš zdroj pre aktuálne finančné štatistiky a poznatky!
			   FinRadar ako online platforma poskytuje komplexné a spoľahlivé informácie o rôznych finančných ukazovateľoch a analýze údajov.
			   Bez ohľadu na to, či ste investor, obchodný profesionál alebo len záujemca o finančný svet, FinRadar je váš zdroj pre všetko súvisiace s finančnými štatistikami.
      		</p>
		</li>
		<li>
		  <img class="mainContentImage" src="@/assets/images/placeholder.png" alt="image">
		</li>
		<li class="mainContentText">
			<h2 class="pb-6 pt-6">Užívateľsky prívetivé rozhranie</h2>
			<p>FinRadar vám poskytuje všetko, čo potrebujete. Od interaktívnych grafov až po nekonečné databázy informácií.
				Vo FinRadare sa snažíme posilniť našich používateľov vedomosťami a nástrojmi, ktoré potrebujú na úspech v komplexnom svete financií.
				 Pripojte sa k nám na tejto finančnej ceste a odomknite moc dát s FinRadarom, najlepším zdrojom pre spoľahlivé finančné štatistiky a poznatky.
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
      companies: [],
    }
  },
  methods: {
    async Search() {
      if(this.name !== "") {
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
            this.companies = response.data.data
          })
        } catch (errors) {
          console.log(errors)
        }
      } else {
        this.companies = [];
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
		@apply flex w-96 flex-col text-xl text-dark font-normal text-center lg:text-left mb-10
	}

	.mainContentText h2{
		@apply lg:mb-10 text-center text-3xl font-rubik text-dark font-semibold
	}

	.mainContentImage {
		@apply lg:w-32 h-32 flex
	}

}
</style>