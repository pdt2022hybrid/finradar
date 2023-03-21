<template>
	<div class="">
    <div class="flex-col ml-52 mt-16 flex items-start font-rubik">
      <h1 class="text-4xl mb-10 font-extrabold"> Databázy </h1>
      <h3 class="text-xl font-bold mb-2"> Filtrovanie v databáze</h3>
    </div>
	<div class="flex flex-col items-center">
    <div class="flex-col border-x border-t flex w-3/4 mb-28">
      <form class="bg-tables flex flex-row p-6">
        <div class="w-1/2 grid">
          <input type="text" class="label placeholder-dark placeholder:font-rubik" placeholder="Meno / IČO firmy">
          <span class="inline-grid grid-cols-2">
            <input class="label placeholder-dark placeholder:font-rubik" type="number" placeholder="Tržby od">
            <input class="label placeholder-dark placeholder:font-rubik" type="number" placeholder="Tržby do">
            <input class="label placeholder-dark placeholder:font-rubik" type="number" placeholder="Zisk od">
            <input class="label placeholder-dark placeholder:font-rubik" type="number" placeholder="Zisk do">
          </span>
        </div>
        <div class="w-1/2 flex justify-end items-end">
          <button class="w-3/5 bg-blue p-1.5 rounded border font-varela">Hľadaj</button>
        </div>
      </form>
      <table class="bg-tables w-full font-varela">
        <thead class="border-y bg-dark text-background">
        <tr>
          <th class="border-r">Názov</th>
          <th class="border-r">Tržby</th>
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