<?php

function ingresoAuto($params,$token){
    if(!validatorPost($params)){
        return;
    }
    $payload = validatorJWT($token);
    if( $payload == null ){
        response(false,"Token no valido","msg");
        return;
    }
    if( $payload->tipo != "user" ){
        response(false,"Solo los tipo:user pueden crear el ingreso","msg");
        return;
    }
    $newIngreso = new Autos( date("g:i:a d-m-o"),$_POST["tipo"], $_POST["patente"],$payload->email);
    $response = $newIngreso->save();
    response(true,$response,"respuesta");
}

function getAllAutos(){
    response(true, Autos::getAll(),"respuesta");
}

function getAutosByPatente(){
    $patente = explode( "=", $_SERVER['QUERY_STRING'])[1];
    $autoEncontrado = Autos::getByPatente($patente);
    if( $autoEncontrado == null ){
        response(false,"Auto no encontrado","msg");
        return;
    }
    response(true,$autoEncontrado,"respuesta");
}

function totalImportes($tipo){
    $respuesta =   Autos::getImporteByTipo($tipo);
    echo($respuesta);
}