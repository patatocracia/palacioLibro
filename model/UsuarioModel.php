<?php

class UsuarioModel
{
    private $conn;
    private $usuario;

    public function __construct()
    {
        $this->conn = ConnDB::creaConn();
    }


    public function autenticar($usuario_email, $usuario_password)
    {
        //todo sanear email y pass


        $stmt = $this->conn->prepare("SELECT * FROM usuario where email =?");
        $stmt->execute(array($usuario_email));
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($usuario_password, $usuario['password'])) {
            return $usuario;
        } else {
            return null;
        }

    }


    public function getUsuario($usuario_id)
    {
        $stmt = $this->conn->prepare("SELECT name, apellido, email FROM usuario where usuario_id =?");
        $stmt->execute(array($usuario_id));
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario != null) {
            return $usuario;
        } else {
            return null;
        }
    }

    public function getCarrito($usuario_id){

        $stmt = $this->conn -> prepare("SELECT carrito_id, libro_id FROM carrito WHERE usuario_id = ?");
        $stmt -> execute(array($usuario_id));

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

    }

    public function addToCart($usuario_id, $libro_id)
    {
        $stmt = $this->conn -> prepare("SELECT carrito_id, cantidad from carrito WHERE usuario_id = $usuario_id AND libro_id = $libro_id");
        $stmt -> execute();
        if ($stmt ->rowCount()>0){
            $carrito = $stmt ->fetch(PDO::FETCH_ASSOC);
            $cantidad = $carrito['cantidad']+1;
            $stmt = $this->conn->prepare("UPDATE carrito SET cantidad =".$cantidad. " WHERE carrito_id =?");
            $stmt -> execute(array($carrito['carrito_id']));

        }else{
            $stmt = $this->conn->prepare("INSERT INTO carrito (usuario_id, libro_id, cantidad) 
                                            values (?,?,?)");
            $stmt->execute(array($usuario_id, $libro_id, 1));
        }







    }
    function getCantidadCarrito($carrito_id){
        $stmt = $this->conn->prepare("SELECT cantidad FROM carrito where carrito_id =?");
        $stmt->execute(array($carrito_id));
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    function getCantidadCarritoByUserAndLibro($usuario_id, $libro_id){
        $stmt = $this->conn->prepare("SELECT cantidad FROM carrito where usuario_id =? AND libro_id = ?");
        $stmt->execute(array($usuario_id, $libro_id));
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    public function removeFromCart($usuario_id, $libro_id){
        $stmt = $this->conn -> prepare("SELECT carrito_id, cantidad from carrito WHERE usuario_id = $usuario_id AND libro_id = $libro_id");
        $stmt->execute();
        $carrito = $stmt ->fetch(PDO::FETCH_ASSOC);
        if ($carrito['cantidad']>1){
            $cantidad = $carrito['cantidad']-1;
            $stmt = $this->conn->prepare("UPDATE carrito SET cantidad =".$cantidad. " WHERE carrito_id =?");
            $stmt -> execute(array($carrito['carrito_id']));
        }else{
            $stmt = $this->conn -> prepare("DELETE FROM carrito where carrito_id = ?");
            $stmt->execute(array($carrito['carrito_id']));
        }




    }


}