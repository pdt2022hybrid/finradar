<template>
  <div class="flex justify-center">
    <div>
      <div>

      </div>
      <table class="w-4/5 bg-light">
        <thead class="border-2">
        <tr>
          <th>Meno</th>
          <th>Trzby</th>
          <th>Zisk</th>
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
    @apply border-2
  }
}
</style>