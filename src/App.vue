<template>
  <div id="app">
    <the-navbar />
    <div class="content-area">
      <router-view />
    </div>
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

h2 {
  margin-bottom: 20px;
}

.alert {
  background: #d4edda;
  border: 1px solid #c3e6cb;
  border-radius: 5px;
  padding: 15px;
  color: #155724;
  margin-bottom: 20px;
}

button {
  border: 0;
  background: #333;
  color: #fff;
  border-radius: 5px;
  height: 50px;
  padding: 0 15px;
  cursor: pointer;
  font-size: 16px;

  &:hover {
    opacity: 0.7;
  }
}

.form {
  width: 100%;
  max-width: 500px;

  &__item {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;

    label {
      width: 100%;
      margin-bottom: 5px;
    }

    input {
      width: 100%;
      height: 45px;
      border-radius: 5px;
      border: 1px solid #d6d6d6;
      outline: none;
      font-size: 18px;
      padding: 0 15px;
    }

    textarea {
      width: 100%;
      border-radius: 5px;
      border: 1px solid #d6d6d6;
      outline: none;
      font-size: 18px;
      padding: 15px;
    }

    &-error {
      color: red;
      margin-top: 5px;
    }
  }
}
</style>
