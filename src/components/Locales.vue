<template>
<div>
    <ul class="list">
        <li class="list__item" v-for="local in locales" :key="local.id"> <!-- Internally needs :key for identifying each local of locales  -->
            <Local :local="local"></Local><!-- Passing data to components through props -->
        </li>
    </ul>
    <Modal></Modal>
</div>
    
</template>

<script lang="ts">
import Vue from 'vue';
import Local from '@/components/Local.vue'
import {mapState} from "vuex";
import Modal from "@/components/modal.vue"

export default Vue.extend({

    mounted(){
        this.$store.dispatch('traerTodos');
    },

    methods:{
    },

    components: {
        Local,
        Modal
    },

    computed:{

        locales():any{
            return this.$store.state.filtrados;
        }
    }
})
</script>

<style lang="scss" scoped>

</style>


