require('./bootstrap');
window.Vue = require('vue');
import Router from './routes.js'
const app = new Vue({
    el: '#app',
    router:Router
});
