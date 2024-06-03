 import './bootstrap';
 import * as bootstrap from 'bootstrap';
 import '@popperjs/core';
import '../sidebar/js/jquery.min';
import '../sidebar/js/main';
import '@vueform/multiselect/themes/default.css';
import { createApp } from "vue/dist/vue.esm-bundler.js";
import Departments from './components/Departments.vue';
import PermissionsCreate from './components/Permissions/PermissionsCreate.vue';
import FlashMessage from './components/FlashMessage.vue';
import Users from './components/Users/Users.vue';
import SideBar from './components/SideBar.vue';
import Multiselect from '@vueform/multiselect';
import axios from 'axios';
import store from './store';
// Import the store subscriber
import './store/subscriber';

window.bootstrap = bootstrap;
// default axios path

axios.defaults.baseURL = 'http://localhost:8000/api';
const app = createApp({});

app.component('flash-message',FlashMessage);
app.component('departments',Departments);
app.component('permissions-create',PermissionsCreate);
app.component('users',Users);
app.component('side-bar',SideBar);
app.component('Multiselect',Multiselect);

store.dispatch('auth/attempt',localStorage.getItem('token')).then(() => {

    app.use(store).mount('#app');
})
$('#navCollapse').on('click', function () {
    $('#navbarSupportedContent').toggleClass('collapse');
    });
$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
    });

