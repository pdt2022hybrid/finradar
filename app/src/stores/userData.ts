import { ref, computed } from "vue";
import { defineStore } from "pinia";

export const useUserInfo = defineStore('UserInfo', {
    state: () => {
        return {
            UserToken: null,
            UserData: [],
        }
    },
})
