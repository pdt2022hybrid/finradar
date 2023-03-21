<template>
    <div class="flex items-start flex-col">
      <h1 class="text-3xl font-bold"> Databázy </h1>
      <h3 class="text-xl"> Filtrovanie v databaze x</h3>
    </div>
    <div class="w-4/5 border-x border-t">
      <form class="bg-tables flex flex-row p-6">
        <div class="w-1/2 grid">
          <input type="text" class="label" placeholder="Meno / ICO firmy">
          <span class="inline-grid grid-cols-2">
            <input class="label" type="number" placeholder="trzby od">
            <input class="label" type="number" placeholder="trzby do">
            <input class="label" type="number" placeholder="zisk od">
            <input class="label" type="number" placeholder="zisk do">
          </span>
        </div>
        <div class="w-1/2 flex justify-end items-end">
          <button class="w-3/5 bg-blue p-1.5 rounded border border-">Hľadaj</button>
        </div>
      </form>
      <table class="bg-tables w-full">
        <thead class="border-y bg-dark">
        <tr>
          <th class="border-r">Meno</th>
          <th class="border-r">Trzby</th>
          <th class="">Zisk</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in this.Data.data">
          <td class="border-r"> {{ item }}</td>
          <td class="border-r"></td>
          <td></td>
        </tr>
        </tbody>
      </table>
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
    @apply border-y p-1.5
  }
  td, th {
    @apply p-1.5
  }
  .label {
    @apply m-1.5 p-1 bg-background rounded placeholder-dark placeholder-opacity-70
  }
}
</style>