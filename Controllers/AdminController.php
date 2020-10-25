<?php 

namespace Controllers;


use Models\Cine as Cine;
use Models\Sala as Sala;
use DAO\SalaDAO as SalaDAO;
use DAO\CineDAO as CineDAO;

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

        // Aca se tienen que levantar las peliculas de la base de datos
        header('location:../ViewsAdmin/addFunciones.php');

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


    public function AddFuncion()//Deveria recibir la pelicula(por id) y la sala (por id)
    {
        //forzado
        $pelicula = 2;
        $sala = 1;
       // $horaio = 13.40;
       $descuento = 1;

       $funcion = new Funcion();//Agrego una nueva funcion
       $funcion->setIdPelicula($pelicula);
       $funcion->setIdSala($sala);
       $funcion->setDescuento($descuento);

        $aux = new FuncionDAO();
       // $aux->Add($funcion);//Agrego la pelicula 2 en la sala 1 

       $listaFunciones=$aux->GetAll();

        $peli = new PeliculaDAO();
        foreach($listaFunciones as $values)//Devuelvo cada pelicula buscandola por el Id_Pelicula (De funciones)
        {
             $datos = $peli->GetOne($values->getIdPelicula());
             echo $datos->getTitle() . "<br>";
             echo $datos->getOverview();
             echo "</br>" . "</br>";
             
             
        }

    }

    public function listarCines(){
        $cineDao = new CineDAO();
        $listaCines = $cineDao->GetAll();
        return $listaCines;
    }

    public function listarSalas(){
        $salaDao = new SalaDAO();
        $listaSalas = $salaDao->GetAll();
        var_dump($listaSalas);
    }

}
?>