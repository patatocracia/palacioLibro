INSERT INTO factura (pedido_id, precio_neto, precio_total)
SELECT p.pedido_id   as pedido_id,
       SUM(l.precio) as precio_neto,
       SUM(l.precio) as precio_total
FROM usuario_pedido as p
         INNER JOIN pedido_line pl on p.pedido_id = pl.pedido_id
         INNER JOIN libro l on pl.libro_id = l.libro_id
group by p.pedido_id;