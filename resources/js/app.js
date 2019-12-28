window.Vue = require('vue')

import router from './rooter'
import App from './components/App.vue'
import store from './store';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap'

import BootstrapVue from 'bootstrap-vue'
import FlashMessage from '@smartweb/vue-flash-message';

Vue.use(BootstrapVue)
Vue.use(FlashMessage);


new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
