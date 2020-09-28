<?php
require __DIR__ . '/vendor/autoload.php';
require('./controllers/usuario.php');
require('./controllers/precio.php');
require('./controllers/autos.php');
require('./class/User.php');
require('./class/Precio.php');
require('./class/Autos.php');
require('./helpers/helper.php');


$metodo = $_SERVER['REQUEST_METHOD'] ?? "";
$path = $_SERVER['PATH_INFO'] ?? "";
$token = (getallheaders())['token'] ?? "";

switch ($metodo) {
    case 'POST':
        if($path == "/registro"){
            createUser(["tipo","email","password"]);
        }else if($path == "/login"){
            login(["email","password"]);
        }else if($path == "/precio"){
            addPrecio(["precio_hora","precio_estadia","precio_mensual"],$token);
        }else if($path == "/ingreso"){
            ingresoAuto(["patente","tipo"],$token);
        }
        else{
            response(false,"BAD REQUEST","msg");
        }
        break;
    case 'GET':
        if($path == "/ingreso"){
            if( explode( "=", $_SERVER['QUERY_STRING'])[0] == "patente" ){
                getAutosByPatente();
                return;
            }
            getAllAutos();
        }else if($path == "/importe/hora"){
            totalImportes("hora");
        }else if($path == "/importe/estadia"){
            totalImportes("estadia");
        }else if($path == "/importe/mensual"){
            totalImportes("mensual");
        }
    default:
        # code...
        break;
}
