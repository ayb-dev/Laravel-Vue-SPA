window.Vue = require('vue')

import router from './rooter'
import App from './components/App.vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap'

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
