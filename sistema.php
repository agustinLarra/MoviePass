<?php


require "Config/Autoload.php";
require "Config/Config.php";


$objUser = new User();

$insert = $objUser->insertUsuario("Carlos","Litos",42547542,"carlitos@gmail.com","carlitos123");
echo $insert;



?>