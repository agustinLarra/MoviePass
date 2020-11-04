Id_Compra int not null auto_increment,
    Id_User int not null,
    #Cantidad_Entradas int not null,
    Total  float not null,

    Id_Entradas int not null auto_increment,
    QR int not null ,
    Id_Compra int not null,
	Id_Funcion int not null,

    Id_Funcion int not null auto_increment,
    Id_Pelicula int not null,
    Id_Sala int not null,
    Dia date,
    Hora time,
	Descuento boolean,


<?php namespace Models;

class Entrada {


    private $Id_Funcion;
    private $Id_Pelicula;
    private $Title_Pelicula;
    private $Id_Cine;
    private $Nombre_Cine;
    private $Id_Sala;
    private $Nombre_Sala;
    private $Dia;
    private $Hora;
    private $Descuento;
    private $Cantidad_Entradas;
    private $Total;
    private $QR;
    private $Id_Usuario;




} ?>    