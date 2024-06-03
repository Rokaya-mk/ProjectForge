import $ from 'jquery';
import 'bootstrap';
import '@popperjs/core';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@/assets/sidebar/js/jquery.min'
import '@/assets/sidebar/js/main'
import '@vueform/multiselect/themes/default.css';
import Multiselect from '@vueform/multiselect';
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios';



window.$ = window.jQuery = require('jquery');

// @ means src
require('@/store/subscriber')

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

store.dispatch('auth/attempt',localStorage.getItem('token')).then(() => {

    createApp(App).use(store).use(router).mount('#app')
})