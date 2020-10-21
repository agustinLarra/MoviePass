create database BD_MoviePass;
use BD_MoviePass;

#drop 

#select
select * from users;


create table users(
	Id_User int not null auto_increment,
    FirstName varchar(35),
    LastName varchar(35),
    DNI int,
    Email varchar(30),
    Pass varchar (35),
    constraint `PK_User` primary key(Id_User)
);

insert into users (FirstName,LastName,DNI,Email,Pass) values ("Admin","","","admin@gmail.com","admin123");
    