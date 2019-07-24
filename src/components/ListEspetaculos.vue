<template>
  <table>
    <thead>
      <tr>
        <th width="50" align="left">#</th>
        <th align="left">Nome</th>
        <th align="left">Quantidade Poltronas</th>
        <th align="left">Data</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, key) in espetaculos" :key="key">
        <td>{{ item.id }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.quantity_armchairs }}</td>
        <td>{{ item.date }}</td>
        <td>[<router-link to="/">Fazer reserva</router-link>] [<router-link :to="`/editar-espetaculo/${item.id}`">Editar espetaculo</router-link>] [<a href="#" @click="remove(item.id)">Excluir espetáculo</a>]</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import EspetaculoService from '../../services/EspetaculoService'
const Espetaculo = new EspetaculoService()

export default {
  name: 'list-espetaculos',

  data() {
    return {
      espetaculos: []
    }
  },

  mounted() { this.listEspetaculos() },

  methods: {
    /**
     * Remove espetaculo
     * @returns {void}
     */
    remove(id) {
      Espetaculo.remove({ id: id })
      this.listEspetaculos()
    },

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
