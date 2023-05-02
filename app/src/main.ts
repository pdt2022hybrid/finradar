import {createApp} from 'vue'
import {createPinia} from 'pinia'

import App from './App.vue'
import router from './router'
import axios from "axios"
// @ts-ignore
import VueChartkick from 'vue-chartkick'
import LoadScript, {loadScript} from "vue-plugin-load-script";

import '@/assets/css/main.css'

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.use(VueChartkick)
app.use(LoadScript)
axios.defaults.baseURL = import.meta.env.VITE_APP_AXIOS_URL;
app.config.globalProperties.$axios = axios;

loadScript('https://www.gstatic.com/charts/loader.js')

app.mount('#app')
