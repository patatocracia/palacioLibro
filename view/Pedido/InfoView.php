<?php
require_once 'view/View.php';

class InfoView extends View
{

    public function display()
    {
        $this->render('view/inc/headerView.php');
        $this->render('view/Pedido/navbarView.php', null, $this ->user);
        $this->render('view/Pedido/infoPedidoView.php', $this ->libros);
        $this->render('view/Pedido/facturaView.php', $this ->factura);
        $this->render('view/inc/footerView.php');
    }
}