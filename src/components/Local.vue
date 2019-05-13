<template>

    <div class="product-item" :id="local.id">
        <div class="product-item__image">
            <img :src="'/img/'+local.nombreImg" v-bind:alt="local.nombreImg">
        </div>
        <div class="product-item__content">
            <div class="product-item__title">{{ local.nombre }}</div>
            <div class="product-item__text">{{ local.ciudad }}</div>
            <div class="product-item__price">{{ local.precio }}€</div>
            <button class="btn" @click="anyadirCarrito(local)">Alquílame</button><!-- onclick="addToCart(this)" -->
            
            <button type="button" class="btn" @click="mostrarModal(local)">Vista rápida</button><!-- onclick="cargarDatosModal(this)" -->
        </div>
    </div>

</template>

<script lang="ts">
    import Vue from "vue";
    import axios from 'axios';
    import Articulo from '@/model/Articulo'
    export default {
        props: [
            'local',
        ],
        mounted() {
            
        },
        methods:{

            anyadirCarrito(this:any, local:any){
                this.$store.dispatch('anyadirCarrito', local);
                this.changeVisibility(true);
            },

            mostrarModal(this:any, local:any){
                this.$store.dispatch('seleccionarLocalModal', local);
                this.$store.dispatch('cambiarEstadoModalLocal',true);
            },

            changeVisibility(this:any, estado:any){      
                this.$store.dispatch('cambiarEstadoCarrito', estado);
            },
        },
        computed: {
            
        }
        
    }
</script>
<style lang="scss" scoped>

 @import "../styles/style.scss";

</style>


