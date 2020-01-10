// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import App from './App'
import Vue from 'vue'
import axios from 'axios';
import VueAxios from 'vue-axios';

import VueRouter from 'vue-router'
import Home from '@/components/Home'
import Calendar from '@/components/Calendar'
import Login from '@/components/Login'
import Register from '@/components/Register'


Vue.use(VueRouter)
Vue.use(VueAxios, axios);

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
const router = new VueRouter({
  mode: 'history',
  linkExactActiveClass: 'is-active',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
      meta: {
        auth: true
      }
    },

    {
      path:'/calendar/:id',
      name:'calendar',
      component:Calendar,
      meta: {
        auth: true
      }
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      meta: {
        auth: {roles: 1}

      }
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        auth: false
      }
    },




  ]
});


Vue.router = router
Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});



new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
