<template>
	<div>
    <div class="flex-col lg:ml-52 lg:mt-16 flex items-start font-rubik">
      <h1 class="text-4xl mb-10 font-extrabold"> Databázy </h1>
      <h3 class="text-xl font-bold mb-4 indent-8"> Filtrovanie v databáze</h3>
    </div>
    <div class="flex flex-col items-center">
      <div class="flex-col flex w-3/4">
        <div class="lg:hidden bg-tables border" @click="mobile = !mobile">
            click to show filters
        </div>
        <transition>
          <form v-if="mobile === false" class="border-x border-t bg-tables flex lg:flex-row flex-col p-6" onsubmit="return false">
            <div class="lg:w-1/2 lg:grid flex flex-col w-full">
              <input type="text" class="label placeholder-dark placeholder:font-rubik" placeholder="Meno / IČO firmy" v-model="name">
              <span class="inline-grid lg:grid-cols-2 grid-cols-1">
                <input class="label" type="number" placeholder="Zisk od" v-model="profit.min">
                <input class="label" type="number" placeholder="Zisk do" v-model="profit.max">
                <input class="label" type="number" placeholder="Tržby od" v-model="revenue.min">
                <input class="label" type="number" placeholder="Tržby do" v-model="revenue.max">
              </span>
            </div>
            <div class="lg:w-1/2 w-full flex flex-wrap content-end lg:justify-end justify-center">
              <button class="w-3/5 bg-blue p-1.5 rounded border font-varela lg:h-1/3" @click="SetLink">
                Hľadaj
              </button>
            </div>
          </form>
        </transition>
        <table class="bg-tables border-x w-full font-varela">
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
              <router-link :to="{ name: 'company', params: { ico: item.ico } }" v-slot="{ redirect }">
                <h4 class="cursor-pointer w-fit" @click="redirect"> {{ item.name }} </h4>
              </router-link>
            </td>
            <td class="border-r text-center"> {{ item.latest_data.revenue }} €</td>
            <td class="text-center"> {{ item.latest_data.profits }} €</td>
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
      mobile: null,
      Data: [],
      per_page: null,
      revenue:{
        max: null,
        min: null,
      },
      profit: {
        max: null,
        min: null,
      },
      name: null,
    }
  },
  methods: {
    async SetLink() {
      try {
        await axios({
          url: '/companies',
          method: "get",
          params: {
            revenue_max: this.revenue.max,
            revenue_min: this.revenue.min,
            profits_max: this.profit.max,
            profits_min: this.profit.max,
            search_query: this.name,
            per_page: this.per_page,
          }
      }).then((response) => {
          console.log(response)
          this.Data = response.data.data
        })
      } catch (errors) {
        console.log(errors)
      }
    }
  },
  async mounted() {
    window.addEventListener("resize", () => {
      if (window.innerWidth > 999) {
          this.mobile = false
      } else {
          this.mobile = true
      }
    });
    try {
      await axios({
        url: '/companies',
        method: "get",
      }).then((response) => {
        console.log(response)
        this.Data = response.data.data
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
    @apply m-1.5 p-1 bg-background rounded placeholder-dark placeholder-opacity-70 placeholder:font-rubik
  }
  .v-enter-active {
      @apply transition-all ease-in duration-200
  }
  .v-leave-active {
      @apply transition-all ease-out duration-200
  }
  .v-enter-from,
  .v-leave-to {
      @apply transform translate-y-full
  }

}
</style>