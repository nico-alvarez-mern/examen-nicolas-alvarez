<?php


class Autos {
    private $fechaIngreso;
    private $tipo;
    private $patente;
    private $emailUsuario;
    public static $pathDataBase = "./data/autos.json";

    public function  __construct($fechaIngreso,$tipo,$patente,$emailUsuario){
        $this->fechaIngreso = $fechaIngreso;
        $this->tipo = $tipo;
        $this->patente = $patente;
        $this->emailUsuario = $emailUsuario;
    }

    public function save(){
        $autosList = getData(Self::$pathDataBase);
        $newIngreso = array(
            "fechaIngreso" => $this->fechaIngreso,
            "tipo" => $this->tipo,
            "patente" => $this->patente,
            "emailUsuario" => $this->emailUsuario
        );
        saveData(Self::$pathDataBase,$newIngreso,$autosList);
        return $newIngreso;
    }

    public static function getAll(){
        $autosList = getData(Self::$pathDataBase);
        usort($autosList, function($a, $b){
            return strcmp( $a->tipo,$b->tipo);
        });
        return $autosList;
    }
    public static function getByPatente($patente){
        $autosList = getData(Self::$pathDataBase);
        $retorno = null;
        for ($i=0; $i < count($autosList); $i++) { 
            if($autosList[$i]->patente == $patente){
                $retorno = $autosList[$i];
                break;
            }
        }
        return $retorno;
    }
    public static function getImporteByTipo($tipo){
        $precio = (getData("./data/precio.json"))[0] ?? -1;
        $autosList = getData(Self::$pathDataBase);
        $retorno = 0;
        if( $precio === -1 ){
            return -1;
        }
        for ($i=0; $i < count($autosList); $i++) { 
            if($autosList[$i]->tipo == $tipo){
                if( $tipo == "hora"){
                    $retorno += $precio->precioHora;
                }else if($tipo == "estadia"){
                    $retorno += $precio->precioEstadia;
                }else{
                    $retorno += $precio->precioMensual;
                }
            }
        }
        return $retorno;
    }
}