<?php
function cargarControlador($controlador)
{
    $nombreControlador = ucwords(strtolower($controlador)) . "Controller";

    $archivoControlador = 'controller/' . ucwords(strtolower($controlador)) . "Controller.php";

    if (!is_file($archivoControlador)) {
        $archivoControlador = 'controller/' . CONTROLADOR_PRINCIPAL . ".php";
    }

    require_once $archivoControlador;
    $controlador = new $nombreControlador();
    return $controlador;
}

function cargarAccion($controlador, $accion, $id = null, $password = null)
{


    if (isset($accion) && method_exists($controlador, $accion)) {

        if ($id == null && $password == null) { //para poder pasar parametro por la url
            $controlador->$accion();
        } else if ($password == null){
            $controlador->$accion($id);
        }else{
            $controlador -> $accion($id, $password);
        }

    } else {
        var_dump($controlador);
        $controlador->ACCION_PRINCIPAL();
    }


}