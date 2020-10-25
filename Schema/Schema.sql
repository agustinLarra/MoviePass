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
drop database BD_MoviePass;

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
insert into cines (Nombre,Ciudad,Calle,Numero) values ("Ambassador","Mar del plata","Tejedor",800);



create table salas(
	Id_Sala int not null auto_increment,
    Nombre varchar(30),
    Precio float,
    Capacidad int not null,
    Tipo_sala varchar(30), 
    Id_Cine int not null,
    
    constraint `PK_Salas` primary key(Id_Sala),
    constraint `FK_Id_Cine` foreign key (Id_Cine) references cines(Id_Cine) on delete cascade on update cascade
);

insert into salas (Nombre,Precio,Capacidad,Tipo_sala,Id_Cine) values ("Grande",200,400,"2D",1);
insert into salas (Nombre,Precio,Capacidad,Tipo_sala,Id_Cine) values ("S",500,50,"3D",1);

create table peliculas(
	Id_Pelicula int not null auto_increment,
    PosterPath blob,
	PosterHorizontal blob,
    Title varchar(35),
    Overview varchar(150),
    
    constraint `PK_Pelicula` primary key (Id_Pelicula)
);


insert into peliculas (Title) values ("Buscando a nemo");


create table generos(
	Id_Genero int not null auto_increment,
    Nombre varchar(35),
    
    constraint `PK_Genero` primary key (Id_Genero)
);

insert into generos (Nombre) values ("Aventura");

create table peliculasXgenero(
	Id_Peliculas_Genero int not null auto_increment,
	Id_Genero int not null ,
    Id_Pelicula int not null ,
    
    constraint `PK_Peliculas_Genero` primary key (Id_Peliculas_Genero),
	constraint `FK_PXG_pelicula` foreign key (Id_Pelicula) references peliculas(Id_Pelicula) on delete cascade on update cascade,
    constraint `FK_PXG_genero` foreign key (Id_Genero) references generos(Id_Genero) on delete cascade on update cascade

);

insert into peliculasXgenero (Id_Genero,Id_Pelicula) values (1,1);



create table funciones(
	Id_Funcion int not null auto_increment,
    Id_Pelicula int not null,
    Id_Sala int not null,
    Horario dateTime,
	Descuento boolean,
    
    constraint `PK_Funcion` primary key (Id_Funcion),
    constraint `FK_Pelicula` foreign key (Id_Pelicula) references peliculas(Id_Pelicula) on delete cascade on update cascade,
    constraint `FK_Sala` foreign key (Id_Sala) references salas(Id_Sala) on delete cascade on update cascade
);
insert into funciones (Id_Pelicula,Id_Sala,Descuento) values (1,1,true);



create table compras(

	Id_Compra int not null auto_increment,
    Id_User int not null,
    #Cantidad_Entradas int not null,
    Total  float not null,
    
    constraint `PK_Compras` primary key (Id_Compra),
    constraint `FK_Compras` foreign key (Id_User) references users(Id_User) on delete cascade on update cascade
);
insert into compras (Id_User,Total) values (1,300);



create table entradas(

	Id_Entradas int not null auto_increment,
    QR int not null ,
    Id_Compra int not null,
	Id_Funcion int not null,
  
    constraint `PK_Entradas` primary key (Id_Entradas),
    constraint `FK_Entradas_Compra` foreign key (Id_Compra) references compras(Id_Compra) on delete cascade on update cascade,
    constraint `FK_Entradas_Funciones` foreign key (Id_Funcion) references funciones(Id_Funcion) on delete cascade on update cascade
);

insert into entradas (QR,Id_Compra,Id_Funcion) values (10000,1,1);
insert into entradas (QR,Id_Compra,Id_Funcion) values (10001,1,1);
insert into entradas (QR,Id_Compra,Id_Funcion) values (10002,1,1);

select e.QR,c.Total,u.FirstName
from entradas as e
inner join compras as c
on e.Id_Compra = c.Id_Compra
inner join users as u
on u.Id_User = c.Id_User
group by e.QR;


select s.Precio, f.*
from funciones as f
inner join salas as s
on f.Id_Sala = s.Id_Sala;




