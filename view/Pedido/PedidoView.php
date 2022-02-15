<?php
require_once 'view/View.php';
class PedidoView extends View
{

    public function display()
    {
        $this->render('view/inc/headerView.php');
        $this->render('view/Pedido/navbarView.php', null, $this->user);
        $this->render('view/Pedido/pedidosView.php', $this ->pedidos, $this -> user);
        $this->render('view/inc/footerView.php');
    }
}