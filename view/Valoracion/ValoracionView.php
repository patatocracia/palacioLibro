<?php
require_once 'view/View.php';
class ValoracionView extends View
{

    public function display()
    {
        $this->render('view/inc/headerView.php');
        $this->render('view/Valoracion/navbarView.php', null, $this->user);
        $this->render('view/Valoracion/formValoracionView.php', $this ->libro, $this -> user);
        $this->render('view/inc/footerView.php');
    }
}