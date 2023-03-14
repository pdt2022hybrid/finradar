<template>
  <div class="flex items-center flex-col">
    <div class="flex items-start flex-col">
      <h1> Databazy </h1>
      <h3> Filtrovanie v databaze x</h3>
    </div>
    <div class="w-4/5">
      <div class="bg-tables flex flex-row p-6">
        <div class="w-1/2 grid">
          <input>
          <span class="inline-grid grid-cols-2">
            <input>
            <input>
            <input>
            <input>
          </span>
        </div>
        <div class="w-1/2">

        </div>
      </div>
      <table class="bg-tables">
        <thead class="border bg-dark">
        <tr>
          <th class="">Meno</th>
          <th class="">Trzby</th>
          <th class="">Zisk</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in this.Data">
          <td></td>
          <td></td>
          <td></td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Databazy",
  data() {
    return {
      Data: [],
    }
  },
  // funkcia, ktora sa spusti ked sa loadne page
  mounted() {
    axios
        // z tohto ulr to bere data a da to do response ako promise
        .get('https://jsonplaceholder.typicode.com/todos/1')
        // tunak manipulujeme s responsom a dame ho do premennej Data
        .then((response) => {
          console.log(response);
          this.Data = response;
          })
        .catch((errors) => {
          console.log(errors); // Errors
        });
  }
}
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
  tr > th, tr > td  {
    @apply border
  }
  td, th {
    @apply p-1.5
  }
  input {
    @apply m-1.5 rounded
  }
}
</style>