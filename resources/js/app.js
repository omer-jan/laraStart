require('./bootstrap');
window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'
window.Form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


import Router from './routes.js'
const app = new Vue({
    el: '#app',
    router:Router
});
