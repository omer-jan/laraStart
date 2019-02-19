require('./bootstrap');
window.Vue = require('vue');
// to display date in correct format
import moment from 'moment';// we must have it on our package.json file

// import vue progressbar
import VueProgressBar from 'vue-progressbar'

// import and use vform
import { Form, HasError, AlertError } from 'vform'
window.Form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


// import seet alert2
import swal from 'sweetalert2'

// we can use it in our app anywhere
window.swal = swal;
// include router.js file
import Router from './routes.js'

//////////////////////////////////////////////////////////// filter
// filter for to uppper case first letter of word
Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
});
// filter for to display date in correct way
Vue.filter('mydate', function(created){
    return moment(created).format('MMMM Do YYYY, h:mm:ss a');
});
// use the progress bar for more option use https://github.com/hilongjw/vue-progressbar
Vue.use(VueProgressBar,{
  color: 'green',
  failedColor:'red',
  thickness: '10px',
  height :'3px',
  transition: {
   speed: '0.1s',
   opacity: '0.6s',
   termination: 300
 },
})

/////////////////////////////// sweet alret
const Toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000
});
window.Toast = Toast;
////////////////////////////////
//////////////////////////////// for using emit we should do the following
// we use this when we want to use custome event
let Fire= new Vue();
window.Fire=Fire;
//////////////////////////////// passport
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
 

/////////////////////////////////
const app = new Vue({
    el: '#app',
    router:Router
});
