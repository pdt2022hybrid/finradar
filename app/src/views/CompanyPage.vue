<template>
<div class=" flex justify-center pt-10">
  <div class="border-2 bg-tables grid-cols-3 grid w-3/4">
     <div class=" flex-col items-start p-6 font-rubik">
    <div class="border-b-2 flex place-content-between pb-2">
      <h3 class="name">Vznik</h3>
      <h2 class="value ">{{ this.Data?.date_of_establishment }}</h2>
    </div>
      <div class="border-b-2 flex place-content-between pt-2 pb-2">
      <h3 class="name">Sídlo</h3>
      <h2 class="value">{{ this.Data?.address?.city }} {{ this.Data?.address?.street }}</h2>
    </div>
      <div class="border-b-2 flex place-content-between pt-2 pb-2">
      <h3 class="name">CEO</h3>
    </div>
      <div class="border-b-2 flex place-content-between pt-2 pb-2">
      <h3 class="name">Počet Zamestnancov</h3>
    </div>
      <div class="border-b-2 flex place-content-between pt-2 pb-2">
      <h3 class="name">IČO</h3>
      <h2 class="value">{{ this.Data?.ico }}</h2>
    </div>

  </div>
    <div class=" items-center border-l-2 p-1">
      <div class="flex flex-col justify-around">
        <h1 class="">Tržby</h1>
        <line-chart download="true" suffix="€" thousands=" " :min="null" :max="null" :data="this.Data?.graph_data?.revenue"></line-chart>
        <h1>Aktíva</h1>
        <pie-chart suffix="€" legend="bottom" thousands=" " :data="[
          ['Financial accounts', this.Data?.latest_report?.assets?.financial_accounts_total],
          ['Financial assets', this.Data?.latest_report?.assets?.lt_financial_assets_total],
          ['Intangible assets', this.Data?.latest_report?.assets?.lt_intangible_assets_total],
          ['Tangible assets', this.Data?.latest_report?.assets?.lt_tangible_assets_total],
          ['Recievables total', this.Data?.latest_report?.assets?.st_receivables_total]]"></pie-chart>
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
      <div class="flex flex-col justify-around p-1">
        <h1>Zisky</h1>
        <line-chart download="true" suffix="€" thousands=" " :min="null" :max="null" :data="this.Data?.graph_data?.profits"></line-chart>
        <h1>Pasíva</h1>
        <pie-chart class="" suffix="€" legend="bottom" thousands=" " :data="[
        ['Bank loans', this.Data?.latest_report?.liabilities?.bank_loans],
        ['Base capital', this.Data?.latest_report?.liabilities?.base_capital],
        ['Profit after tax', this.Data?.latest_report?.liabilities?.profit_for_period_after_tax],
        ['Reserves', this.Data?.latest_report?.liabilities?.reserves],
        ['LY result', this.Data?.latest_report?.liabilities?.result_last_year],
        ['Liabilities', this.Data?.latest_report?.liabilities?.st_labilities],]"></pie-chart>
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
  @apply text-dark text-lg
}
h3 {
  @apply text-lg
}

  .value{
    @apply text-dark opacity-70 items-end
  }

}

</style>