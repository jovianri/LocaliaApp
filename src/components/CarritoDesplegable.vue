<template>

<div class="container">

  <div @click="changeVisibility">
    <img src="../icons/shopping_cart.png" alt="Shoppingcart">
  </div>

  <transition name="fade">
    <div class="shopping-cart" v-if="visibility">

      <div class="shopping-cart-header">
        <span class="badge">&nbsp;</span>
        <div class="shopping-cart-total">
          <span class="lighter-text">Total </span>
          <span class="main-color-text">{{ carrito.total }}€</span>
        </div>
      </div>

      <ul class="shopping-cart-items">

        <li class="clearfix" v-for="escogido in articulosEscogidos" :key="escogido.id">
          <!-- <img :src="'/img/'+escogido.local.nombreImg"/> -->
          <span class="item-name">{{ escogido.local.nombre }}</span>
          <span class="item-price">{{ escogido.local.precio * escogido.cantidad }}€</span>
          <span class="item-quantity">{{ escogido.cantidad }} uds.</span>

          <div class="item__buttons">
            <span class="item-add" @click="addProduct(escogido.local)">
              <img src="../icons/add_icon.png" alt="">
            </span>
            <span class="item-delete" @click="deleteProduct(escogido.local)">
              <img src="../icons/quit_icon.png" alt="">
            </span>
          </div>
          
        </li>

      </ul>

      <div v-if="logeado == 1">
        <a class="button" @click="comprar">Comprar</a> <!-- onclick -->
      </div>
      <div v-else>
        <div class="button" data-toggle="modal" data-target="#login"> Login</div>
      </div>

    </div>
  </transition>
  

</div>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({

    mounted(){

    },

    methods:{

      addProduct(this:any, local:any){
        this.$store.dispatch('anyadirCarrito', local);
      },

      deleteProduct(local:any){
        this.$store.dispatch('deleteOfCart',local);
      },

      changeVisibility(){      
        this.$store.dispatch('cambiarEstadoCarrito', !this.visibility);
      },

      comprar(){
        this.$store.dispatch('comprar');
      }

    },

    computed:{

      articulosEscogidos():any{
        return this.$store.getters.dameCarrito;
      },

      carrito():any{
        return this.$store.state.escogidosCarrito;
      },

      visibility():any{
        return this.$store.getters.estadoCarrito;
      }

    }

})
</script>


<style lang="scss" scoped>
    @import "../styles/style.scss";

</style>