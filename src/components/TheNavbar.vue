<template>
  <nav>
    <ul class="menu">
      <li class="menu__item"><router-link to="/">Espetáculos</router-link></li>
      <!-- <li class="menu__item"><router-link to="/reservas">Reservas</router-link></li> -->
    </ul>
    <div class="menu">
      <li class="menu__item menu__item--green"><router-link to="/novo-espetaculo">Novo espetáculo</router-link></li>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'the-navbar',
}
</script>

<style lang="scss" scoped>
nav {
  -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.18);
  -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.18);
  box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.18);
  background: #fff;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  display: flex;
  justify-content: space-between;

  .menu {
    display: flex;
    list-style: none;
    flex-wrap: wrap;

    &__item {
      a {
        display: flex;
        align-items: center;
        padding: 0 15px;
        height: 50px;
        text-decoration: none;
        color: #777;
        border-top: 3px solid transparent;
        border-bottom: 3px solid transparent;
        transition: all .2s;

        &:hover, &.router-link-exact-active {
          color: #000;
          border-bottom: 3px solid #333;
        }
      }

      &--green {
        a {
          background:#509850;
          color: #ffffff !important;

          &:hover, &.router-link-exact-active {
            border-bottom: 3px solid #2f632f;
          }
        }
      }
    }
  }
}
</style>
