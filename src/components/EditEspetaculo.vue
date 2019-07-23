<template>
  <div>
    <h2>Editando espetáculo</h2>

    <div v-if="updated" class="alert alert--success">Espetáculo alterado com sucesso.</div>

    <form v-if="espetaculo" class="form" @submit.prevent="validateBeforeSubmit">

      <div class="form__item">
        <label for="name">Nome do espetáculo</label>
        <input v-model="espetaculo.name" type="text" name="name" id="name" v-validate="'required'">
        <div v-show="errors.has('name')" class="form__item-error">{{ errors.first('name') }}</div>
      </div>

      <div class="form__item">
        <label for="description">Descrição</label>
        <textarea v-model="espetaculo.description" id="description" name="description" rows="5" v-validate="'required'" />
        <div v-show="errors.has('description')" class="form__item-error">{{ errors.first('description') }}</div>
      </div>

      <button type="submit">Editar espetáculo</button>
      
    </form>
  </div>
</template>

<script>
import Vue from 'vue'
import VeeValidate from 'vee-validate'

import EspetaculoService from '../../services/EspetaculoService'
const Espetaculo = new EspetaculoService()
Vue.use(VeeValidate)

export default {
  name: 'edit-espetaculo',

  data() {
    return {
      espetaculo: null,
      updated: false,
    }
  },

  mounted() {
    this.getDataEspetaculo()
  },

  methods: {
    /**
     * 
     */
    getDataEspetaculo() {
      Espetaculo.getEspetaculo({ id: this.$route.params.id })
        .then(success => this.espetaculo = success.data)
        .catch(error => console.error(error))
    },

    /**
     * Create espetaculo
     * @returns {void}
     */
    updateEspetaculo() {
      Espetaculo.update({
        id: this.$route.params.id,
        name: this.espetaculo.name
      }).then(success => {
        this.updated = true
      }).catch(error => console.error(error))
    },

    /**
     * Valida o formulario
     * @returns {void}
     */
    validateBeforeSubmit() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.updateEspetaculo()
          return
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
