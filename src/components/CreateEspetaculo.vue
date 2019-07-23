<template>
  <div>
    <h2>Criar espetáculo</h2>
    <form class="form" @submit.prevent="validateBeforeSubmit">

      <div class="form__item">
        <label for="name">Nome do espetáculo</label>
        <input v-model="espetaculo.nome" type="text" name="name" id="name" v-validate="'required'">
        <div v-show="errors.has('name')" class="form__item-error">{{ errors.first('name') }}</div>
      </div>

      <div class="form__item">
        <label for="description">Descrição</label>
        <textarea v-model="espetaculo.descricao" id="description" name="description" rows="5" v-validate="'required'" />
        <div v-show="errors.has('description')" class="form__item-error">{{ errors.first('description') }}</div>
      </div>

      <button type="submit">Criar espetáculo</button>
      
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
  name: 'create-espetaculo',

  data() {
    return {
      espetaculo: {
        nome: '',
        descricao: '',
      }
    }
  },

  methods: {
    createEspetaculo() {
      Espetaculo.create({
        name: this.espetaculo.nome
      }).then(success => {
        this.$router.push('/')
      }).catch(error => console.error(error))
    },

    /**
     * Valida o formulario
     * @returns {void}
     */
    validateBeforeSubmit() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.createEspetaculo()
          return
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
