import Vue from 'vue'
import Router from 'vue-router'
import Routes from './routes.js'
import App from './App.vue'
import Api from '@/api/api.js'
import State from '@/state.js'

Vue.config.productionTip = false

// Register vue-router
Vue.use(Router)

// Configure Axios
var api = new Api();
api.axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status == 404) {
            Routes.push({name: '404'})
        }

        return Promise.reject(error);
    }
);

// Register global variables
Vue.mixin({
    beforeCreate() {
        this.$api = api;
        Vue.util.defineReactive(this,"$state", State);
    }
})

// Init instance
var vue = new Vue({
  render: function (h) { return h(App) },
  el: '#app',
  router: Routes,
})
