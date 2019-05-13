<template>
    <ul class="flex flex--horizontal">
        <li class="filter__item filter__item--open">Filtrar</li>
        <li class="filter__item">
            <!-- Calendar here!! -->
        </li>
        <!-- Not working yet -->
        <!-- <li class="filter__item" v-for="filtros in filtro" :key="filtro.id">
            <Filtro :filtro="filtro"></Filtro>
        </li> -->
    </ul>
</template>

<script lang="ts">
import Vue from 'vue'
import Filtro from '@/components/Filtro.vue';
export default Vue.extend({
    data(){
        return {
            filtros: null
        }
    },
    components:{
        Filtro
    }
    
})
</script>

<style lang="scss" scoped>


</style>

