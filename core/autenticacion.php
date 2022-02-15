<?php
include_once 'model/UsuarioModel.php';

function comprobarLoged()
{

    if (isset($_COOKIE['loged']) && $_COOKIE['loged'] == "true") {
        session_start();
        $usuario_id = $_SESSION['usuario_id'];
        $objUsuario = new UsuarioModel();
        $user = $objUsuario->getUsuario($usuario_id);
        return $user;
    }else{
        return null;
    }
}