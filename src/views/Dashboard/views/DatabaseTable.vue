<template>
    <div>
        <!-- <div v-if="tablaNoExiste">
            <p>Esa tabla no existe</p>
        </div>
        <div v-else-if="!tablaNoExiste && esAdmin"> -->
            <h2>{{ tituloTabla }}</h2>
            <div class="table-responsive">
                <table class="table table-hover">

                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" v-for="columna in columnas" v-bind:key="columna">
                                {{ columna }}
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr v-for="linea in lineasTabla" v-bind:key="linea">
                            <td v-for="value in linea" v-bind:key="value">
                                {{ value }}
                            </td>
                            <td>
                                <button class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#actualizar" @click="actualizarFila(linea)">Actualizar</button>
                            </td>
                            <td>
                                <button class="btn btn-danger" @click="eliminarFila(linea)">Borrar</button>
                            </td>
                        </tr>
                    </tbody>

                </table>

                <div class="btn btn-info" data-dismiss="modal" data-toggle="modal"  @click="createRegistro()" data-target="#actualizar">Crear nuevo</div>

            </div>
        <!-- </div> -->
        <modal-update-create :opcion="tipoAccion" :datos="datos" :tabla="tabla"></modal-update-create>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import ModalUpdateCreate from '@/components/ModalUpdateCreate.vue'
export default Vue.extend({

    components: {
        ModalUpdateCreate
    },

    props:[
        'tabla'
    ],

    watch:{
        tabla: function(){
            this.tablaNoExiste = this.recargarTabla();
        }
    },

    mounted(){
        this.tablaNoExiste = this.recargarTabla();
    },

    methods:{
        recargarTabla(){
            switch(this.tabla){

                case 'locales':
                    this.$store.dispatch('traerTodos');
                return false;

                case 'ciudades':
                    this.$store.dispatch('traeCiudades');
                return false;

                case 'usuarios':
                    this.$store.dispatch('traeUsuarios');
                return false;

                case 'categorias':
                    this.$store.dispatch('cargarCategorias');
                return false;

                case 'pedidos':
                    this.$store.dispatch('traePedidos');
                return false;

                default:
                return true;

            }
        },

        createRegistro(){
            
            this.tipoAccion = "crear";
            let filaVacia:any = {};

            this.columnas.map( (columna:any) => {
                filaVacia[columna] = "";
            });

            this.datos = filaVacia;
        },

        eliminarFila(lineaBorrar:any){
            this.$store.dispatch("borrarRegistro", {linea : lineaBorrar.id, tabla: this.tabla});
        },

        actualizarFila(lineaActualizar:any){
            this.tipoAccion = "actualizar";
            this.datos = lineaActualizar;
            // this.mostrarModal = true;
        }
    },

    data(){
        return {
            datos: {},
            tipoAccion:""
        }
    },

    computed:{

        lineasTabla():any{
            switch(this.tabla){
                case 'locales':
                    return this.$store.getters.dameLocales;

                case 'ciudades':
                    return this.$store.getters.dameCiudades;

                case 'usuarios':
                    return this.$store.getters.dameUsuarios;

                case 'categorias':
                    return this.$store.getters.dameCategorias;

                case 'pedidos':
                    return this.$store.getters.damePedidos;

                default:
                    return true;

            }
        },

        columnas():any{

            let colsNames = [];

            for(let propertyName in this.lineasTabla[0]){
                colsNames.push(propertyName);
            }

            return colsNames;
        },

        tituloTabla():any{
            let upper = this.tabla.charAt(0).toUpperCase() + this.tabla.substr(1);
            return upper;
        },

        tablaNoExiste():any{
            return false;
        },

        esAdmin():any{
            return this.$store.getters.esAdmin;
        }
    }
})
</script>

