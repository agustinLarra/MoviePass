create database BD_MoviePass;
use BD_MoviePass;

#SELECTS 
select * from users;
select * from cines;
select * from butacas;
select * from pelicula;
select * from funciones;
#---------------------
#DROPS


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
insert into users (FirstName,LastName,DNI,Email,Pass) values ("Pepe","Loco","","pepe@gmail.com","pepe123");


create table cines(
	Id_Cine int not null auto_increment,
    Nombre varchar(30),
    Ciudad varchar(30),
    Calle varchar(30),
    Numero int,
    
    constraint `PK_Cine` primary key(Id_Cine)
);

create table salas(
	Id_Sala int not null auto_increment,
    Nombre varchar(30),
    Precio float,
    Capacidad int not null,
    Id_Cine int not null,
    
    constraint `PK_Salas` primary key(Id_Sala),
    constraint `FK_Id_Cine` foreign key (Id_Cine) references cines(Id_Cine)
);

create table butacas(
	Id_Butaca int not null auto_increment,
    Numero int not null,
    Id_Sala int not null,
    
    constraint `PK_Butacas` primary key (Id_Butaca),
    constraint `FK_Butacas` foreign key (Id_Sala) references salas(Id_Sala)
);

create table pelicula(
	Id_Pelicula int not null auto_increment,
    PosterPath blob,
	PosterHorizontal blob,
    Title varchar(35),
	Genre varchar(35),
    Overview varchar(150),
    
    constraint `PK_Pelicula` primary key (Id_Pelicula)
);


create table funciones(
	Id_Funcion int not null auto_increment,
	Id_Cine int not null,
    Id_Pelicula int not null,
    Id_Sala int not null,
    Horario dateTime,
    
    constraint `PK_Funcion` primary key (Id_Funcion),
    constraint `FK_Cine` foreign key (Id_Cine) references cines(Id_Cine),
    constraint `FK_Pelicula` foreign key (Id_Pelicula) references pelicula(Id_Pelicula),
    constraint `FK_Sala` foreign key (Id_Sala) references salas(Id_Sala)
);





