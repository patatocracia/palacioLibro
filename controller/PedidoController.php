<?php
require_once 'model/LibroModel.php';
require_once 'model/PedidoModel.php';
include_once 'core/autenticacion.php';
class PedidoController
{
    public function pedidos(){
        require_once 'view/Pedido/PedidoView.php';
        $user = comprobarLoged();
        $pedidoModel = new PedidoModel();
        $pedidos = $pedidoModel -> getPedidosUser($_SESSION['usuario_id']);


        $view = new PedidoView(array('pedidos'=>$pedidos, 'user' =>$user ));  // array('libroModel' => $libroModel, 'usuarioModel'=> $usuarioModel)
        $view->display();
    }

    public function info($pedido_id){
        require_once 'view/Pedido/InfoView.php';
        $user = comprobarLoged();
        $pedidoModel = new PedidoModel();
        $infoLibros = $pedidoModel -> getInfoPedido($pedido_id);
        $factura = $pedidoModel -> getFacturaPedido($pedido_id);


        $view = new InfoView(array('libros'=>$infoLibros,'factura'=>$factura, 'user' =>$user ));  // array('libroModel' => $libroModel, 'usuarioModel'=> $usuarioModel)
        $view->display();
    }

    public function realizar(){
        require_once 'view/Pedido/PedidoView.php';
        if (isset($_POST['promocion_code'])){
            $promocion_code = $_POST['promocion_code'];
        }else{
            $promocion_code = null;
        }
        $user = comprobarLoged();
        $pedidoModel = new PedidoModel();
        $pedidoModel ->realizarPedido($_SESSION['usuario_id'], $promocion_code);
        $pedidos = $pedidoModel -> getPedidosUser($_SESSION['usuario_id']);


        $view = new PedidoView(array('pedidos'=>$pedidos, 'user' =>$user ));  // array('libroModel' => $libroModel, 'usuarioModel'=> $usuarioModel)
        $view->display();
    }
}