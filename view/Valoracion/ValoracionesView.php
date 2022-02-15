<?php
require_once 'view/View.php';
class ValoracionesView extends View
{

    public function display()
    {
        $this->render('view/inc/headerView.php');
        $this->render('view/Valoracion/navbarView.php', null, $this->user);
        $this->render('view/Valoracion/valoracionesView.php', $this ->valoraciones, $this -> user);
        $this->render('view/inc/footerView.php');
    }
}