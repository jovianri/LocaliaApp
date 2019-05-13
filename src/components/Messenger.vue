<template>
    <div class="messenger">
        <div> {{ message }} </div>
        <div> </div>
    </div>    
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
    props:[
        'message'
    ]
    
})
</script>


<style lang="scss" scoped>
     @import "../styles/style.scss";
</style>
