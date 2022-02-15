<?php

abstract class View
{

    public function __construct($modelos = null)
    {
            if ($modelos != null){
                foreach ($modelos as $modelo => $obj){
                    $this->$modelo = $obj;
                }
            }
    }


    public final function render($template, $data = null, $user = null){
        include_once $template;
    }


    abstract public function display();
}