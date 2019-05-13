<template>

    <div class="login">
        <div class="login__logo card">
            <img src="../icons/user_icon_big.png" alt="">
        </div>
        <div class="login__content card">
            <div class="username">
                <input type="text" placeholder="Usuario" v-model="user">
            </div>
            <div class="password">
                <input type="text" placeholder="Contraseña" v-model="pwd">
            </div>
        </div>
        <button @click="login" class="login__button btn btn-success">Loguearse</button>
    </div>

 

</template>

<style lang="scss" scoped>
    @import "../styles/style.scss";
</style>

<script lang="ts">

import Vue from 'vue';


export default Vue.extend({
    data(){
        return {
            user: "",
            pwd: "",
        }
        
    },
    components: {
    },

    methods:{
        login(this:any){
            let datosUsu = {
                user: this.user,
                pwd: this.pwd
            }

            this.$store.dispatch('login', datosUsu);
        }
    }
})
</script>
