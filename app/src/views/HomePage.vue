<template>

<div class="wrapper">
	<header class="homepageHeader">
		<h1 class="header-text">Vyhľadávanie v Databáze Firiem</h1>
		<button class="header-btn text-dark">Vyhľadať firmu</button>
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
export default {
  name: "HomePage",
}
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;


@layer base {

	.wrapper{
		@apply bg-background min-h-screen

	}

	.homepageHeader{
		@apply  items-center text-center w-full mt-44
	}

	.header-text{
		@apply block font-rubik font-bold text-dark text-5xl

	}

	.header-btn{
		@apply text-center items-center  mt-20 mb-36 w-64 h-10 rounded-lg bg-green
	}

	.homepageMainContent{
		@apply bg-light flex place-content-evenly h-fit py-20 mb-60
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