import Vue from 'vue'
import Router from 'vue-router'
import Espetaculos from '../../src/components/ListEspetaculos.vue'
import CreateEspetaculo from '../../src/components/CreateEspetaculo.vue'
import EditEspetaculo from '../../src/components/EditEspetaculo.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'espetaculos',
      component: Espetaculos,
    },
    {
      path: '/novo-espetaculo',
      name: 'novo-espetaculo',
      component: CreateEspetaculo,
    },
    {
      path: '/editar-espetaculo/:id',
      name: 'editar-espetaculo',
      component: EditEspetaculo,
    },
  ],
})
