<template>

    <div class="menu">

        <FormLogSign/>

        <div class="menu__item menu__item--logo">
            <router-link to="/">
                <img src="../images/logo.png" alt="Localia Home" style="width:70px;">
            </router-link>
        </div>

        <div class="menu__item menu__item--default">
            <form class="form" v-on:submit.prevent="buscar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Lugares.." name="search" maxlength="50" id="ciudadBuscar" class="menu__search"><!-- v-model="ciudad" -->
                <router-link class="form__button" to="/search" tag="input" type="submit" value="Buscar" >Buscar</router-link>
            </form>
        </div>
        <div class="menu__item menu__item--content">
            <div @click="doDropdown">
                <img src="../icons/burger_menu.png" alt="">
            </div>
        </div>

        <transition name="fade">
        <div class="menu__item menu__item--layout">
            <div class="submenu-danger" id="submenuDanger">
                <div class="submenu-danger__item dropdown">

                    <div v-if="logeado == 1">
                        <img :src="'/img/users/'+ user.avatar" :attr="user" style="width:46px; height:46px; border-radius:50%;">
                        <div class="dropdown-content">
                            <div v-if="user.admin == 1">
                                <router-link class="btn btn-default width100" to="/dashboard" tag="input" type="submit" value="Panel de control">Panel de control</router-link>
                            </div>
                            <router-link class="btn btn-default width100" to="/usuario" tag="input" type="submit" value="Ver usuario">Ver usuario</router-link>
                            <div class="btn btn-default width100" @click="cerrarSesion">Cerrar sesión</div>
                        </div>
                    </div>
                    <div v-else>
                        <img src="../icons/user_icon.png" alt="">
                        <div class="dropdown-content">
                            <div class="btn btn-default width100" data-toggle="modal" data-target="#registrar"> Registrar</div>
                            <div class="btn btn-default width100" data-toggle="modal" data-target="#login"> Login</div>
                        </div>
                    </div>

                </div>
                <div class="submenu-danger__item">
                    <router-link to="/about">
                        <img src="../icons/info_icon.png" alt="" style="width:50px;">
                    </router-link>
                </div>
                <div class="submenu-danger__item">
                    <carrito-desplegable></carrito-desplegable>
                </div>
            </div>
        </div>
        </transition>

        <transition name="fade">
        <div class="menu__item menu__item--collapse" v-if="visibility">
            <div class="submenu-danger" id="submenuDanger">
                <div class="submenu-danger__item">
                    <div v-if="logeado">
                        <img :src="'/img/users/'+ user.avatar" :attr="user" style="width:46px; height:46px; border-radius:50%;">
                    </div>
                    <div v-else>
                        <router-link to="/login">
                            <img src="../icons/user_icon.png" alt="">
                        </router-link>
                    </div>
                </div>
                <div class="submenu-danger__item">
                    <router-link to="/about">
                        <img src="../icons/info_icon.png" alt="" style="width:50px;">
                    </router-link>
                </div>
                <div class="submenu-danger__item">
                    <carrito-desplegable></carrito-desplegable>
                </div>
            </div>
        </div>
        </transition>
        
    </div>
    
</template>

<script lang="ts">
import Vue from 'vue'
import CarritoDesplegable from '@/components/CarritoDesplegable.vue'
import FormLogSign from '@/components/LoginSignUpForm.vue'

export default Vue.extend({
    components:{
        CarritoDesplegable,
        FormLogSign
    },

    methods:{
        doDropdown(){
           this.visibility = !this.visibility;
        },

        cerrarSesion(){

            this.$store.dispatch('logout');
        }
    },

    data(){
        return {
            visibility: true
        }
    },

    computed:{

            logeado():any{
                return this.$store.getters.logeado;
            },
            user():any{
                return this.$store.getters.getUser;
            }
    }
    
})
</script>


<style lang="scss">

 @import "../styles/style.scss";

</style>
