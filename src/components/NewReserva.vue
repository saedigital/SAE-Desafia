<template>
  <div v-if="espetaculo">
    <h2>Nova reserva (Espetáculo: {{ espetaculo.name }})</h2>

    <form class="form" @submit.prevent="validateBeforeSubmit">

      <div class="form__item" v-if="this.armchairsFree > 0">
        <label for="name_booking">Nome da pessoa</label>
        <input v-model="name_booking" type="text" name="name_booking" id="name_booking" v-validate="'required'">
        <div v-show="errors.has('name_booking')" class="form__item-error">{{ errors.first('name_booking') }}</div>
      </div>

      <div class="form__item">
        <h3>Descrição</h3>
        <p>{{ espetaculo.description }}</p>
      </div>

      <div class="form__item">
        <h3>Preço</h3>
        <p>23,76</p>
      </div>

      <div class="form__item">
        <h3>Poltronas livres</h3>
        <p>{{ armchairsFree }}</p>
      </div>

      <template v-if="this.armchairsFree > 0">
        <button type="submit">Confirmar nova reserva de poltrona no espetáculo</button>
      </template>
      <template v-else>
        <div class="form__item">
          <h3>Não é possível reservar novas poltronas.</h3>
        </div>
      </template>
      
      
    </form>
  </div>
</template>

<script>
import Vue from 'vue'
import VeeValidate from 'vee-validate'

import EspetaculoService from '../../services/EspetaculoService'
import ReservaService from '../../services/ReservaService'
const Espetaculo = new EspetaculoService()
const Reserva = new ReservaService()
Vue.use(VeeValidate)

export default {
  name: 'create-booking',

  data() {
    return {
      espetaculo: null,
      reservas: null,
      updated: false,
      name_booking: ''
    }
  },

  watch: {
    espetaculo: {
      handler: function () { this.updated = false },
      deep: true,
    },
  },

  computed: {
    armchairsFree: function() {
      return this.reservas && this.espetaculo ? this.espetaculo.quantity_armchairs - this.reservas.length : '-'
    }
  },

  mounted() {
    this.getData()
  },

  methods: {
    /**
     * 
     */
    getData() {
      Espetaculo.getEspetaculo({ id: this.$route.params.id })
        .then(success => this.espetaculo = success.data)
        .catch(error => console.error(error))
      Reserva.listBookings({ id: this.$route.params.id })
        .then(success => this.reservas = success.data)
        .catch(error => console.error(error))
    },

    /**
     * Create espetaculo
     * @returns {void}
     */
    createBooking() {
      if (this.armchairsFree <= 0) alert('Todas poltronas cheias.')
      Reserva.create({
        espetaculo_id: this.$route.params.id,
        name_booking: this.name_booking,
      }).then(success => {
        this.$router.push(`/reservas/${this.$route.params.id}`)
      }).catch(error => console.error(error))
    },

    /**
     * Valida o formulario
     * @returns {void}
     */
    validateBeforeSubmit() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.createBooking()
          return
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
