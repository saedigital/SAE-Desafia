<template>
  <table>
    <thead>
      <tr>
        <th width="50" align="left">#</th>
        <th align="left">Nome</th>
        <th>Criado em</th>
        <th>Atualizado em</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, key) in list" :key="key">
        <td>{{ item.id }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.createdAt }}</td>
        <td>{{ item.updatedAt }}</td>
        <td>[<router-link to="/">Ver reservas</router-link>]</td>
        <td>[<router-link to="/">Editar espetaculo</router-link>]</td>
        <td>[<router-link to="/">Excluir</router-link>]</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: 'list-espetaculos',

  props: {
    list: { type: Array, required: true, }
  },
}
</script>

<style lang="scss" scoped>
table {
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
