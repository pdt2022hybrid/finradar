<template>

<div class="wrapper">
	<header class="homepageHeader">
		<span class="header-text">Vyhľadávanie v Databáze Firiem</span>
		<button class="header-btn">Vyhľadať firmu</button>
	</header>

	<ul class="homepageMainContent">
		<li class="mainContentText">
			<h2>LOREM</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin non ultrices magna. Quisque euismod nunc vel enim auctor laoreet. Fusce sollicitudin ultrices augue, vitae consequat nulla fermentum ac. Morbi maximus. </p>
		</li>

		<li>
		<img class="mainContentImage" src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1022px-Placeholder_view_vector.svg.png" alt="">
		</li>

		<li class="mainContentText">
			<h2>LOREM</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin non ultrices magna. Quisque euismod nunc vel enim auctor laoreet. Fusce sollicitudin ultrices augue, vitae consequat nulla fermentum ac. Morbi maximus. </p>
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
		@apply  items-center text-center w-screen mt-44
	}

	.header-text{
		@apply block font-rubik font-bold text-textGrey text-4xl

	}

	.header-btn{
		@apply text-center items-center  mt-20 mb-36 w-64 h-10 rounded-lg bg-green
	}

	.homepageMainContent{
		@apply bg-backgroundLight flex place-content-evenly h-fit py-10
	}

	.mainContentText{
		@apply flex w-96 flex-col h-60 text-xl text-textGrey font-medium
	}

	.mainContentText h2{
		@apply mt-16 mb-10 text-center text-3xl font-rubik text-textGrey font-semibold
	}

	.mainContentImage{
		@apply w-32 h-32 flex border-2 mt-40
	}

}


</style>