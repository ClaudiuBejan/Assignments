create database fastfoodapp;

use fastfoodapp;

create table orders
(
  orderid int unsigned not null auto_increment primary key,
  firstname char(60) not null,
  lastname char(60) not null,
  chips int,
  fish int,
  burger int,
  cocacola int, 
  pepsi int
);

INSERT INTO orders (firstname, lastname, fish, chips, cocacola)
VALUES ('John', 'Doe', 1, 1, 1);