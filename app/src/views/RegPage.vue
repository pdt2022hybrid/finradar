<template>
  <div class=" text-center pt-12">
    <h1 class=" text-3xl font-bold">Registration</h1>
    <h2 class=" text-lg pt-14 font-semibold">Enter your information here to register an account</h2>
      <div class=" mr-96 ml-96 pt-8">
        <div class=" bg-light ml-48 mr-48 p-3">
          <p class="">E-mail</p>
          <input type="text" class="w-56">
          <p>Password (min. 8 characters)</p>
          <input type="text" class="w-56">
          <p>Confirm password</p>
          <input type="text" class="w-56">
          <button class="bg-green rounded mt-4 w-24 text-dark">Submit</button>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: "RegPage",
}
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;
</style>