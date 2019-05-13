<template>

<div>
    <div v-if="logeado">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h4>Perfil</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <form @submit.prevent="modificarUser">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-label"><label>Email</label>
                                                <input aria-describedby="addon-right addon-left" type="text" :value="usuario.email"
                                                    class="form-control valid" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group has-label"><label>Nombre</label>
                                                <input aria-describedby="addon-right addon-left" type="text" placeholder="Nombre"
                                                    class="form-control" v-model="usuario.nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-label"><label>Apellidos</label>
                                                <input aria-describedby="addon-right addon-left" type="text" placeholder="Apellidos"
                                                    class="form-control valid" v-model="usuario.apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-label"><label>Fecha de Nacimiento</label>
                                                <input aria-describedby="addon-right addon-left" type="text" placeholder="Fecha de nacimiento"
                                                    class="form-control valid" v-model="usuario.fechaNacimiento">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>Cambia tu foto de perfil</div>
                                            <input id="profile-image-upload" class="hidden" type="file" @change="avatarChange($event)">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="form__button">Modificar Datos</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                        </div>
                    </div>
                
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="card-body">
                                <div>
                                    <div class="author"><img :src="'/img/users/'+ usuario.avatar" alt="..." class="avatar border-gray">
                                        <h4>{{ usuario.nombre }} {{ usuario.apellidos }}</h4>
                                    </div>
                                </div>
                            </div>
                            <template>
                                <div class="card">
                                    <div class="card-body">
                                        <div v-if="lineasPedido != null">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Pedido</th>
                                                        <th scope="col">Local</th>
                                                        <th scope="col">Precio</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr v-for="lineaPedido in lineasPedido" v-bind:key="lineaPedido.id">
                                                        <td>{{lineaPedido.idPedido}}</td>
                                                        <td>{{lineaPedido.nombreLocal}}</td>
                                                        <td>{{lineaPedido.precioLocal}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div v-else>
                                            Aún no tienes pedidos!
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <h2>No has iniciado sesión</h2>
    </div>
</div>

</template>

<style lang="scss" scoped>
</style>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
    // mounted(){
    //     this.$store.dispatch('traePedidosUsuario',this.usuario.id)
    // },

    computed:{
        logeado():any{
            return this.$store.getters.logeado;
        },
        usuario():any{
            return this.$store.getters.getUser;
        },
        lineasPedido():any{
            return this.$store.getters.damePedidosUsuario;
        }
    },
    methods:{
        modificarUser(){
            console.log(this.usuario.avatar);
            let datosUsu = {
                id: this.usuario.id,
                nombre: this.usuario.nombre,
                apellidos: this.usuario.apellidos,
                fechaNacimiento: this.usuario.fechaNacimiento,
                avatar: this.usuario.avatar,
            }
            this.$store.dispatch('modificarUser', datosUsu);
        },
        avatarChange(event:any){
            this.usuario.avatar = event.target.files[0];
        }
    },
    
});
</script>