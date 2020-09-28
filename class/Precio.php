<?php


class Precio {
    private $precioHora;
    private $precioEstadia;
    private $precioMensual;
    public static $pathDataBase = "./data/precio.json";

    public function  __construct($precioHora,$precioEstadia,$precioMensual){
        $this->precioHora = $precioHora;
        $this->precioEstadia = $precioEstadia;
        $this->precioMensual = $precioMensual;
    }

    public function save(){
        $precioList = getData(Self::$pathDataBase);
        $newPrecio = array(
            "precioHora" => $this->precioHora,
            "precioEstadia" => $this->precioEstadia,
            "precioMensual" => $this->precioMensual
        );
        saveData(Self::$pathDataBase,$newPrecio,$precioList);
        return $newPrecio;
    }
}