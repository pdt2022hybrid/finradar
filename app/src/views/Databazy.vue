<template>
	<div>
    <div class="flex-col ml-52 mt-16 flex items-start font-rubik">
      <h1 class="text-4xl mb-10 font-extrabold"> Databázy </h1>
      <h3 class="text-xl font-bold mb-4 indent-8"> Filtrovanie v databáze</h3>
    </div>
    <div class="flex flex-col items-center">
      <div class="flex-col border-x border-t flex w-3/4 mb-28">
        <form class="bg-tables flex flex-row p-6" >
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
          <thead class="border-y bg-dark">
          <tr>
            <th class="border-r"> <h4 class="text-background">Názov</h4>
            </th>
            <th class="border-r"> <h4 class="text-background">Tržby</h4>
            </th>
            <th> <h4 class="text-background">Zisk</h4>
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="item in this.Data">
            <td class="border-r">
              <h4 class="cursor-pointer w-fit" @click="$router.go(-1)"> {{ item.name }} </h4>
            </td>
            <td class="border-r text-center"> {{ item.latest_data.capital }} €</td>
            <td class="text-center"> {{ item.latest_data.revenue }} €</td>
          </tr>
          </tbody>
          <tfoot>
          </tfoot>
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
  async mounted() {
    try {
      await axios.get('/api/companies')
          .then((response) => {
            console.log(response);
            this.Data = response.data.data;
          })
    } catch(errors) {
      console.log(errors);
    }
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