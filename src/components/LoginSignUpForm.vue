<template>

<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../plugins/bootstrap.min.js"></script>
-->
    
<div>
    <!-- Modal -->
    <div class="modal fade" id="login" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Log in</h4>
                    <div class="btn btn-default btn--layout" data-dismiss="modal" data-toggle="modal" data-target="#registrar">Registrarse</div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p v-if="errors.length">
                        <b>Please correct the following error(s):</b>
                        <ul>
                            <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                        </ul>
                    </p>
                    <form id="form-login" @submit.prevent="login">
                        <div class="input-group input--layout">
                            <input type="email" class="form-control" id="emailLogin" name="emailLogin" placeholder="Email" v-model="user" required>
                        </div>
                        <div class="input-group input--layout">
                            <input type="password" class="form-control" id="passwordLogin" name="password" placeholder="Contraseña" v-model="pwd">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Login</button>
                            <button data-dismiss="modal" class="btn btn-default">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registrar" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar</h4>
                    <div class="btn btn-default btn--layout" data-dismiss="modal" data-toggle="modal" data-target="#login">Iniciar sesión</div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!--
                    <p v-if="errors.length">
                        <b>Please correct the following error(s):</b>
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </p>
                    -->
                    <form id="form-registrar" @submit.prevent="registrar">
                        <div class="input-group input--layout">
                            <input type="email" class="form-control" id="emailRegistro" name="email" placeholder="Email" v-model="emailRegistro" required>
                        </div>
                        <div class="input-group input--layout">
                            <input type="password" class="form-control" id="passwordRegistro" name="password" placeholder="Contraseña" v-model="passwordRegistro">
                        </div>
                        <div class="input-group input--layout">
                            <input type="password" class="form-control" id="passwordReRegistro" name="passwordRe" placeholder="Confirmar Contraseña" v-model="passwordReRegistro">
                        </div>
                        <div class="input-group input--layout">
                            <input type="text" class="form-control" id="nombreRegistro" name="nombre" placeholder="Nombre del usuario" v-model="nombreRegistro">
                        </div>
                        <div class="input-group input--layout">
                            <input type="text" class="form-control" id="apellidoRegistro" name="apellido" placeholder="Apellido del usuario" v-model="apellidoRegistro">
                        </div>
                        <div class="input-group input--layout">
                            <datepicker v-model="fechaNacimiento" input-class="w-100 form-control" format="dd/MM/yyyy" :language="es" ></datepicker>
                        </div>
                        <div class="modal-footer input--layout">
                            <button type="submit" class="btn btn-success">Registrar</button>
                            <button data-dismiss="modal" class="btn btn-default">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<script lang="ts">
import Vue from 'vue';
import DatePicker from '@/components/DatePicker.vue';
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'

export default Vue.extend({
    data(){
        return{
            errors:[],
            user:"",
            pwd:"",
            emailRegistro:"",
            passwordRegistro:"",
            passwordReRegistro:"",
            nombreRegistro:"",
            apellidoRegistro: "",
            fechaNacimiento: new Date(),
            es:es,
        }
    },
    /*
    validations: {
        form: {
            email: { required, email },
            password: { required, password},
            passwordRe: { required, password},
        }
    },
    */
    methods:{
        registrar:function(this:any) {
            this.errors = [];
            let errorCheck:boolean = false;
            if(this.emailRegistro === '') {
                this.errors.push("Email required.");
                errorCheck = true;
            }
            if (this.passwordRegistro === ''){
                this.errors.push("Password required.");
                errorCheck = true;
            }
            if (this.passwordReRegistro === ''){
                this.errors.push("Password check required.");
                errorCheck = true;
            }
            if(!errorCheck){
                alert("email: "+this.emailRegistro);
            }
            let datosRegistro = {
                nombre:this.nombreRegistro,
                apellidos:this.apellidoRegistro,
                email:this.emailRegistro,
                contrasenya:this.passwordRegistro,
                fechaNacimiento: this.fechaNacimiento.getFullYear() + "-" + this.fechaNacimiento.getMonth()+1 + "-" + this.fechaNacimiento.getDate()
            }
            this.$store.dispatch('registrar',datosRegistro);
        },

        login:function(this:any) { // comprobaciones
            this.errors = [];
            let errorCheck:boolean = false;
            if(this.user === '') {
                this.errors.push("Email required.");
                errorCheck = true;
            }
            if (this.pwd === ''){
                this.errors.push("Password required.");
                errorCheck = true;
            }
            if(!errorCheck){

                let datosUsu = { // logueo en la base de datos
                    user: this.user,
                    pwd: this.pwd
                }
                this.$store.dispatch('login', datosUsu);
            }
        }
    },

    components: {
        Datepicker
    }
})

</script>