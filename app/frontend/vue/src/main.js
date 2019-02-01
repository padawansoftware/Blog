import Vue from 'vue'
import Router from 'vue-router'
import Routes from './routes.js'
import App from './App.vue'
import Api from '@/api/api.js'

Vue.config.productionTip = false

Vue.use(Router)

var vue = new Vue({
  render: function (h) { return h(App) },
  el: '#app',
  router: Routes,
})


// Configure Axios

var api = new Api();

Vue.mixin({
    beforeCreate() {
        this.$api = api;
    }
})

api.axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status == 404) {
            Routes.push({name: '404'})
        }

        return Promise.reject(error);
    }
);
