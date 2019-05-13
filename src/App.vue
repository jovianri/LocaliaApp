<template>

    <div id="app" class="l-landing-page">
        <div class="l-landing-page__header">
            <Menu></Menu>
        </div>

        <div class="l-landing-page__content l-landing-page__content--style">
            <router-view/>
        </div>

        <div class="l-landing-page__footer"> 
            <Footer></Footer>
        </div>
    </div> 

</template>


<style lang="scss">
</style>

<script lang="ts">
import Vue from 'vue'
import { Component } from "vue-property-decorator"; 
import Menu from "@/components/Menu.vue"; // @ is an alias to /src
import Slider from "@/components/Slider.vue";
import Footer from "@/components/Footer.vue";

export default Vue.extend({
    components: {
        Menu,
        Slider,
        Footer
    }
    
})
</script>

<style lang="scss" scoped>
 @import "../styles/style.scss";
</style>