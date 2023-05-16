import { ref, computed } from "vue";
import { defineStore } from "pinia";
import axios from "axios";

export const useUserInfo = defineStore('UserInfo', {
    state: () => {
        return {
            UserToken: null,
            UserData: [],
        }
    },
})
