<template>
  <div class="busqueda">

      <div class="categorias">
        <Categorias></Categorias>
      </div>

      <div class="filter">
        <Filtros></Filtros>
      </div>

      <div class="flex flex--busqueda">

          <div class="flex__item--busqueda flex__item--locales">
            <Locales></Locales>
          </div>

          <div class="flex__item--busqueda flex__item--mapa">
            <Mapa></Mapa>
          </div>

      </div>

      <!-- <Messenger :message="message"></Messenger> -->

  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Locales from '@/components/Locales.vue'
import Mapa from '@/components/Mapa.vue'
import Filtros from '@/components/Filtros.vue'
import Categorias from '@/components/Categorias.vue'
import Messenger from '@/components/Messenger.vue'

export default Vue.extend({ 
  components:{
    Locales,
    Mapa,
    Filtros,
    Categorias,
    Messenger
  },

  data(){
    return {
      message:"Hola"
    }
  }
})
</script>


<style lang="scss" scoped>
 @import "../styles/style.scss";

</style>
