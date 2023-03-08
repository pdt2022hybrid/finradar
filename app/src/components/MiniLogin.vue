<template>
  <div :class="{invisible: Visible}">
    <form id="Login" class="bg-light flex w-1/6 items-center fixed right-32 border-2 rounded-xl p-5 mt-2 flex-col">
      <h1 class="text-4xl">Log In</h1>
      <input type="text" class="inputs mt-4 rounded" placeholder="mail">
      <input type="text" class="inputs rounded" placeholder="pass">
      <div class="flex items-center">
        <input type="checkbox" class="inputs">
        <p class="ml-2"> Remember me </p>
      </div>
      <button type="submit" form="Login" value="Submit"
      class="bg-green border p-1"
      >Submit</button>
      <div class="flex justify-around">
        <a href="/register">Sign up</a>
        <a href="/"> Forgot your password?</a>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "MiniLogin",
  props: {
    Visible: {
      type: Boolean,
      default: true
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