<template>
  <div>
    <div v-if="(logeado && usuario.admin)">
      <div class="dashboard">
        <h1 class="dashboard__title">Panel de Control</h1>
        <hr>
        <button class="dashboard__item" v-for="nombreTabla in tablas" v-bind:key="nombreTabla">
          <router-link
            class="btn btn-default dashboard__link"
            :to="{name: 'databaseTable', params: {tabla: nombreTabla}}"
          >{{ nombreTabla }}</router-link>
        </button>
        <hr>
        <transition name="fade" mode="out-in">
          <router-view></router-view>
        </transition>
      </div>
    </div>
    <div v-else>
      <h2>No tienes permiso para entrar en esta página</h2>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
export default Vue.extend({
  computed: {
    usuario(): any {
      return this.$store.getters.getUser;
    },
    logeado(): any {
      return this.$store.getters.logeado;
    },

    tablas(): any {
      return ["ciudades", "locales", "usuarios", "categorias", "pedidos"];
    },

    table(this: any): any {
      return this.$store.getters.tableSearched;
    }
  },

  methods: {
    mostrarTabla(tabla: any) {
      this.$store.dispatch("changeTableSearched", tabla);
    }
  }
});
</script>


<style lang="scss">
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.1s;
}
</style>
