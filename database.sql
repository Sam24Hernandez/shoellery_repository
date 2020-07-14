/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
CREATE DATABASE IF NOT EXISTS shoellery;
USE shoellery;

CREATE TABLE IF NOT EXISTS users(
id              int(255) auto_increment not null,
role            varchar(20),
name            varchar(100),
surname         varchar(200),
nick            varchar(100),
email           varchar(255),
password        varchar(255),
image           varchar(255),
front			varchar(255),
bio             varchar(255),
created_at      datetime,
updated_at      datetime,
remember_token  varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id),
CONSTRAINT users_uniques_fields UNIQUE (email, nick)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'admin', 'Sam', 'Hernández', 'heysamgallery', 'sam@herco24.com', 'password', null, 'Bienvenidos a mi galería de fotos', CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'Susi', 'García', 'susiegarcia_', 'susi@garcia123.com', 'password', null, 'La inspiración desbloquea el futuro.', CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'Miguel', 'Martinez Castro', 'miguelhmzc', 'miguel@hilario.com', 'password', null, '...', CURTIME(), CURTIME(), NULL);

CREATE TABLE IF NOT EXISTS images(
id              int(255) auto_increment not null,
user_id         int(255),
image_path      varchar(255),
description     text,
created_at      datetime,
updated_at      datetime,
CONSTRAINT pk_images PRIMARY KEY(id),
CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO images VALUES(NULL, 1, 'test.jpg', 'descripción de prueba 1', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 1, 'playa.jpg', 'descripción de prueba 2', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 2, 'arena.jpg', 'descripción de prueba 3', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS comments(
id              int(255) auto_increment not null,
user_id         int(255),
image_id        int(255),
content         text,
created_at      datetime,
updated_at      datetime,
CONSTRAINT pk_comments PRIMARY KEY(id),
CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO comments VALUES(NULL, 1, 2, 'Que padre foto Susi!! :)', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 1, 'Cool uwu', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 3, 1, 'Eso Sam!!', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS likes(
id              int(255) auto_increment not null,
user_id         int(255),
image_id        int(255),
created_at      datetime,
updated_at      datetime,
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO likes VALUES(NULL, 1, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 1, 2, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 3, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 1, CURTIME(), CURTIME());


/**
 * Author:  Sam Hernandez
 * Created: 4/07/2020
 */

