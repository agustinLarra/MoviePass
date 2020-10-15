<?php 

namespace Controllers;


use Models\Cine as Cine;
use DAO\CineDAO as CineDAO;

class AdminController{



    public function Index(){

        /// Verificar que la session tenga datos y sea la de admin 
    
        header('location:ViewsAdmin/index.php');

    }

    public function showAddCine(){
        header('location:../ViewsAdmin/addCine.php');

    }

    public function showListCine(){
<<<<<<< HEAD
<<<<<<< HEAD
  
        $cine = new Cine();
        $cineDao = new CineDAO();
        $cineList = $cineDao->GetAll();

        var_dump($cineList);
        include( '../ViewsAdmin/header.php');
        include('../ViewsAdmin/listCines.php');
=======
        header('location:../ViewsAdmin/listCine.php');
>>>>>>> 2eebff15d4bfc904d705c684e7b676c7c97b9ac4
=======
        header('location:../ViewsAdmin/listCine.php');
>>>>>>> 2eebff15d4bfc904d705c684e7b676c7c97b9ac4
    }


    public function addCine($nombre, $direccion, $capacidad, $valorEntrada){

        /// Podriamos pedir en el formulario que suban una foto del cine, para despues mostrarlo con foto, para la foto tendriamos que cambiarle el nombre y guardarla en una carpeta local, la foto debe llamarse igual que el cine y anidarle el .jpg para que si en algun momento borran el cine, tambien borrar la fotouse Models\Cine as Cine;
        $cine = new Cine();
        $cine->setNombre($nombre);
        $cine->setDireccion($direccion);
        $cine->setCapacidad($capacidad);
        $cine->setValorEntrada($valorEntrada);

        $cineDao = new CineDAO();
        $cineDao->Add($cine);

        header('location:../ViewsAdmin/addCine.php');

    }


}
?>