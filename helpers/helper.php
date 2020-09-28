<?php
use \Firebase\JWT\JWT;

function response($ok,$data,$typeResponse){
    echo(
        json_encode(
            array(
                "ok"=> $ok,
                $typeResponse=> $data
            )
        )
            );
}

function getData($path){
    $file = fopen($path,"r");
    $dataList = fread($file,filesize($path));
    fclose($file);
    return json_decode($dataList);
}

function saveData($path,$newElement,$dataList){
    $file = fopen($path,"w");
    array_push($dataList,$newElement);
    fwrite($file,json_encode($dataList));
    fclose($file);
}

function validatorPost($params){
    $retorno = true;
    for ($i=0; $i < count($params); $i++) { 
        if( !isset($_POST[$params[$i]]) ){
            response(false,"El $params[$i] es obligatorio");
            $retorno = false;
            break;
        }
    }
    return $retorno;
}

function createJWT($payload){
    $key = "example_key";
    $jwt = JWT::encode($payload,$key);
    return $jwt;
}

function validatorJWT($token){
    $retorno = null;
    $key = "example_key";
    try {
        $data = JWT::decode($token, $key, array('HS256'));
        $retorno = $data;
    } catch (\Throwable $th) {
       $retorno = null;
    }
    return $retorno;
}