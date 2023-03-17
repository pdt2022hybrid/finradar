<template>

  <div class="flex flex-col justify-center p-20 border-2">
    <div class="flex flex-col items-start underline border-r w-48 h-full">
      <h3>Vznik</h3>
      <h3>Sídlo</h3>
      <h3>CEO</h3>
      <h3>Počet Zamestnancov</h3>
      <h3>ICO</h3>

    </div>
    <div class="flex flex-col items-center">
      <h3>example</h3>
    </div>
  </div>

</template>

<script >
import axios from 'axios';
export default {
  name: "CompanyPage",
data() {
    return {
      Data: [],
    }
  },
  mounted() {
    axios
      .get('https://jsonplaceholder.typicode.com/todos/1')
      .then((response)=> {
        console.log(response);
      }) 
      .catch((errors)=> {
        console.log(errors);
      })
  }
}
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

</style>