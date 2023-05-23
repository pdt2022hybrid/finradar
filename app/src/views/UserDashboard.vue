<template>
    <Loader v-if="!loaded"/>
    <div v-else>
		<Table>
			<!-- ja sa do toho nevyznam pojebany  frontend -->
		</Table>

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
