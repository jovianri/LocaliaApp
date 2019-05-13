import axios from 'axios';

let france:string = "http://localia.pve2.fpmislata.com/apiLaravel/api/";
let casita:string = "localhost/apiLaravel/api/";


export default class Repository{

    public url:string;
    
    constructor(url:string = france){
        this.url = url;
    }

    // Locales

    getLocales(commit:any, cat:any = null){
        
        axios.get(this.url + "locales").then((response: any) => {
            commit('traerTodos', response.data);
        })
            
        axios.get(this.url + "fotosLocales").then((response: any) => {
            commit('traerFotosLocales', response.data);
        });
    }

    getLocalesByCategoria(commit:any, cat:any){
        axios.get(this.url + "locales/categoria="+ cat).then((response: any) => {
            commit('filtrados', response.data);
        });
    }

    crearLocal(local:any){
        axios.post(this.url + "locales", local).then((response: any) => {
            console.log(response);
        })
    }

    actualizarLocal(local:any){
        console.log(local)
        axios.put(this.url + "locales", local).then((response: any) => {
            console.log(response);
        })
    }

    // Categorias

    getCategorias(commit:any){
        axios.get(this.url + "categorias").then((response: any) => {
            commit('cargarCategorias', response.data);
        });
    }

    crearCategoria(categoria:any){
        axios.post(this.url + "categorias", categoria).then((response: any) => {
            console.log(response);
        })
    }

    actualizarCategoria(categoria:any){
        console.log(categoria);
        axios.put(this.url + "categorias/" + categoria.id, categoria).then((response: any) => {
            console.log(response);
        })
    }


    //Slider

    getImagenesSlider(commit:any){
        axios.get(this.url + "imagenes").then((response: any) => {
            commit('traerImagenesSlider', response.data);
        });
    }


    // Ciudades 

    getCiudades(commit:any){
        axios.get(this.url + "ciudades").then((response: any) => {
            commit('cargarCiudades', response.data);
        });
    }

    crearCiudad(ciudad:any){
        console.log(ciudad);
        axios.post(this.url + "ciudades", ciudad).then((response: any) => {
            console.log(response);
        })
    }

    actualizarCiudad(ciudad:any){
        console.log(ciudad)
        axios.put(this.url + "ciudades/" + ciudad.id, ciudad).then((response: any) => {
            console.log(response);
        })
    }


    // Usuarios 

    getUsuarios(commit:any){
        axios.get(this.url + "usuarios").then((response: any) => {
            commit('cargarUsuarios', response.data);
        });
    }

    crearUsuario(user:any){
        axios.post(this.url + "usuarios", user).then((response: any) => {
            console.log(response);
        })
    }

    actualizarUsuario(user:any){
        console.log(user);
        axios.put(this.url + "usuarios/" + user.id, user).then((response: any) => {
            console.log(response);
        })
    }


    // Pedidos
    
    getPedidos(commit:any){
        axios.get(this.url + "pedidos").then((response: any) => {
            commit('cargarPedidos', response.data);
        });
    }

    getPedidosUsuario(commit:any,idUsuario:any){
        axios.get(this.url + "pedidos/" + "idUsuario="+idUsuario).then((response: any) => {
            commit('cargarPedidosUsuario', response.data);
        }).catch(function (error) {
            commit('cargarPedidosUsuario', null);
        });;
    }

    //Carrito

    insertCarrito(carrito:any){

        let headers = {
            'Content-Type': 'application/json'
        }

        if(carrito.locales.length < 1){
            alert("No hay locales en el carrito!");

        } else {

            let pedidos = {
                idCliente: carrito.cliente,
                total: carrito.total
            };

            axios.post(this.url + "pedidos",pedidos,{headers:headers}).then((response: any) => {

                console.log(response.data);

                let idCarrito = response.data.id;

                let localesPedidos:any = carrito.locales.map( (articulo:any) => {

                    let envio =  {
                        cantidad: articulo.cantidad,
                        idLocal:  articulo.local.id,
                        idPedido: idCarrito
                    }

                    axios.post(this.url + "localesPedidos", envio, {headers:headers});
                    alert('Comprado');

                });
            });
        }

    }

    // Login

    logIn(context:any, user:any, pwd:any){

        let estaLogueado = false;
        let usuario = null;

        let headers = {
            'Content-Type': 'application/json'
        }
        let envio = {
            email: user,
            contrasenya: pwd
        }
        axios.post(this.url + "login", envio, {headers:headers}).then( response => {
            console.log(response.data);
            estaLogueado = response.data.logueado;
            usuario = response.data.usuario;
            console.log(response.data);
            alert('Logueado con exito');

            let respuesta = {
                logeado: estaLogueado,
                usuario: usuario

            }
            context.commit('login', respuesta);
            $("#login .close").click();
            
            context.dispatch('traePedidosUsuario',usuario.id)

        }).catch(function (error) {
            alert(error);
        });
        
    }


    // Registro

    registro(datosRegistro:Object){

        let headers = {
            'Content-Type': 'application/json'
        }
        axios.post(this.url + "usuarios", datosRegistro, {headers:headers}).then( response => {

            alert('Registrado con exito!');

        }).catch(function (error) {
            alert(error);

        })

    }

//modificar user
    
    modificarUser(commit:any, id:any,nombre:any, apellidos:any, fechaNacimiento:any, avatar:any){

        let headers = {
            'Content-Type': 'application/json'
        }

        let envio = {
            nombre: nombre,
            apellidos: apellidos,
            fechaNacimiento: fechaNacimiento,
            avatar: avatar
        }

        axios.put(this.url + "usuarios/" + id, envio, {headers:headers}).then( response => {

            let ok = response.data.modificado;

            alert('Cambios realizados correctamente!');

            let respuesta = {
                modificado: ok
            }

            commit('modificarUser', respuesta);

        }).catch(function (error:any) {
            alert(error);
        })
        
    }

    // Generic 

    createRegistro(filaCreada:any, tabla:any){

        switch(tabla){
            case 'locales':
                this.crearLocal(filaCreada);
            break;

            case 'ciudades':
                this.crearCiudad(filaCreada);
            break;

            case 'usuarios':
                this.crearUsuario(filaCreada);
            break;

            case 'categorias':
                this.crearCategoria(filaCreada);
            break;

            default:
            
        }

    }

    actualizarRegistro(filaActualizada:any, tabla:any){

        switch(tabla){
            case 'locales':
                this.actualizarLocal(filaActualizada);
            break;

            case 'ciudades':
                this.actualizarCiudad(filaActualizada);
            break;

            case 'usuarios':
                this.actualizarUsuario(filaActualizada);
            break;

            case 'categorias':
                this.actualizarCategoria(filaActualizada);
            break;

            default:
        }
    }

    deleteRegistro(idBorrar:any, tabla:any){
        axios.delete(this.url + tabla + "/" + idBorrar).then((response: any) => {
            console.log(response.data);
        })
    }

    
}