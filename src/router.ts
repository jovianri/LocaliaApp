import Vue from "vue";
import Router from "vue-router";

// Views import
import Home from "./views/Home.vue";
import Busqueda from "./views/Busqueda.vue";
import Login from "./views/Login.vue";
import Usuario from "./views/Usuario.vue";
import AboutUs from "./views/AboutUs.vue";

// Dashboard imports
import Dashboard from "./views/Dashboard/Dashboard.vue";
import Overview from "./views/Dashboard/views/Overview.vue";
import DatabaseTable from "./views/Dashboard/views/DatabaseTable.vue";



Vue.use(Router);

export default new Router({
  routes: [
    {
      path: "/",
      name: "home",
      component: Home
    },
    {
      path: "/about",
      name: "about",
      component: AboutUs
    },
    {
      path: "/search",
      name: "Buscar",
      component: Busqueda,
    },
    {
      path: "/login",
      name: "Login",
      component: Login,
    },
    {
      path: "/usuario",
      name: "Usuario",
      component: Usuario,
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard,
      children: [
        {
          path: '/dashboard/:tabla',
          name: 'databaseTable',
          component: DatabaseTable,
          props: true,
        },
        {
          path: 'overview',
          name: 'overview',
          component: Overview
        },
      ]
      
    },
  ]
});
