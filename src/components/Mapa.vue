<template>
  <div class="map" id="mapa" style="width: 100%px; height: 600px"></div>
</template>

<script lang="ts">
import Vue from "vue";
import {} from "googlemaps";
export default Vue.extend({
  mounted() {
    
    var mapOptions = {
      center: new google.maps.LatLng(39.475663, -0.376563),
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(
      document.getElementById("mapa"),
      mapOptions
    );
    setTimeout(() => {
      this.locales.map((local: any) => {
        var latLng = new google.maps.LatLng(local.latitud, local.longitud);
        // Creating a marker and putting it on the map
        var marker = new google.maps.Marker({
          position: latLng,
          title: local.nombre
        });
        marker.setMap(map);
      });
    }, 1);
  },
  computed:{
    locales():any{
      return this.$store.getters.dameLocales;
    }
  }
});
</script>

<style lang="scss" scoped>
</style>
