<template>
  <!-- mi je zle z tohto tailwindu -->
  <div class="mb-48 place-content-center flex ">
   <div class=" text-center pt-12 flex-row">
    <h1 class=" text-4xl font-bold">Registrácia</h1>
    <h2 class=" mb-16 text-xl pt-14 font-semibold">Sem zadajte Vaše informácie na registráciu profilu</h2>
        <form class=" bg-tables p-6 flex-row">
          <label class="block">
          <span class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700">
            Meno a Priezvisko
            </span>
            <input
              type="name"
              name="full name"
              class="mt-1 px-3 py-2 bg-white shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="Vaše meno a priezvisko">
          </label>
          <label class="block">
          <span class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700">
            E-mail
            </span>
            <input
              type="email"
              name="email"
              class="mt-1 px-3 py-2 bg-white shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="you@example.com" />
          </label>
          <label class="block">
          <span class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700">
            <span>Heslo (min. 8 znakov)</span>
            </span>
            <input
              type="password"
              name="passw"
              class="mt-1 px-3 py-2 bg-white shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="Vaše heslo" />
          </label>
          <label class="block">
          <span class="after:ml-0.5 after:text-red-500 block text-sm text-left font-medium text-slate-700">
            Potvrdenie Hesla
            </span>
            <input
              type="confirm pass"
              name="confpass"
              class="mt-1 px-3 py-2 bg-white shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="" />
          </label>
          <!-- <div class=""> -->
          <!-- <p class="text-left text-sm mb-1">Full name</p>
          <input type="text" class="bar">
          <p class="text-left text-sm mb-1">E-mail</p>
          <input type="text" class="bar">
          <p class="text-left text-sm mb-1">Password (min. 8 characters)</p>
          <input type="text" class="bar">
          <p class="text-left text-sm mb-1">Confirm password</p>
          <input type="text" class="bar">
          <button class="bg-green rounded mt-4 w-64 text-dark h-7">Submit</button>
          </div> -->
          <button class="bg-green rounded mt-6 w-full text-dark h-9">Potvrdiť	</button>
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
  .bar {
    @apply pl-1 mb-1 w-64 text-dark rounded bg-navtext h-7
  }
}

</style>