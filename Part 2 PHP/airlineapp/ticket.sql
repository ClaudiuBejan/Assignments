create database tickets;

use tickets;

create table tickets
(
  ticketid int unsigned not null auto_increment primary key,
  firstname char(60) not null,
  lastname char(60) not null,
  dob date not null,
  outboundairport char(30) not null,
  inboundairport char(30) not null,
  flightdate date not null,
)

INSERT INTO tickets (firstname, lastname, dob, outboundairport, inboundairport, flightdate)
VALUES ('John', 'Doe', '2000-01-01', 'Praga', 'Lisbon');