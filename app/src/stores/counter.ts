import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

// ma z tohto jebne pre pana jana

interface State {
    UserList: UserData[]
    user: UserData | null

}
export const useUserStore = defineStore('LoggedIn', {
    state: (): State => {
        return {
            UserList: [],
            user: null,
        }
    },
})

interface UserData {
    id: string
    name: string
}