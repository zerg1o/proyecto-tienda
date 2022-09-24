CREATE DATABASE tienda_master;

use tienda_master;

CREATE TABLE usuarios(
    id int(255) auto_increment not null,
    nombre      varchar(255) null,
    apellidos   varchar(255) null,
    email       varchar(255) not null,
    password    varchar(255) not null,
    rol        varchar(20)  null,
    img         varchar(255) null,
    constraint pk_usuarios PRIMARY KEY(id),
    constraint uq_email UNIQUE(email)

)ENGINE=InnoDB;

CREATE TABLE categorias(
    id      int(255) auto_increment not null,
    nombre  varchar(255),
    constraint pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE productos(
    id              int(255) auto_increment not null,
    categoria_id    int(255) not null,
    nombre          varchar(100) not null,
    descripcion     text,
    precio          float(100,2),
    stock           int(255) not null,
    oferta          varchar(2),
    fecha           date not null,
    imagen          varchar(255),
    constraint pk_productos PRIMARY KEY(id),
    constraint fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDB;

CREATE TABLE pedidos(
    id          int(255) auto_increment not null,
    usuario_id  int(255) not null,
    provincia   varchar(255) null,
    localidad   varchar(255) null,
    direccion   varchar(255) not null,
    coste       float(200,2) null,
    estado      varchar(1) not null,
    fecha       date,
    hora        time,
    constraint pk_pedidos PRIMARY KEY(id),
    constraint fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDB;

CREATE TABLE detallepedidos(
    id          int(255) AUTO_INCREMENT NOT NULL,
    pedido_id   int(255) NOT NULL,
    producto_id int(255) NOT NULL,
    unidades    int(255) NOT NULL,
    constraint pk_detallepedidos PRIMARY KEY(id),
    constraint fk_detallepedido_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    constraint fk_detallepedido_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDB;

use tienda_master;
select LAST_INSERT_ID() as 'pedido_id';
SELECT LAST_INSERT_ID();


select PE.id, P.nombre, P.precio, DP.unidades from productos P, detallepedidos DP, pedidos PE
    WHERE PE.usuario_id = 10 and PE.id = DP.pedido_id and P.id = DP.producto_id and PE.id = 25;

select id from pedidos where usuario_id = 10 ORDER BY id DESC LIMIT 1;