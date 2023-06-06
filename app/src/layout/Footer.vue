<template>
    <div class="flex flex-row bg-dark w-full py-7 justify-center font-varela mt-auto h-32" @mouseleave="popup = false">
        <div class="flex flex-row w-full items-center justify-evenly">
            <router-link to="/Pages">
                <p class="active:text-green">Mapa Stránok</p>
            </router-link>
            <div class="flex flex-row">
				<ul class="text-white text-center mt-11">
					Kontakt:
					<li class="opacity-80">Polak@openlab.sk</li>
					<li class="opacity-80">Vilagi@openlab.sk</li>
				</ul>
            </div>
        </div>
                <div v-if="popup" class="bg-white border border-b-searchborder absolute p-4 rounded-md right-64 mr-4">
                    <p class="text-dark mb-3 font-semibold">
                        Polak@openlab.sk
                    </p>
                    <p class="text-dark font-semibold">
                        Vilagi@openlab.sk
                    </p>
                </div>
    </div>
</template>

<script>
export default {
    name: "Footer",
    data() {
        return {
            popup: false,
        }
    }
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    p {
        @apply text-navtext;
    }
}
</style>
