<template>
<div class=" flex justify-center pt-10">
  <div class="border-2 bg-tables grid-cols-3 grid w-3/4">
    <div class="flex flex-col items-start p-6">
      <h3 class="border-b">Vznik</h3>
      <h3 class="border-b">Sídlo</h3>
      <h3 class="border-b">CEO</h3>
      <h3 class="border-b">Počet Zamestnancov</h3>
      <h3 class="border-b">ICO</h3>
    </div>
    <div class=" items-center border-l-2 p-1">
      <div class="flex flex-col justify-around">
        <h1 class="">Tržby</h1>
        <line-chart download="true" :data="{'2017-05-13': 2, '2017-05-14': 5, '2017-05-15': 1, '2017-05-16': 3}"></line-chart>
        <h1>Aktíva</h1>
        <pie-chart suffix="€" legend="bottom" thousands=" " :data="[['Financial accounts', this.Data?.latest_data?.full_report?.assets?.financial_accounts_total],
          ['Financial assets', this.Data?.latest_data?.full_report?.assets?.lt_financial_assets_total],
          ['Intangible assets', this.Data?.latest_data?.full_report?.assets?.lt_intangible_assets_total],
          ['Tangible assets', this.Data?.latest_data?.full_report?.assets?.lt_tangible_assets_total],
          ['Recievables total', this.Data?.latest_data?.full_report?.assets?.st_receivables_total]]"></pie-chart>
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
        <line-chart download="true" :data="{'2017-05-13': 1, '2017-05-14': 4, '2017-05-15': 3, '2017-05-16': 6}"></line-chart>
        <h1>Pasíva</h1>
        <pie-chart suffix="€" legend="bottom" thousands=" " :data="[['Bank loans', this.Data?.latest_data?.full_report?.liabilities?.bank_loans],
        ['Base capital', this.Data?.latest_data?.full_report?.liabilities?.base_capital],
        ['Profit after tax', this.Data?.latest_data?.full_report?.liabilities?.profit_for_period_after_tax],
        ['Reserves', this.Data?.latest_data?.full_report?.liabilities?.reserves],
        ['LY result', this.Data?.latest_data?.full_report?.liabilities?.result_last_year],
        ['Liabilities', this.Data?.latest_data?.full_report?.liabilities?.st_labilities],]"></pie-chart>
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