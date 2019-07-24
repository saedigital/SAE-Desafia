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

      <div class="form__item">
        <label for="poltronas">Número de poltronas</label>
        <input v-model="espetaculo.poltronas" type="text" name="poltronas" id="poltronas" v-validate="'required'">
        <div v-show="errors.has('poltronas')" class="form__item-error">{{ errors.first('poltronas') }}</div>
      </div>

      <div class="form__item">
        <label for="data">Data</label>
        <input placeholder="2019-07-24 03:03:49" v-model="espetaculo.data" type="text" name="data" id="data" v-validate="'required'">
        <div v-show="errors.has('data')" class="form__item-error">{{ errors.first('data') }}</div>
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
        data: '',
        poltronas: '',
      }
    }
  },

  methods: {
    /**
     * create espetaculo
     * @returns {void}
     */
    createEspetaculo() {
      Espetaculo.create({
        name: this.espetaculo.nome,
        description: this.espetaculo.descricao,
        date: this.espetaculo.data,
        quantity_armchairs: this.espetaculo.poltronas,
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
