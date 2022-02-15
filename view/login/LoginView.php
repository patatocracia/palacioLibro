<?php
require_once 'view/View.php';

class LoginView extends View {

    public function display()
    {
//        var_dump($this ->libroData);
        $this->render('view/inc/headerView.php');
        $this->render('view/login/login.php');
        $this->render('view/inc/footerView.php');
    }
}