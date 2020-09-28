<?php

function addPrecio($params,$token){
    if(!validatorPost($params)){
        return;
    }
    $payload = validatorJWT($token);
    if( $payload == null ){
        response(false,"Token no valido","msg");
        return;
    }
    if( $payload->tipo != "admin" ){
        response(false,"Solo los administradores pueden crear el precio","msg");
    }
    $newPrecio = new Precio($_POST["precio_hora"],$_POST["precio_estadia"],$_POST["precio_mensual"]);
    $newPrecio->save();
    response(true,"Precio creado con exito","msg");
}