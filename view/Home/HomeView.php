<?php
require_once 'view/View.php';

class HomeView extends View {

    public function display()
    {
        $this->render('view/inc/headerView.php', null, $this -> user);
        $this->render('view/Home/carrito.php', $this-> carrito, $this -> user);
        $this->render('view/Home/navbarView.php', null, $this ->user);
        $this->render('view/Home/bannerView.php');
        $this->render('view/Home/librosView.php', $this -> libroData);
//        $this->render('view/Home/librosValoradosView.php', $this -> libroData);
        $this->render('view/inc/footerView.php');
    }
}