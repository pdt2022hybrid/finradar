import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";
import axios from "axios";
// @ts-ignore

import "@/assets/css/main.css";

const app = createApp(App);

app.use(createPinia());
app.use(router);
axios.defaults.baseURL = import.meta.env.VITE_APP_AXIOS_URL;
app.config.globalProperties.$axios = axios;

app.mount("#app");
