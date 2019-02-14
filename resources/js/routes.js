import VueRouter from 'vue-router';
import VueFilter from 'vue-filter';
import Vue from 'vue'

import Profile from './components/profile.vue'
import Dashboard from './components/dashboard.vue'
import Users from './components/users.vue'
Vue.use(VueRouter,VueFilter);


const router = new VueRouter
({

  mode: 'history',
    routes:
    [
        {  path:"/profile",component:Profile },
        {  path:"/dashboard",component:Dashboard },
        {  path:"/users",component:Users },
    ]
})
export default router
