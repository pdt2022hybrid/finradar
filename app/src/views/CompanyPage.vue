<template>
<div class=" flex justify-center lg:pt-10 pt-20">
  <div class="border-2 bg-tables grid-cols-3 grid lg:w-5/6">
     <div class="flex flex-col items-start p-6">
    <div class="name">
      <h3 class="">Vznik</h3>
      <h2 class="mt-2">{{ this.Data?.date_of_establishment }}</h2>
    </div>
      <div class="name flex-col">
      <h3 class="">Sídlo</h3>
      <h2 class="mt-2">{{ this.Data?.address?.city }} {{ this.Data?.address?.street }}</h2>
    </div>
      <div class="name">
      <h3 class="">CEO</h3>
    </div>
      <div class="name">
      <h3 class="">Počet Zamestnancov</h3>
    </div>
      <div class="name">
      <h3 class="">ICO</h3>
      <h2 class="mt-2">{{ this.Data?.ico }}</h2>
    </div>
  </div>
    <div class=" items-center border-l-2 p-1">
      <div class="flex flex-col justify-around">
        <h1 class="">Tržby</h1>
        <line-chart download="true" suffix="€" thousands=" " :colors="['blue', 'red']" :library="{
             curveType: 'function',
        backgroundColor: '#EFEFEF',
        hAxis: {
          title: 'Rok'
        },
        vAxis: {
          title: 'Hodnota (€)'
        }
        }" :min="null" :max="null" :data="this.Data?.graph_data?.revenue"></line-chart>
        <h1>Aktíva</h1>
        <pie-chart suffix="€" legend="bottom" thousands=" " :library="{
          is3D: true, legend: 'none', backgroundColor: '#EFEFEF',
        }" :data="[
          ['Financial accounts', this.Data?.latest_report?.assets?.financial_accounts_total],
          ['Financial assets', this.Data?.latest_report?.assets?.lt_financial_assets_total],
          ['Intangible assets', this.Data?.latest_report?.assets?.lt_intangible_assets_total],
          ['Tangible assets', this.Data?.latest_report?.assets?.lt_tangible_assets_total],
          ['Recievables total', this.Data?.latest_report?.assets?.st_receivables_total]]"></pie-chart>
          <div class="flex flex-col grid grid-cols-2 text-center">
            <div class="flex">
              <h4 class="leg text-white bg-blue rounded"> </h4>
              <h4 class="leg">Financial accounts</h4>
            </div>
            <div class="flex">
              <h4 class="leg text-white bg-red rounded"> </h4>
              <h4 class="leg">Financial assets</h4>
            </div>
            <div class="flex">
              <h4 class="leg text-white bg-yell rounded"> </h4>
              <h4 class="leg">Intangible assets</h4>
            </div>
            <div class="flex">
              <h4 class="leg text-white bg-green rounded"> </h4>
              <h4 class="leg">Tangible assets</h4>
            </div>
            <div class="flex">
              <h4 class="leg text-white bg-purp rounded"> </h4>
              <h4 class="leg">Recievables total</h4>
            </div>
          </div>
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
      <div class="items-center p-1">
      <div class="flex flex-col justify-around">
        <h1>Zisky</h1>
        <line-chart download="true" suffix="€" thousands=" " :colors="['blue', 'red']" :library="{
        curveType: 'function',
        backgroundColor: '#EFEFEF',
        hAxis: {
          title: 'Rok'
        },
        vAxis: {
          title: 'Hodnota (€)'
        }
        }" :min="null" :max="null" :data="this.Data?.graph_data?.profits"></line-chart>
        <h1>Pasíva</h1>
        <pie-chart suffix="€" legend="bottom" thousands=" " :library="{
          is3D: true, legend: 'none', backgroundColor: '#EFEFEF',
        }" :data="[
        ['Bank loans', this.Data?.latest_report?.liabilities?.bank_loans],
        ['Base capital', this.Data?.latest_report?.liabilities?.base_capital],
        ['Profit after tax', this.Data?.latest_report?.liabilities?.profit_for_period_after_tax],
        ['Reserves', this.Data?.latest_report?.liabilities?.reserves],
        ['LY result', this.Data?.latest_report?.liabilities?.result_last_year],
        ['Liabilities', this.Data?.latest_report?.liabilities?.st_labilities],]"></pie-chart>
            <div class="flex flex-col grid grid-cols-2 text-center mb-6">
        <div class="flex">
          <h4 class="leg text-white bg-blue rounded"> </h4>
          <h4 class="leg">Bank loans</h4>
        </div>
        <div class="flex">
          <h4 class="leg text-white bg-red rounded"> </h4>
          <h4 class="leg">Base capital</h4>
        </div>
        <div class="flex">
          <h4 class="leg text-white bg-yell rounded"> </h4>
          <h4 class="leg">Profit after tax</h4>
        </div>
        <div class="flex">
          <h4 class="leg text-white bg-purp rounded"> </h4>
          <h4 class="leg">LY result</h4>
        </div>
      </div>
     </div>
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
      await axios.get('/companies/' + ico)
      .then((response)=> {
        console.log(response);
        this.Data = response.data.data;
        console.log(this.Data); // toto odstranit potom
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
  @apply text-lg
}
h2  {
  @apply text-dark text-sm
}
h3 {
  @apply text-lg
}

  .value{
    @apply text-dark opacity-70 items-end
  }
  .leg{
    @apply text-sm pr-2 pl-2 mb-1 mr-2 h-4
  }
  .name{
    @apply border-b flex place-content-between pt-2 pb-2 border-b-navtext w-full
  }
}

</style>