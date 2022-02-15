<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
require_once 'config/config.php';
require_once 'core/routes.php';
require_once 'config/ConnDB.php';



//aqui se van a enviar todos los formularios, paginas, cosas, controlador y accion y dependiendo que se cargara una vista u otra que tendra x modeles de datos disponibles







if (isset($_GET['c'])){ //todo tengo que poder aceptar mas parametros

    $controlador=cargarControlador($_GET['c']);
    if (isset($_GET['a'])){
        if (isset($_GET['id'])){
            if (isset($_GET['password'])){
                cargarAccion($controlador, $_GET['a'], $_GET['id'], $_GET['password']);

            }else{
                cargarAccion($controlador, $_GET['a'], $_GET['id']);
            }
        }else{
            cargarAccion($controlador, $_GET['a']);
        }
    }
    else{
        cargarAccion($controlador, ACCION_PRINCIPAL);
    }
}
else{ // si no hay controlador y accion cargada se cargaran las por defecto
    $controlador=cargarControlador(CONTROLADOR_PRINCIPAL);
    $controlador ->home();
    $accion=ACCION_PRINCIPAL;
    $controlador->$accion();
}






