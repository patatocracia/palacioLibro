INSERT INTO pedido_line (pedido_id, libro_id)
SELECT p.pedido_id           as pedido_id,
       FLOOR(RAND() * 11127) AS libro_id
FROM usuario_pedido p;


INSERT INTO pedido_line (pedido_id, libro_id)
SELECT p.pedido_id           as pedido_id,
       FLOOR(RAND() * 11127) AS libro_id
FROM usuario_pedido p
LIMIT 500;
INSERT INTO pedido_line (pedido_id, libro_id)
SELECT p.pedido_id           as pedido_id,
       FLOOR(RAND() * 11127) AS libro_id
FROM usuario_pedido p
LIMIT 50;



