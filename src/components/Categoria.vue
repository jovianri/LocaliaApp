<template>
    <div @click="filtrar(categoria.id)" v-bind:class="{ selected : isClicked }">
        {{ categoria.nombre }}
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
    data(){
        return {
            isClicked: false,
        }
    },
    mounted(){

    },
    props:[
        'categoria',
    ],
    methods:{

        filtrar(cat:any){
            this.$store.dispatch('filtrar',cat);
        },
        
    },
    computed:{
    }

})
</script>


<style lang="scss" scoped>

</style>

