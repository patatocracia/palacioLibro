<?php


require_once 'model/LibroModel.php';
include_once 'core/autenticacion.php';


class HomeController
{

    static public function home()
    {
        require_once 'view/Home/HomeView.php';
        $user = comprobarLoged();
        $libroModel = new LibroModel();
        $dataLibro =  $libroModel ->getMejorValorados();
        $usuarioModel = new UsuarioModel();
        $carrito = null;
        if (isset($user)){
            $carritoTmp = $usuarioModel -> getCarrito($_SESSION['usuario_id']);
            $carrito = array();
            foreach ($carritoTmp as $codigo){
                $carrito[]= array('dataLibro'=>$libroModel ->getLibro($codigo['libro_id']), 'cantidad'=>$usuarioModel ->getCantidadCarrito($codigo['carrito_id']));

            }
        }

       $view = new HomeView(array('libroData' => $dataLibro, 'user' =>$user, 'carrito' => $carrito));  // array('libroModel' => $libroModel, 'usuarioModel'=> $usuarioModel)
        $view->display();

    }


    static public function busqueda(){
        require_once 'view/Home/BusquedaView.php';
        $user = comprobarLoged();
        $libroModel = new LibroModel();
        $usuarioModel = new UsuarioModel();

        $filtro = array('dato'=>$_POST['dato'], 'filtro'=>$_POST['filtro']??null);
        $dataLibro =  $libroModel ->getByFiltro($filtro, 1);
        $carrito = null;
        if (isset($user)){
            $carritoTmp = $usuarioModel -> getCarrito($_SESSION['usuario_id']);
            $carrito = array();
            foreach ($carritoTmp as $codigo){
                $carrito[]= array('dataLibro'=>$libroModel ->getLibro($codigo['libro_id']), 'cantidad'=>$usuarioModel ->getCantidadCarrito($codigo['carrito_id']));

            }
        }


        $view = new BusquedaView(array('libroData' => $dataLibro, 'user' =>$user, 'carrito' => $carrito));
        $view ->display();
    }
}