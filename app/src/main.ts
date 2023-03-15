import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import axios from "axios"

import './assets/main.css'

const app = createApp(App)


app.use(createPinia())
app.use(router)
axios.defaults.baseURL = 'http://192.168.1.225:8088';
app.config.globalProperties.$axios = axios;


app.mount('#app')
