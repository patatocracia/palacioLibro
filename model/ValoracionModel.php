<?php


class ValoracionModel{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnDB::creaConn();

    }



    public function setValoracion($libro_id, $usuario_id, $puntuacion, $comentario){
        $stmt = $this->conn ->prepare("INSERT INTO valoracion(puntuacion, comentario, usuario_id, libro_id) VALUES (?,?,?,?);");
        $stmt ->execute(array($puntuacion, $comentario, $usuario_id, $libro_id));
    }

    public function getValoraciones($usuario_id){
        $stmt = $this->conn -> prepare("select puntuacion, comentario, l.title from valoracion inner join libro l on valoracion.libro_id = l.libro_id where usuario_id = ?;");
        $stmt ->execute(array($usuario_id));
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
}
