import Vue from "vue";
import '@fortawesome/fontawesome-free/css/all.css'
import './plugins/vuetify'
import Vuetify from "vuetify";
import BootstrapVue from "bootstrap-vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css'; // other version of bootstrap
import 'jquery/src/jquery.js';
import 'bootstrap/dist/js/bootstrap.min.js';

Vue.use(BootstrapVue);
Vue.use(Vuetify, {
  iconfont: 'fa'
 })

Vue.config.productionTip = false;

let myVue = new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
