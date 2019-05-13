<template>
    <div class="modal fade modal--actualizar" id="actualizar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="display-1"> {{ tituloModal }} registro </h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <hr>
                <div class="modal-body">
                    <div v-for="row in rows" v-bind:key="row">
                        <div v-if="row.propertyName === 'id'">
                            <label for="" class="columns">{{ row.propertyName }}</label>
                            <input type="text" class="form-control inputs" v-bind:value="row.value" disabled>
                        </div>
                        <div v-else>
                            <label for="" class="columns">{{ row.propertyName }}</label>
                            <input type="text" class="form-control inputs" v-bind:value="row.value">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" @click="createOrUpdate">{{ tituloModal }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
    props: [
      'datos', 'opcion', 'tabla'
    ],

    computed: {
        rows():any{

            let rows = [];

            for(let [propertyName, value] of Object.entries(this.datos)){
                rows.push({propertyName, value});
            }

            return rows;
        },

        tituloModal():any{
            let upper = this.opcion.charAt(0).toUpperCase() + this.opcion.substr(1);
            return upper;
        },

        fields():any{
            return [];
        }
    },

    methods:{
        createOrUpdate(){
            if(this.opcion === "crear"){

                let datosInputs = document.getElementsByClassName("inputs");
                let columnasInputs = document.getElementsByClassName("columns");
                let datosCrear:any = {};

                console.log(this.tabla)
                console.log(datosInputs)
                console.log(columnasInputs)

                for (let i = 0; i < datosInputs.length; i++) {
                    datosCrear[columnasInputs[i].innerHTML] = datosInputs[i].value;
                }

                // console.log(datosCrear);
                this.$store.dispatch("createRegistro", { lineaNueva: datosCrear, tabla: this.tabla});

            } else {
                let datosInputs = document.getElementsByClassName("inputs");
                let columnasInputs = document.getElementsByClassName("columns");
                let datosActualizar:any = {};

                for (let i = 0; i < datosInputs.length; i++) {
                    datosActualizar[columnasInputs[i].innerHTML] = datosInputs[i].value;
                }

                // console.log(datosActualizar);
                this.$store.dispatch("actualizarRegistro", { lineaActualizada: datosActualizar, tabla: this.tabla})
            }
        }
    },

    // data(){
    //     return {
    //         fields: []
    //     }
    // }
})
</script>


<style lang="scss" scoped>
    @import "../styles/style.scss";
</style>

