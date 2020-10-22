<?php 

namespace Controllers;


use Models\Cine as Cine;
use Models\Sala as Sala;
use DAO\CineDAO as CineDAO;

class AdminController{



    public function Index(){

        /// Verificar que la session tenga datos y sea la de admin 
    
        header('location:ViewsAdmin/index.php');

    }

    public function showAddCine(){
        header('location:../ViewsAdmin/addCine.php');

    }

    public function showAddSalas(){
        header('location:../ViewsAdmin/addSalas.php');

    }

    public function showListCine(){
  
        $cine = new Cine();
        $cineDao = new CineDAO();
        $cineList = $cineDao->GetAll();

        var_dump($cineList);
        include( '../ViewsAdmin/header.php');
        include('../ViewsAdmin/listCines.php');
    }


    public function addCine($nombre, $ciudad, $calle, $numero){

        /// Podriamos pedir en el formulario que suban una foto del cine, para despues mostrarlo con foto, para la foto tendriamos que cambiarle el nombre y guardarla en una carpeta local, la foto debe llamarse igual que el cine y anidarle el .jpg para que si en algun momento borran el cine, tambien borrar la fotouse Models\Cine as Cine;
        $cine = new Cine();
        $cine->setNombre($nombre);
        $cine->setCiudad($ciudad);
        $cine->setCalle($calle);
        $cine->setNumero($numero);

        $cineDao = new CineDAO();
        // aca va la base de datos (esperar a solera)
        $cineDao->Add($cine);

        header('location:../ViewsAdmin/addCine.php');

    }

    public function addSala($nombreSala, $nombreCine, $precio, $capacidad){

        // $cineDao = new CineDAO();
        // $idCine = $cineDao->getIDbyName($nombreCine);
        //Consulta que haga Select id_sala from sala where nombre = $nombreSala;
        //Cuando ya tengo el id lo paso a la clase

        $sala = new Sala();
        $sala->setNombre($nombreSala);
        $sala->setIdCine();
        $sala->setPrecio($precio);
        $sala->setCapacidad($capacidad);

        $salaDao = new SalaDAO();
        // aca va la base de datos (esperar a solera)
        $salaDao->Add($sala);

        header('location:../ViewsAdmin/addSalas.php');

    }


    public function listarCines(){

        //Hacer una consulta en la base de datos haciendo el select nombre from cines

    }

}
?>