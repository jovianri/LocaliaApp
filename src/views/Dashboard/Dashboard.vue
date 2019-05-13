<template>
    <div class="dashboard">
        <h1 class="dashboard__title">Panel de Control</h1>
        <hr>
        <button class="dashboard__item" v-for="nombreTabla in tablas" v-bind:key="nombreTabla">
            <router-link class="btn btn-default dashboard__link" :to="{name: 'databaseTable', params: {tabla: nombreTabla}}">{{ nombreTabla }}</router-link>
        </button>
        <hr>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({

    computed:{
        tablas():any{
            return ['ciudades', 'locales', 'usuarios' ,'categorias', 'pedidos']
        },

        table(this:any):any{
            return this.$store.getters.tableSearched;
        }
    },

    methods:{
        mostrarTabla(tabla:any){
            this.$store.dispatch('changeTableSearched', tabla);
        },

    }
})
</script>


<style lang="scss">

  .fade-enter-active,
  .fade-leave-active {
    transition: opacity .1s
  }
</style>
