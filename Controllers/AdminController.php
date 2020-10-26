<?php 

namespace Controllers;


use Models\Cine as Cine;
use DAO\CineDAO as CineDAO;
use Models\Sala as Sala;
use DAO\SalaDAO as SalaDAO;
use Models\Pelicula as Pelicula;
use DAO\PeliculaDAO as PeliculaDAO;
use Models\Funcion as Funcion;
use DAO\FuncionDAO as FuncionDAO;


class AdminController{



    public function Index(){

        /// Verificar que la session tenga datos y sea la de admin 
    
        header('location:ViewsAdmin/index.php');

    }
    //TODOS LOS SHOW ESTOS TIENEN QUE IR EN EL HOME CONTROLER!!! - Rina
    public function showAddCine(){
        header('location:../ViewsAdmin/addCine.php');

    }

    public function showAddSalas(){
       
        $cineDao = new CineDAO();
        $cineList = $cineDao->GetAll();
        include('ViewsAdmin/addSalas.php');
        //header('location:../ViewsAdmin/addSalas.php');

    }

    public function showAddFunciones(){

        // Levanto las peliculas de la base de datos
        $peliculasList = $this->listarPeliculas();
        // Levanto las salas de la base de datos
        $cineList = $this->listarCines();

        include('ViewsAdmin/addFunciones.php');
        //header('location:../ViewsAdmin/addFunciones.php');

    }

    public function showListCine(){
  
        $listaCines = $this->listarCines();
        include_once('ViewsAdmin/listCines.php');
    }
  
    

    public function deleteCine($id, $nombre){

        $cine = new Cine();

        $cine->setId($id);
        $cine->setNombre($nombre);
    

        $cineDao = new CineDAO();
        $cineDao->Delete($cine);

        $this->showListCine();

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

        $this->showAddCine();

    }

    public function addSala($idCine, $nombreSala, $precio, $capacidad,$tipoSala){


        $sala = new Sala();
        $sala->setNombre($nombreSala);
        $sala->setIdCine($idCine);
        $sala->setPrecio($precio);
        $sala->setCapacidad($capacidad);
        $sala->setTipoSala($tipoSala);

        $salaDao = new SalaDAO();
        // aca va la base de datos (esperar a solera)
        $salaDao->Add($sala);

        header('location:../ViewsAdmin/addSalas.php');

    }


    public function addFuncion($idPelicula, $horario, $idSalas)//Deveria recibir la pelicula(por id) y la sala (por id)
    {

        echo "ESto llego:  Id peli:".$idPelicula . '  horario   '. $horario.'  sala   '.$idSalas;

       $funcion = new Funcion();
       $funcion->setIdPelicula($idPelicula);
       $funcion->setIdSala($idSalas);
       $funcion->setHorario($horario);
       $funcion->setDescuento(true);
        //investigar como se trabaja para saber si es martes o miercoles

        $funcionDAO = new FuncionDAO();
        $funcionDAO->Add($funcion);

        header('location:../ViewsAdmin/index.php');

    }

    public function listarCines(){
        $cineDao = new CineDAO();
        $listaCines = $cineDao->GetAll();
        return $listaCines;
    }

    public function listarSalas(){
        $salaDao = new SalaDAO();
        $listaSalas = $salaDao->GetAll();
        return $listaSalas;
    }

    public function listarPeliculas(){
        $peliculaDao = new PeliculaDAO();
        $peliculasList = $peliculaDao->GetAll();
        return $peliculasList;
    }

    public function selectDinamicoSalas(){
      
        $salaDao = new SalaDAO();
        $listaSalas = $salaDao->GetByIdCine($_GET['id_cine']);

        echo'<select name="select" id="select">';
      
               foreach($listaSalas as $value){      
                    echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
               }
        echo'</select>';
    }

}
?>