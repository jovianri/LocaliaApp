<template>

    <v-carousel>
        <v-carousel-item
        v-for="(imagen,i) in imagenes"
        :key="i"
        :src="'/img/' + imagen.nombre"
        >
            <hgroup class="slider__texto">
                <h1>ORGANIZA TUS EVENTOS</h1>
                <p>SIN PAPELEOS, SIN HISTORIAS</p>
            </hgroup>
        </v-carousel-item>
    </v-carousel>
    
</template>


<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
    mounted(){
        if(this.$store.getters.dameImagenesSlider.length == 0){
            this.$store.dispatch('traerImagenesSlider');
        }
    },
    computed:{
        imagenes():any{
            return this.$store.getters.dameImagenesSlider;
        }
    }
    
})
</script>


<style>

 @import "../styles/style.scss";

</style>
