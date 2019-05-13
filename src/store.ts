import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import Repository from './model/Repository';
import Carrito from './model/Carrito';

let repo: Repository = new Repository();
let carrito: Carrito = new Carrito(1, []);

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    locales:    [],
    filtrados:  [],
    categorias: [],
    ciudades:   [],
    usuarios:   [],
    pedidos:    [],

    imagenesSlider: [],
    fotosLocales: [],

    escogidosCarrito:carrito,
    modalLocalAbierto:false,
    shoppingVisibility:false,
    localSeleccionado:null,
    logeado:false,
    usuario:null,
    esAdmin: true,
    tableToSearch: "no table",
    pedidosUsuario:null
  },

  getters: {
    dameLocales:        state => state.locales,
    dameCarrito:        state => state.escogidosCarrito.getLocales(),
    dameCategorias:     state => state.categorias,
    dameCiudades:       state => state.ciudades,
    dameUsuarios:       state => state.usuarios,
    damePedidos:        state => state.pedidos,
    damePedidosUsuario: state => state.pedidosUsuario,

    dameImagenesSlider: state => state.imagenesSlider,
    dameFotosLocales:   state => state.fotosLocales,
    dialog:             state => state.modalLocalAbierto,
    localSeleccionado:  state => state.localSeleccionado,
    estadoCarrito:      state => state.shoppingVisibility,
    logeado:            state => state.logeado,
    getUser:            state => state.usuario,
    esAdmin:            state => state.esAdmin,
    tableSearched:      state => state.tableToSearch
  },

  mutations: {
    traerTodos: (state, locales) => {
      state.locales = locales
      state.filtrados = locales;
    },

    cargarCategorias: (state, categorias) => {
      state.categorias = categorias;
    },

    traerImagenesSlider(state, imagenesSlider){
      state.imagenesSlider = imagenesSlider;
    },

    addToCart(state, local){
      state.escogidosCarrito.addProduct(local);
    },

    deleteOfCart(state, local){
      state.escogidosCarrito.deleteProduct(local);
    },

    filtrados(state, localesFiltrados){
      state.filtrados = localesFiltrados;
    },
    cambiarEstadoModalLocal(state, estado){
      state.modalLocalAbierto = estado;
    },

    cambiarEstadoCarrito(state, estado){
      state.shoppingVisibility = estado;
    },

    seleccionarLocalModal(state, local){
      state.localSeleccionado = local;
    },

    traerFotosLocales(state, fotosLocales){
      state.fotosLocales = fotosLocales;
    },

    comprar(state){
      repo.insertCarrito(state.escogidosCarrito);
    },

    login(state, respuesta){

      if(respuesta.logeado){
        state.usuario = respuesta.usuario;
        state.logeado = respuesta.logeado;
      }
    },

    modificarUser(state, respuesta){
      if(respuesta.ok){
        alert("Cambios efectuados");
      }
    },

    logout(state){
      state.usuario = null;
      state.logeado = false;
    },

    changeTableSearched(state, newTable){
      state.tableToSearch = newTable;
    },

    cargarCiudades(state, ciudadesBD){
      state.ciudades = ciudadesBD;
    },

    cargarUsuarios(state, usuariosBD){
      state.usuarios = usuariosBD;
    },

    cargarPedidos(state, pedidosBD){
      state.pedidos = pedidosBD;
    },
    cargarPedidosUsuario(state,pedidosBD){
      state.pedidosUsuario = pedidosBD;
    }

  },

  actions: {

    filtrar({ commit }, categoria) {
      repo.getLocalesByCategoria(commit, categoria);
    },

    traerTodos({ commit }){
      repo.getLocales(commit);
    },

    cargarCategorias({ commit }){
      repo.getCategorias(commit);
    },

    traerImagenesSlider({ commit }){
      repo.getImagenesSlider(commit);
    },

    anyadirCarrito({ commit }, local){
      commit('addToCart', local);
    },

    deleteOfCart({ commit }, local){
      commit('deleteOfCart', local)
    },

    cambiarEstadoModalLocal({ commit }, estado){
      commit('cambiarEstadoModalLocal', estado);
    },

    cambiarEstadoCarrito({ commit }, estado){
      commit('cambiarEstadoCarrito', estado);
    },

    seleccionarLocalModal({ commit }, local){
      commit('seleccionarLocalModal', local);
    },

    comprar({ commit }){
      commit('comprar');
    },
    
    registrar({commit},datosRegistro){
      repo.registro(datosRegistro);
    },

    login(context, datosUsu){ /* ****************************** */
      repo.logIn(context, datosUsu.user, datosUsu.pwd);
    },

    modificarUser({ commit }:any, datosUsu:any){
      repo.modificarUser(commit, datosUsu.id,datosUsu.nombre, datosUsu.apellidos, datosUsu.fechaNacimiento, datosUsu.avatar);
    },

    logout({ commit }){
      commit('logout');
    },

    changeTableSearched({ commit }, newTable){
      commit('changeTableSearched', newTable);
    },

    traeCiudades({ commit }){
      repo.getCiudades(commit);
    },

    traeUsuarios({ commit }){
      repo.getUsuarios(commit);
    },

    traePedidos({ commit }){
      repo.getPedidos(commit);
    },
    
    traePedidosUsuario({ commit },idUsuario){
      repo.getPedidosUsuario(commit,idUsuario);
    },

    createRegistro({ commit }, datosCrear:any){
      repo.createRegistro(datosCrear.lineaNueva, datosCrear.tabla);
    },

    actualizarRegistro({ commit }, datosActualizar:any){
      repo.actualizarRegistro(datosActualizar.lineaActualizada, datosActualizar.tabla);
    },

    borrarRegistro({ commit }:any, datosBorrar:any){
      repo.deleteRegistro(datosBorrar.linea, datosBorrar.tabla);
    }

  }
});
