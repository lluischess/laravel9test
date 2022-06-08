CREATE DATABASE IF NOT EXISTS laravel;
USE laravel;

CREATE TABLE IF NOT EXISTS users(
id          int(255) auto_increment not null,
role        varchar(30),
name        varchar(200),
surname     varchar(200),
nick        varchar(200),
email       varchar(255),
password    varchar(200),
img         varchar(200),
created_at  datetime,
updated_at  datetime,
remember_token varchar(200),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'Lluis', 'Casamajor', 'lluiswk', 'lluis@lluis.com', '1234', null, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'Juan', 'Lopez', 'juanlopez', 'juan@juan.com', '1234', null, CURTIME(), CURTIME(), NULL);

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

INSERT INTO comments VALUES(NULL, 2, 1, 'Buena foto de familia!!', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 1, 'Buena foto de PLAYA!!', CURTIME(), CURTIME());

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

INSERT INTO likes VALUES(NULL, 1, 4, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 4, CURTIME(), CURTIME());