<template>
  <div v-if="espetaculo && reservas">
    <h2>Lista de reservas (Espetáculo: {{ espetaculo.name }})</h2>

    <table>
      <thead>
        <tr>
          <th width="50" align="left">#</th>
          <th align="left">Nome da pessoa</th>
          <th align="left">Valor pago</th>
          <th align="left">Data da reserva</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in reservas" :key="key">
          <td>{{ item.id }}</td>
          <td>{{ item.name_booking }}</td>
          <td>{{ item.price }}</td>
          <td>{{ item.createdAt }}</td>
          <td>[<a href="#" @click="remove(item.id)">Deletar</a>]</td>
        </tr>
      </tbody>
    </table>

    <router-link v-if="this.armchairsFree > 0" :to="`/nova-reserva/${espetaculo.id}`"><button style="margin-top: 20px;">Fazer nova reserva</button></router-link>

    <div style="padding: 20px 0">
      <div>Total de arrecadação: {{ getTotal }}</div>
      <div>Poltronas livres: {{ armchairsFree }}</div>
      <div>Reservas: {{ reservas.length }}</div>
    </div>

  </div>
</template>

<script>
import EspetaculoService from '../../services/EspetaculoService'
import ReservaService from '../../services/ReservaService'
const Espetaculo = new EspetaculoService()
const Reserva = new ReservaService()

export default {
  name: 'list-reservas',

  data() {
    return {
      espetaculo: null,
      reservas: [],
    }
  },

  mounted() { this.getData() },

  computed: {
    getTotal() {
      return parseFloat(this.reservas.reduce(this.calculateTotal, 0)).toFixed(2)
    },

    armchairsFree: function() {
      return this.reservas && this.espetaculo ? this.espetaculo.quantity_armchairs - this.reservas.length : '-'
    }
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
     * Remove espetaculo
     * @returns {void}
     */
    remove(id) {
      Reserva.remove({ id: id })
      this.getData()
    },

    /**
     * Calculate total
     * @returns {decimal}
     */
    calculateTotal(productAccumulator, currentValue) {
      return parseFloat(productAccumulator) + parseFloat(currentValue.price)
    },
  }
}
</script>

<style lang="scss" scoped>
table {
  background: #ffff;
  padding: 40px;
  width: 100%;
  border-radius: 5px;
  
  th, td {
    padding-right: 15px;

    a {
      color: #3d88a0;
      text-decoration: none;

      &:hover {
        color: #274e5a;
      }
    }
  }
}
</style>
