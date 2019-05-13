<template>
    <div class="flex flex--horizontal">
        <div class="categorias__item categorias__item--open" v-on:click="show = !show">Categorias</div>
        <transition name="fade">
            <div style="width:80%" v-if="show">
                <div class="categorias__item categorias__item--style" v-for="categoria in categorias" :key="categoria.id">
                    <Categoria :categoria="categoria"></Categoria>
                </div>
            </div>
        </transition>
        
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Categoria from '@/components/Categoria.vue'
export default Vue.extend({

    mounted(){
        this.$store.dispatch('cargarCategorias');
    },

    data(){
        return{
            show: false,
        }
    },

    computed:{

        categorias():any{
            return this.$store.state.categorias;
        }
    },

    components:{
        Categoria
    }
})
</script>


<style lang="scss" scoped>
@import "../styles/style.scss";

</style>
