<template>
  <div id="app">
    <the-navbar />
    <router-view class="content-area" />
  </div>
</template>

<script>
import TheNavbar from './components/TheNavbar.vue'

export default {
  components: {
    TheNavbar,
  },
}
</script>


<style lang="scss">
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}

body {
  background: #f1f1f1;
  margin-top: 50px;
}

.content-area {
  padding: 30px;
}
</style>
