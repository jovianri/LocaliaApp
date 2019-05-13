<template>

        <div class="grid grid--1col">
          <div class="grid--area1">
             <Slider></Slider>
          </div>

          <div class="grid--area2">
            <!-- <Favoritos></Favoritos>  -->
          </div>

        </div>

</template>

<script lang="ts">
import { Vue, Component } from "vue-property-decorator";
import Slider from '@/components/Slider.vue'
import Favoritos from '@/components/Favoritos.vue'

@Component({
  components: {
    Slider,
    Favoritos
  },
})
export default class Home extends Vue {}
</script>

<style lang="scss" scoped>
 @import "../styles/style.scss";

</style>
