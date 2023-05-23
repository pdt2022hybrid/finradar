<template>
    <Loader v-if="!loaded"/>
    <div v-else>
    </div>
</template>

<script>
import Loader from "@/components/Loader.vue";

export default {
    name: "UserDashboard",
    components: {
        Loader
    },
    data() {
        return {
            loaded: false,
        }
    }
};
</script>
