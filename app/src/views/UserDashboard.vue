<template>
    <Loader v-if="!loaded"/>
    <div v-else>

    </div>
</template>

<script>
import Loader from "@/components/Loader.vue";
import Table from "@/components/Table.vue";

export default {
    name: "UserDashboard",
    components: {
        Loader
    },
    data() {
        return {
            loaded: true,
        }
    }
};
</script>
