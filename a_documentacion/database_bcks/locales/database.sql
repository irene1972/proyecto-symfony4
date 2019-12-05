CREATE DATABASE IF NOT EXISTS symfony_master;
USE symfony_master;

CREATE TABLE IF NOT EXISTS users(
  id int (255) auto_increment not null,
  role varchar (50),
  name varchar (100),
  surname varchar (200),
  email varchar (255),
  password varchar (255),
  created_at datetime,
  CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'ROLE_USER','Irene','Olgo','ire@ire.es','password', CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER','Ariadna','Bool','ari@ari.com','password2', CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER','Carlos','Perea','carlos@carlos.es','password3', CURTIME());

CREATE TABLE IF NOT EXISTS tasks(
  id int (255) auto_increment not null,
  user_id int (255) not null,
  title varchar (255),
  content text,
  priority varchar (20),
  hours int (100),
  created_at datetime,
  CONSTRAINT pk_tasks PRIMARY KEY(id),
  CONSTRAINT fk_task_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO tasks VALUES(NULL, 1,'Tarea 1','Contenido de prueba 1','hight',40, CURTIME());
INSERT INTO tasks VALUES(NULL, 1,'Tarea 2','Contenido de prueba 2','hight',20, CURTIME());
INSERT INTO tasks VALUES(NULL, 2,'Tarea 3','Contenido de prueba 3','hight',10, CURTIME());
INSERT INTO tasks VALUES(NULL, 3,'Tarea 4','Contenido de prueba 4','hight',50, CURTIME());