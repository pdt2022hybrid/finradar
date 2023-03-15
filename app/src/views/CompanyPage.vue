<template>

  <div class="flex flex-col items-center border-2 p-20 m-20">
    <div class="flex flex-col items-start ">
    </div>
    <div class="grid-cols-1 grid-flow-col ">
      <h3>
        Vznik
      </h3>
      <h3>
        Sídlo
      </h3>
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