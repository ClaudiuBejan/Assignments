create database accounts;

use accounts;

create table accounts
(
  accountid int unsigned not null auto_increment primary key,
  firstname char(60) not null,
  lastname char(60) not null,
  dob date not null,
  pwd char(60) not null,
  balance decimal(9,2) default 0.00,
  history text default ""
);

INSERT INTO accounts (firstname, lastname, dob, pwd)
VALUES ('John', 'Doe', '2000-01-01', 'password');
