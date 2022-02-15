CREATE TABLE autor
(
    autor_id   INT auto_increment,
    autor_name VARCHAR(400),
    CONSTRAINT pk_autor PRIMARY KEY (autor_id)
);

CREATE TABLE editorial
(
    editorial_id   INT auto_increment,
    editorial_name VARCHAR(400),
    CONSTRAINT pk_editorial PRIMARY KEY (editorial_id)
);

CREATE TABLE libro_idioma
(
    idioma_id   INT auto_increment,
    idioma_code VARCHAR(8),
    idioma_name VARCHAR(50),
    CONSTRAINT pk_idioma PRIMARY KEY (idioma_id)
);

CREATE TABLE libro
(
    libro_id         INT auto_increment,
    title            VARCHAR(400),
    isbn13           VARCHAR(13),
    idioma_id        INT,
    num_pages        INT,
    publicacion_date DATE,
    editorial_id     INT,
    precio           DECIMAL(5, 2),
    image            VARCHAR(100),
    CONSTRAINT pk_libro PRIMARY KEY (libro_id),
    CONSTRAINT fk_libro_idioma FOREIGN KEY (idioma_id) REFERENCES libro_idioma (idioma_id),
    CONSTRAINT fk_libro_editorial FOREIGN KEY (editorial_id) REFERENCES editorial (editorial_id)
);

CREATE TABLE libro_autor
(
    libro_id INT,
    autor_id INT,
    CONSTRAINT pk_libroautor PRIMARY KEY (libro_id, autor_id),
    CONSTRAINT fk_ba_libro FOREIGN KEY (libro_id) REFERENCES libro (libro_id),
    CONSTRAINT fk_ba_autor FOREIGN KEY (autor_id) REFERENCES autor (autor_id)
);


CREATE TABLE usuario
(
    usuario_id INT auto_increment,
    name       VARCHAR(200),
    apellido   VARCHAR(200),
    email      VARCHAR(350),
    password   VARCHAR(256) ,
    CONSTRAINT pk_usuario PRIMARY KEY (usuario_id)
);
CREATE TABLE carrito
(
    carrito_id INT auto_increment,
    usuario_id INT,
    libro_id   INT,
    cantidad   INT,
    CONSTRAINT carrito PRIMARY KEY (carrito_id),
    CONSTRAINT fk_carrito_libro FOREIGN KEY (libro_id) REFERENCES libro (libro_id),
    CONSTRAINT fk_carrito_usuario FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id)
);


CREATE TABLE usuario_pedido
(
    pedido_id   INT AUTO_INCREMENT,
    pedido_date DATETIME,
    usuario_id  INT,
    CONSTRAINT pk_custpedido PRIMARY KEY (pedido_id),
    CONSTRAINT fk_pedido_cust FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id)
);



CREATE TABLE pedido_line
(
    line_id   INT AUTO_INCREMENT,
    pedido_id INT,
    libro_id  INT,
    CONSTRAINT pk_pedidoline PRIMARY KEY (line_id),
    CONSTRAINT fk_ol_pedido FOREIGN KEY (pedido_id) REFERENCES usuario_pedido (pedido_id),
    CONSTRAINT fk_ol_libro FOREIGN KEY (libro_id) REFERENCES libro (libro_id)
);

CREATE TABLE promocion
(
    promocion_id   INT auto_increment,
    promocion_code char(10),
    descuento      INT,
    CONSTRAINT pk_promocion PRIMARY KEY (promocion_id)
);
CREATE TABLE factura
(
    factura_id   INT auto_increment,
    pedido_id    INT,
    precio_neto  DECIMAL(10, 2),
    precio_total  DECIMAL(10, 2),
    promocion_id INT,
    CONSTRAINT pk_factura PRIMARY KEY (factura_id),
    CONSTRAINT fk_factura FOREIGN KEY (pedido_id) REFERENCES usuario_pedido (pedido_id),
    CONSTRAINT promocion FOREIGN KEY (promocion_id) REFERENCES promocion (promocion_id)
);

CREATE TABLE valoracion
(
    valoracion_id INT auto_increment,
    puntuacion    INT,
    comentario    VARCHAR(400),
    usuario_id    INT,
    libro_id      INT,
    CONSTRAINT pk_valoracion PRIMARY KEY (valoracion_id),
    CONSTRAINT fk_valoracion_usuario FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id),
    CONSTRAINT fk_valoracion_libro FOREIGN KEY (libro_id) REFERENCES pedido_line (libro_id)


);



#
#   https://www.databasestar.com/sample-bookstore-database/
#
#




