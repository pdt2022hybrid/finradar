<template>
  <!-- mi je zle z tohto tailwindu -->
  <div class=" text-center pt-12">
    <h1 class=" text-4xl font-bold">Registration</h1>
    <h2 class=" mb-16 text-xl pt-14 font-semibold">Enter your information here to register an account</h2>
      <div class=" mb-48 mr-96 ml-96">
        <div class=" bg-light ml-48 mr-48 p-5 scale-110">
          <div class="pl-2 pr-2 m-1">
          <p class="text-left text-sm">Full name</p>
          <input type="text" class="text-center text-dark w-56 rounded">
          <p class="text-left text-sm">E-mail</p>
          <input type="text" class="text-center text-dark w-56 rounded">
          <p class="text-left text-sm">Password (min. 8 characters)</p>
          <input type="text" class="text-center text-dark w-56 rounded">
          <p class="text-left text-sm">Confirm password</p>
          <input type="text" class="text-center w-56 text-dark rounded">
          </div>
          <button class="bg-green rounded mt-4 w-24 text-dark scale-125">Submit</button>
        </div>
      </div>
  </div>
</template>
<script >
export default {
  name: "RegPage",
}
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;
</style>