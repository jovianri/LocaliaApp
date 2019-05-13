<template>
    <transition name="modal">
    <div  class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              Modalidad : {{ opcion }}
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              {{ datos }}
              <button class="modal-default-button" @click="$emit('close')">
                OK
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
    props: [
      'datos', 'opcion'
    ],

    data(){
        return {
            showModal: false
        }
    },
    computed:{
      modal:{
        get(this:any):any{
          return false;
        },
        set(this:any, value:any):any{
          return true;
        }
      },
    }
})
</script>


<style lang="scss" scoped>
    @import "../styles/style.scss";
</style>

