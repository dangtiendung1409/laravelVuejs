import './bootstrap'
import {createApp} from "vue"
import { createPinia } from 'pinia'
import router from "../../routes/index.js"
import {
    Menu,
    List,
    Drawer,
    Button,
    message
} from 'ant-design-vue';
import App from './App.vue'

import 'ant-design-vue/dist/reset.css';
import 'bootstrap/dist/css/bootstrap-grid.min.css'
import 'bootstrap/dist/css/bootstrap-utilities.min.css'

const app = createApp(App);
const pinia = createPinia()

app.use(pinia)
app.use(router);
app.use(Menu);
app.use(List);
app.use(Button);
app.use(Drawer);
app.mount("#app");
app.config.globalProperties.$message = message;
