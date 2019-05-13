export default class Articulo{

    public cantidad:number;
    public local:any;

    constructor(local:any){
        this.cantidad = 1;
        this.local = local;
    }

    addUnit(){
        this.cantidad++;
    }

    deleteUnit(){
        this.cantidad--;
    }
}