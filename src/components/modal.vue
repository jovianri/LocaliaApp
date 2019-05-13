<template>
  <div class="text-xs-center">
    <v-dialog v-model="dialog" width="500">
      <v-card>

        <v-card-title class="modal__title headline lighten-2" primary-title>
          <div v-if="local != null">
            {{local.nombre}}
          </div>
        </v-card-title>

        <v-card-text>
          <div v-if="local != null">
            
            <div class="modal__slider">
              <v-carousel height="350px" :cycle="false">
              <v-carousel-item
                v-for="(fotoLocal,i) in fotosLocal"
                :key="i"
                :src="'/img/' + fotoLocal.nombreImg">
              </v-carousel-item>
              </v-carousel>
            </div>
            
            <v-divider></v-divider>

            <div class="modal__description">
              <div class="modal__item modal__item--city"> {{ local.ciudad }}</div>
              <div class="modal__item modal__item--address"> {{ local.direccion }} </div>
              <div class="modal__item modal__item--price"> {{ local.precio }}€</div>
            </div>

          </div>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions class="modal__options">
          <v-spacer></v-spacer>

          <v-btn color="info" flat @click="dialog = false">
             OK
          </v-btn>

          <v-btn color="success" flat @click="anyadirCarrito(local)">
            Alquilar
          </v-btn>

        </v-card-actions>

      </v-card>
    </v-dialog>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import Slider from "@/components/Slider.vue"
export default {
    
    methods:{
        anyadirCarrito(this:any, local:any){
            this.$store.dispatch('anyadirCarrito', local);
        }
    },
    
    computed: {

        dialog:{
          get(this:any):any{
            return this.$store.getters.dialog;
          },
          set(this:any, value:any):any{
            this.$store.dispatch('cambiarEstadoModalLocal',value);
          }
        },

        local(this:any):any{
          return this.$store.getters.localSeleccionado;
        },

        fotosLocal(this:any):any{
          return this.$store.getters.dameFotosLocales.filter( (fotoLocal:any) => fotoLocal.idLocal == this.local.id )
        }
    },

    components:{
      Slider
    }
    
}

</script>
<style lang="scss" scoped>

 @import "../styles/style.scss";

</style>