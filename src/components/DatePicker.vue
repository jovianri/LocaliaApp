<template>

    <v-layout row wrap>
      <v-flex xs12 sm6 md4>
      <v-dialog
        ref="dialog"
        v-model="modal"
        :return-value.sync="date"
        persistent
        lazy
        full-width
        width="290px"
      >
        <v-text-field
          slot="activator"
          v-model="date"
          label="Picker in dialog"
          prepend-icon="event"
          readonly
        ></v-text-field>
        <v-date-picker v-model="date" style="color:black" scrollable>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="muestra">Cancel</v-btn>
          <v-btn flat color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
        </v-date-picker>
      </v-dialog>
    </v-flex>
 
    </v-layout>

</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
    data(){ // first
      return {
        date: new Date().toISOString().substr(0, 10),
        menu: false,
        modal: false,
        menu2: false
      }
    },

    methods:{
      muestra(){
        this.modal = false;
        console.log(this.date);
      }
    }

})
</script>


<style lang="scss">

</style>

