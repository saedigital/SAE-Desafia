<template>
  <div>
    <list-espetaculos :list="espetaculos" />
  </div>
</template>

<script>
import ListEspetaculos from '../components/ListEspetaculos.vue'

import EspetaculoService from '../../services/EspetaculoService'
const Espetaculo = new EspetaculoService()

export default {
  name: 'espetaculos',

  components: {
    ListEspetaculos,
  },

  data() {
    return {
      espetaculos: []
    }
  },

  mounted() {
    this.listEspetaculos()
  },

  methods: {
    /**
     * List espetaculos
     * @returns {void}
     */
    listEspetaculos() {
      Espetaculo.getAll()
        .then(list => this.espetaculos = list.data)
        .catch(error => console.error(error))
    }
  }
};
</script>
