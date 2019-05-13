<template>

    <div>
        <v-carousel>
            <v-carousel-item
            v-for="(local,i) in locales"
            :key="i">
                <Local :local="local"></Local>
            </v-carousel-item>
        </v-carousel>
    </div>
    
</template>

<script lang="ts">
import Vue from 'vue'
import Local from '@/components/Local.vue'
export default Vue.extend({

    components:{
        Local
    },

    computed:{

        locales():any{
            return this.$store.state.filtrados;
        }
    }
    
})
</script>


<style lang="scss" scoped>
 @import "../styles/style.scss"; 
</style>

