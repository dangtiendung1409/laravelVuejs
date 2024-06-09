import './bootstrap'
import {createApp} from "vue"
import { createPinia } from 'pinia'
import router from "../../routes/index.js"
import axios from 'axios'
window.axios = axios;
import {
    Select,
    Pagination,
    Checkbox,
    Input,
    Avatar,
    Table,
    Card,
    Menu,
    List,
    Drawer,
    Button,
    message
} from 'ant-design-vue';
import App from './App.vue'

import '../../static/fontawesome/css/all.min.css'
import 'ant-design-vue/dist/reset.css';
import 'bootstrap/dist/css/bootstrap-grid.min.css'
import 'bootstrap/dist/css/bootstrap-utilities.min.css'

const app = createApp(App);
const pinia = createPinia()

app.use(pinia)
app.use(router);
app.use(Pagination);
app.use(Checkbox);
app.use(Input);
app.use(Select);
app.use(Avatar);
app.use(Table);
app.use(Card);
app.use(Menu);
app.use(List);
app.use(Button);
app.use(Drawer);
app.mount("#app");
app.config.globalProperties.$message = message;
