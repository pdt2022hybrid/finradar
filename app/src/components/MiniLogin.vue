<template>
  <div :class="{invisible: this.Visible}">
    <form id="Login" class="bg-light flex w-1/5 items-center fixed right-32 border-2 rounded-xl p-5 mt-2 flex-col">
      <h1 class="text-4xl">Log In</h1>
      <input type="text" class=" w-52 inputs mt-4 mb-2 rounded" placeholder="e-mail">
      <input type="text" class=" w-52 inputs rounded" placeholder="password">
      <div class=" w-full pl-7 flex items-center justify-start">
        <input type="checkbox" class="inputs">
        <p class="ml-2 font-rubik"> Remember me </p>
      </div>
      <button type="submit" form="Login" value="Submit"
      class="bg-green border p-1 w-52 py-1 rounded-xl border-dark border-opacity-75 border-2 font-medium "
      >Submit</button>
      <div class=" pt-4 text-xs w-full text-underline underline underline-offset-1 flex justify-around">
        <a href="/register" class="w-18">Sign up</a>
        <a href="/" class="w-30"> Forgot your password?</a>
      </div>
    </form>
  </div>
</template>

<script >
export default {
  name: "MiniLogin",
  props: {
    Visible: {
      type: Boolean,
    }
  }
}
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {

  .inputs {
    @apply bg-background h-1/4 my-2.5 py-1 px-3
  }

}
</style>