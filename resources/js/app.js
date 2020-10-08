import Vue from 'vue';
require('./bootstrap');
import VueToast from 'vue-toast-notification';
// Import one of available themes
import 'vue-toast-notification/dist/theme-default.css';
//import 'vue-toast-notification/dist/theme-sugar.css';
import Vuelidate from 'vuelidate';

Vue.use(Vuelidate);
Vue.use(VueToast);
Vue.component('add-event-page', require('./components/AddEvent').default);

new Vue({
    el: '#app'
        // mixins: [Sidebar],
        // data: {
        //     modal: false,
        //     url: null
        // }
});
