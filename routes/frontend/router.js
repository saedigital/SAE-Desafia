import Vue from 'vue'
import Router from 'vue-router'
import Home from '../../src/views/Home.vue'
import Espetaculos from '../../src/views/Espetaculos.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/espetaculos',
      name: 'espetaculos',
      component: Espetaculos,
    },
  ],
})
