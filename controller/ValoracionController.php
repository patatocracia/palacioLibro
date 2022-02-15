<?php
include_once 'core/autenticacion.php';
class ValoracionController
{
    public function valoracionform($libro_id){
        require_once 'view/Valoracion/ValoracionView.php';
        require_once 'model/LibroModel.php';
        $user = comprobarLoged();
        $libroModel = new LibroModel();
        $libro = $libroModel ->getLibro($libro_id);


        $view = new ValoracionView(array('user' =>$user, 'libro'=>$libro));  // array('libroModel' => $libroModel, 'usuarioModel'=> $usuarioModel)
        $view->display();
    }


    public function valorar($libro_id){
        require_once 'view/Pedido/PedidoView.php';
        require_once 'model/ValoracionModel.php';
        require_once 'model/PedidoModel.php';
        $user = comprobarLoged();

        $valoracion = new ValoracionModel();
        $valoracion -> setValoracion($libro_id, $_SESSION['usuario_id'], $_POST['puntuacion']??null,$_POST['comentario']??null);
        $pedidoModel = new PedidoModel();
        $pedidos = $pedidoModel -> getPedidosUser($_SESSION['usuario_id']);


        $view = new PedidoView(array('pedidos'=>$pedidos, 'user' =>$user ));  // array('libroModel' => $libroModel, 'usuarioModel'=> $usuarioModel)
        $view->display();



    }

    public function showvaloraciones(){
        require_once 'view/Valoracion/ValoracionesView.php';
        require_once 'model/ValoracionModel.php';
        $user = comprobarLoged();
        $valoracion = new ValoracionModel();
        $valoraciones = $valoracion ->getValoraciones($_SESSION['usuario_id']);
        $view = new ValoracionesView(array('valoraciones'=>$valoraciones, 'user'=>$user));  // array('libroModel' => $libroModel, 'usuarioModel'=> $usuarioModel)
        $view->display();



    }
}