INSERT INTO valoracion(puntuacion, usuario_id, libro_id)
SELECT ROUND(RAND() * 5) as puntuacion, usuario_id, libro_id
from usuario_pedido
         inner join pedido_line pl on usuario_pedido.pedido_id = pl.pedido_id;



INSERT INTO valoracion(puntuacion, usuario_id, libro_id)
SELECT ROUND(RAND() * 5) as puntuacion, usuario_id, libro_id
from usuario_pedido
         inner join pedido_line pl on usuario_pedido.pedido_id = pl.pedido_id limit 500;




INSERT INTO promocion(promocion_code, descuento) VALUES ('VALENTIN', 10);

















