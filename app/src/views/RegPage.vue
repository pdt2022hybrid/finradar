<template>
  <!-- mi je zle z tohto tailwindu -->
  <div class="items-center flex flex-col mb-24">
    <div class="w-1/2 flex-col flex items-center">
      <h1 class="mt-16 text-3xl font-bold w-3/4">Registrácia</h1>
      <h2 class=" mb-4 text-xl mt-10 font-semibold w-3/4 indent-5">
        Sem zadajte Vaše informácie na registráciu profilu
      </h2>
    </div>
    <div class="flex justify-center w-1/2">
        <form class=" bg-tables p-6 px-16 w-3/4">
          <label class="block">
            <span class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700 mb-2">
            Meno a Priezvisko
            </span>
            <input
              type="name"
              name="full name"
              class="mt-1 px-3 py-2 bg-background shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="Vaše meno a priezvisko">
          </label>
          <label class="block">
            <span class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700 my-2">
            E-mail
            </span>
            <input
              type="email"
              name="email"
              class="mt-1 px-3 py-2 bg-background shadow-sm border-slate-300 placeholder-slate-400 outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="name@example.com" />
          </label>
          <label class="block">
            <span class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700 my-2">
              <span>Heslo (min. 8 znakov)</span>
            </span>
            <input
              type="password"
              name="passw"
              class="mt-1 px-3 py-2 bg-background shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="Vaše heslo" />
          </label>
          <label class="block">
          <span class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700 my-2">
            Potvrdenie Hesla
            </span>
            <input
              type="confirm pass"
              name="confpass"
              class="mt-1 px-3 py-2 bg-background shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="" />
          </label>
          <button class="bg-blue rounded mt-6 mb-2 w-full text-dark font-bold h-9">Potvrdiť	</button>
        </form>
    </div>
  </div>
</template>
<script >
export default {
  name: "RegPage",
}
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {

}
</style>