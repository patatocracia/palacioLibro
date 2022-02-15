<?php
require_once 'view/Home/HomeView.php';
require_once 'model/LibroModel.php';
require_once 'model/UsuarioModel.php';

class UsuarioController
{
    public function printLogin()
    {
        require_once 'view/login/LoginView.php';
        $view = new LoginView();
        //asumo que si entras aqui te has desconectado
        //o que entras a un controlador o accion que no existe asi que tambien te deslogeo
        $view->display();

    }

    public function autenticar($usuario_email = null, $usuario_password = null)
    {
        if ($usuario_email == null || $usuario_password == null) {
            echo "b";
            require_once 'view/login/LoginView.php';
            $view = new LoginView();
            //asumo que si entras aqui te has desconectado
            //o que entras a un controlador o accion que no existe asi que tambien te deslogeo
            $view->display();
        } else {

            require_once 'model/UsuarioModel.php';
            $objUsuario = new UsuarioModel();
            if ($usuario = $objUsuario->autenticar($usuario_email, $usuario_password)) {
                session_start();
                setcookie("carrito", "", time() - 3600, "/");
                setcookie("loged", "true");
                $_SESSION['usuario_id'] = $usuario['usuario_id'];
                $libroModel = new LibroModel();
                $usuarioModel = new UsuarioModel();
                $dataLibro = $libroModel->getMejorValorados();
                $carritoTmp = $usuarioModel -> getCarrito($_SESSION['usuario_id']);
                $carrito = array();
                foreach ($carritoTmp as $codigo){
                    $carrito[]= array('dataLibro'=>$libroModel ->getLibro($codigo['libro_id']), 'cantidad'=>$usuarioModel ->getCantidadCarrito($codigo['carrito_id']));

                }

                $view = new HomeView(array('libroData' => $dataLibro, 'user' => $usuario, 'carrito' => $carrito));  // array('libroModel' => $libroModel, 'usuarioModel'=> $usuarioModel)
                $view->display();
            } else {
                $libroModel = new LibroModel();
                $dataLibro = $libroModel->getMejorValorados();
                $usuarioModel = new UsuarioModel();
                $carrito = null;
                $view = new HomeView(array('libroData' => $dataLibro, 'user' => null, 'carrito' => $carrito));  // array('libroModel' => $libroModel, 'usuarioModel'=> $usuarioModel)
                $view->display();

            }

        }
    }

    public function deslogear()
    {
        session_start();
        setcookie("loged", "", time() - 3600);
        unset($_SESSION['usuario_id']);
        session_destroy();
        $libroModel = new LibroModel();
        $usuarioModel = new UsuarioModel();

        $dataLibro = $libroModel->getMejorValorados();

        $carrito = null;

        $view = new HomeView(array('libroData' => $dataLibro, 'user' => null, 'carrito' => $carrito));  // array('libroModel' => $libroModel, 'usuarioModel'=> $usuarioModel)
        $view->display();
    }

    public function addToCart($id_libro)
    {
        session_start();
        $objLibro = new LibroModel();
        $objUsuario = new UsuarioModel();

        $libro = $objLibro->getLibro($id_libro);



        if (isset($_SESSION['usuario_id'])) {
            //add product to table carrito
            //todo comprobar si ese usuario tiene ya ese libro y aumen tar la cantidad
            $objUsuario->addToCart($_SESSION['usuario_id'], $id_libro);

            $cantidad = $objUsuario ->getCantidadCarritoByUserAndLibro($_SESSION['usuario_id'], $id_libro);

            $libro['libroData']['cantidad'] = $cantidad['cantidad'];
        }


        echo json_encode($libro);


    }

    public function removeFromCart($idLibro)
    {
        session_start();
        $objLibro = new LibroModel();
        $objUsuario = new UsuarioModel();

        $libro = $objLibro->getLibro($idLibro);



        if (isset($_SESSION['usuario_id'])) {

            //add product to table carrito
            //todo comprobar si ese usuario tiene ya ese libro y aumen tar la cantidad
            $objUsuario->removeFromCart($_SESSION['usuario_id'], $idLibro);
            $cantidad = $objUsuario ->getCantidadCarritoByUserAndLibro($_SESSION['usuario_id'], $idLibro);
            if ($cantidad== null){
              $libro = array('respuesta'=>'ok');
            }else{
                $libro['libroData']['cantidad'] = $cantidad['cantidad'];
            }
        }


        echo json_encode($libro);
    }


}