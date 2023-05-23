<template>
    <table class="bg-gray w-full font-varela my-5 lg:my-16 rounded-lg">
        <thead class="bg-dark rounded-t-lg border-green">
            <tr class="">
                <th class="rounded-tl-xl">
                    <h4 class="text-background text-left pl-1">Názov</h4>
                </th>
                <th class="">
                    <h4 class="text-background">Tržby</h4>
                </th>
                <th class="rounded-tr-lg">
                    <h4 class="text-background">Zisk</h4>
                </th>
            </tr>
        </thead>
        <tbody v-if="companies === null">
            <!--          todo:urobit nech sa to hybe a nepulzuje-->
            <tr v-for="item in loading" class="animate-pulse">
                <td class="border-l border-b border-light tab tab w-4/6">
                    <div class="p-2.5 m-1 bg-background rounded"></div>
                </td>
                <td class="border-l border-b border-light tab w-1/6">
                    <div class="p-2.5 m-1 bg-background rounded"></div>
                </td>
                <td class="tab border-l border-b border-light tab w-1/6">
                    <div class="p-2.5 m-1 bg-background rounded"></div>
                </td>
            </tr>
        </tbody>
        <tbody v-else>
            <tr v-for="item in companies.data">
                <td
                    class="tab lg:w-4/6 w-3/6 lg:text-md border-b border-light hover:font-semibold active:text-green"
                >
                    <router-link
                        :to="{
                            name: 'company',
                            params: { ico: item.ico },
                        }"
                        v-slot="{ redirect }"
                    >
                        <h4 class="cursor-pointer w-fit pl-1" @click="redirect">
                            {{ item.name }}
                        </h4>
                    </router-link>
                </td>
                <td
                    class="text-center border-l border-b lg:text-md border-light tab lg:w-2/12 w-3/12"
                >
                    {{ item.latest_data.revenue }} €
                </td>
                <td
                    class="text-center border-l border-b lg:text-md border-light tab lg:w-2/12 w-3/12"
                >
                    {{ item.latest_data.profits }} €
                </td>
            </tr>
        </tbody>
    </table>
    <div v-if="companies !== null" class="flex flex-row justify-center">
        <div>
            <button
                class="focused p-3 bg-gray rounded-tl-lg rounded-bl-lg"
                @click="$.emit('firstPage')"
            >
                <i class="bi bi-chevron-double-left"></i>
            </button>
            <button class="focused p-3 bg-gray" @click="$.emit('prevPage')">
                <i class="bi bi-chevron-left"></i>
            </button>
            <input
                type="number"
                :max="companies.meta.last_page"
                min="1"
                class="p-3 bg-gray text-center"
                @keydown="$.emit('setPage', newPage)"
                @keypress.enter="$.emit('search')"
                v-model="newPage"
            />
            <button class="focused p-3 bg-gray" @click="$.emit('nextPage')">
                <i class="bi bi-chevron-right"></i>
            </button>
            <button
                class="focused p-3 bg-gray rounded-tr-lg rounded-br-lg"
                @click="$.emit('lastPage')"
            >
                <i class="bi bi-chevron-double-right"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "Table",
    data() {
        return {
            newPage: this.page,
        };
    },
    props: {
        per_page: null,
        page: null,
        companies: null,
    },
    computed: {
        loading() {
            return Array.from({ length: this.per_page }, () => []);
        },
    },
    watch: {
        newPage: function () {
            if (this.newPage > this.companies?.meta?.last_page) {
                this.newPage = 1;
            } else if (this.newPage < this.companies?.meta?.first_page) {
                this.newPage = this.companies?.meta?.last_page;
            }
        },
        page: function () {
            this.newPage = this.page;
        },
    },
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    tr > th,
    tr > td {
        @apply p-1.5;
    }

    td,
    th {
        @apply p-1.5;
    }

    .focused {
        @apply focus:bg-blue hover:bg-blue_light;
    }
}
</style>
