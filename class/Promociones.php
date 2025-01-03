<?php

class Promociones{
    public $id;
    public $titulo;
    public $descripcion;
    public $codigo;

    //Metodos //////////////////

    public function traer_catalogo(){
        $json = file_get_contents("./promociones.json");
        $jsonData = json_decode($json);
        $catalogo = [];
        foreach ($jsonData as $value) { // recorremos el JSON
            $productos = new self(); //crear una nueva instancia de estos productos
            $productos->id = $value->id;
            $productos->titulo = $value->titulo;
            $productos->descripcion = $value->descripcion;
            $productos->codigo = $value->codigo;
            $catalogo[] = $productos;
        }
        return $catalogo;
    }

    //function detalleDeProducto(){};
    //function filtroPorTema(etiquetas){}
    //function favoritos(){}
    //function comprar(){}
    //function agregar_al_carrito(){}
    //function quitar_del_carrito(){}
    //function pagos(){ //finalizarCompra // datos de envio }
    //function detalledelregisto(){//mail - hsm - sms} 
    //
/*     public function traer_ofertas()
    {
        $json = file_get_contents("./productos.json");
        $jsonData = json_decode($json);

        foreach ($jsonData as $value) {
            if ($value->precio < 2000) {
                $oferta = new self();
                $oferta = $value->precio;
                $ofertas[] = $oferta;
            }
        }
        return $ofertas;
    }

    public function traer_categoria($categoria)
    {
        $resultado = [];
        $catalogo = $this->traer_catalogo();
        foreach ($catalogo as $value) {
            if ($value->categoria == $categoria) {
                $resultado[] = $value;
            }
        }
        return $resultado;
    } */
};
