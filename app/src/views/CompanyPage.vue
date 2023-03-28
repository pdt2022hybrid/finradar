<template>
<div class=" flex justify-center pt-10">
  <div class="border-2 bg-tables grid-cols-3 grid w-3/4">
    <div class="flex flex-col items-start p-6">
      <table>
        {{ this.Data.latest_data.full_report.assets.financial_accounts_total
 }}
      </table>
      <h3 class="border-b">Vznik</h3>
      <h3 class="border-b">Sídlo</h3>
      <h3 class="border-b">CEO</h3>
      <h3 class="border-b">Počet Zamestnancov</h3>
      <h3 class="border-b">ICO</h3>
    </div>
    <div class=" items-center p-6 border-l-2">
      <div class="flex flex-col justify-around">
        <h1 class="">Tržby</h1>
        <line-chart :data="{'2017-05-13': 2, '2017-05-14': 5}"></line-chart>
        <h1>Aktíva</h1>
        <pie-chart :data="[['Blueberry', this.Data.latest_data.full_report.assets.financial_accounts_total], ['Strawberry', 23]]"></pie-chart>
       <!--- <div class="flex flex-col text-left pt-10">
        <h2 class="">
          Broker Service Group ma 25% ^ zisk
        </h2>
        <h2>
          tento rok
        </h2>
        <h2>
          Trzby su 8 600 000 € 
        </h2>
        <h2>
          Firma nema dlhy / Firma dlzi X €
        </h2>
      </div>-->
      </div>
    </div>
      <div class="flex flex-col justify-around">
        <h1>Zisky</h1>
        <line-chart :data="{'2017-05-13': 2, '2017-05-14': 5}"></line-chart>
        <h1>Pasíva</h1>
        <pie-chart :data="[['Blueberry', 4], ['Strawberry', 10 ]]"></pie-chart>
      </div>
  </div>
  </div>
</template>

<script >
import axios from 'axios';
export default {
 data() 
  {
    return {Data:[]}
  },
  name: "CompanyPage",
  async mounted() {
    try {
      let ico = this.$route.params.ico
      console.log(ico);
      await axios.get('/api/companies/' + ico)
      .then((response)=> {
        console.log(response);
        this.Data = response.data.data;
        console.log(this.Data);
        console.log(this.Data.latest_data.full_report);
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
h1 {
font-size: larger;
}
}

</style>