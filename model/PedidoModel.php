<?php

class PedidoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnDB::creaConn();

    }

    public function getPedidosUser($usuario_id)
    {
        $stmt = $this->conn->prepare("SELECT usuario_pedido.pedido_id,usuario_pedido.pedido_date,precio_total  from usuario_pedido inner join factura f on usuario_pedido.pedido_id = f.pedido_id where usuario_id = ?;");

        $stmt->execute(array($usuario_id));
        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $pedidos;
    }


    public function getInfoPedido($pedido_id)
    {
        $stmt = $this->conn->prepare("SELECT libro_id FROM pedido_line where pedido_id = ?;");
        $stmt->execute(array($pedido_id));
        $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $info_libros = array();
        foreach ($libros as $libro) {
            $stmt = $this->conn->prepare("SELECT * FROM libro WHERE libro_id =?");
            $stmt->execute(array($libro['libro_id']));
            $a = $stmt->fetch(PDO::FETCH_ASSOC);
            $info_libros[] = $a;
        }
        return $info_libros;
    }

    public function getFacturaPedido($pedido_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM factura where pedido_id = ?;");
        $stmt->execute(array($pedido_id));
        $factura = $stmt->fetch(PDO::FETCH_ASSOC);
        return $factura;
    }


    public function realizarPedido($usuario_id, $promocion_code)
    {
        $stmt = $this->conn->prepare("INSERT INTO usuario_pedido (pedido_date, usuario_id) VALUES ('" . date("Y-m-d H:i:s") . "',$usuario_id);");
        $stmt->execute();
        $pedido_id = $this->conn->lastInsertId();

        $stmt = $this->conn->prepare("SELECT * FROM carrito WHERE usuario_id =?;");
        $stmt->execute(array($usuario_id));
        $carrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($carrito as $libro) {
            for ($i = 0; $i < $libro['cantidad']; $i++) {
                $stmt = $this->conn->prepare("INSERT INTO pedido_line(pedido_id, libro_id) VALUES (?,?)");
                $stmt->execute(array($pedido_id, $libro['libro_id']));
            }
        }
        $stmt = $this->conn->prepare("SELECT descuento,promocion_id FROM promocion WHERE promocion_code =?;");
        $stmt->execute(array($promocion_code));
        $promocion = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare("SELECT SUM(precio) AS precio_neto FROM libro inner join pedido_line pl on libro.libro_id = pl.libro_id where pedido_id =?;");
        $stmt->execute(array($pedido_id));
        $precio_neto = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($promocion != null) {
            $precio_total = $precio_neto['precio_neto'] * ((100 - $promocion['descuento'])/100);
            $promocion_id = $promocion['promocion_id'];
        } else {
            $precio_total = $precio_neto['precio_neto'];
            $promocion_id = null;
        }
        $stmt = $this->conn->prepare("INSERT INTO factura(pedido_id, precio_neto, precio_total, promocion_id) VALUES (?,?,?,?)");
        $stmt->execute(array($pedido_id, $precio_neto['precio_neto'], $precio_total, $promocion_id));

        $stmt = $this->conn->prepare("delete from carrito where usuario_id = ?;");
        $stmt -> execute(array($usuario_id));


    }


}