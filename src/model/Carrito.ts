import Articulo from '@/model/Articulo';

export default class Carrito{
    public cliente:number;
    public locales:Array<any>;
    public total:number;

    constructor(cliente:number, locales:Array<any>){
        this.cliente = cliente;
        this.locales = locales;
        this.total = 0;

    }

    // Functions

    addProduct(local:any){

        let estaPresente:boolean = false;

        try{

            if(local != null){

                let articulo = new Articulo(local);

                this.locales.filter(articuloGuardado => {

                    if(articuloGuardado.local.id == local.id){ // si ya está, sólo añade unidades.

                        articuloGuardado.addUnit();
                        estaPresente = true;
                        this.restableceTotal(parseInt(local.precio));
                    } 
                })

                if(!estaPresente){ // si no está, lo añade
                    this.locales.push(articulo);
                    this.restableceTotal(parseInt(local.precio));
                }
            
                return articulo;

            } else {
                throw new Error("Esto no es un local");
            }


        } catch(e){
            console.log(e.message);
        }
    }

    deleteProduct(local:any){
        
        this.locales.filter(articuloGuardado => {

            if(articuloGuardado.local.id == local.id){ 

                if(articuloGuardado.cantidad == 1){
                    let productDeleted = this.locales.indexOf(articuloGuardado);
                    this.locales.splice(productDeleted, 1);

                } else {
                    articuloGuardado.deleteUnit();
                }
            } 
        });

        this.restableceTotal(-parseInt(local.precio));
    }

    restableceTotal(precio:number){
        this.total += precio;
    }

    // Getters

    getLocales(){
        return this.locales;
    }

    getLocalesByCity(idCity:any){
        return this.locales.filter( local => local.idCiudad == idCity );
    }

    getLocalesByCategoria(idCategoria:any){
        return this.locales.filter( local => local.idCategoria == idCategoria);
    }

}