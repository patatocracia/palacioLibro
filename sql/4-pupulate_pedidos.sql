INSERT INTO usuario_pedido (pedido_date, usuario_id)
SELECT NOW() - INTERVAL FLOOR(RAND() * 365 * 3 * 24 * 60 * 60) SECOND AS pedido_date,
       c.usuario_id
FROM usuario c
LIMIT 2500;
INSERT INTO usuario_pedido (pedido_date, usuario_id)
SELECT NOW() - INTERVAL FLOOR(RAND() * 365 * 3 * 24 * 60 * 60) SECOND AS pedido_date,
       c.usuario_id
FROM usuario c
LIMIT 1500;
INSERT INTO usuario_pedido (pedido_date, usuario_id)
SELECT NOW() - INTERVAL FLOOR(RAND() * 365 * 3 * 24 * 60 * 60) SECOND AS pedido_date,
       c.usuario_id
FROM usuario c
LIMIT 200;
INSERT INTO usuario_pedido (pedido_date, usuario_id)
SELECT NOW() - INTERVAL FLOOR(RAND() * 365 * 3 * 24 * 60 * 60) SECOND AS pedido_date,
       c.usuario_id
FROM usuario c
LIMIT 100;
INSERT INTO usuario_pedido (pedido_date, usuario_id)
SELECT NOW() - INTERVAL FLOOR(RAND() * 365 * 3 * 24 * 60 * 60) SECOND AS pedido_date,
       c.usuario_id
FROM usuario c
LIMIT 50;






