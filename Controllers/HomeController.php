<?php 

namespace Controllers;
use Controllers\ApiController as Api;
use DAO\PeliculaDAO as PeliculaDAO;
use DAO\GeneroDao as GeneroDao;
use DAO\FuncionDao as FuncionDao;
use Models\Sala as Sala;
use Models\Pelicula as Pelicula;
use DAO\SalaDAO as SalaDAO;

class HomeController{

    public function Index(){
       /// Abrir session y verificar si hay usarios en session.
        //  Si no hay --> se llama a la funcion login()
        //  Si hay, se hace lo esto de abajo (Tendriamos que hacerla una funcion aparte)
        // *!implementar cuando funcione el login!*

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require(VIEWS_PATH.'inicio.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    }



    public function viewLogin(){
        ///require_once('Views/login.php');
        require_once(VIEWS_PATH.'login.php');
     
    }
    public function viewSignUp(){
        require_once('Views/header.php');
        require(VIEWS_PATH.'signUp.php');
        require_once('Views/footer.php');
    }


    public function viewCartelera( ){

      try{
        
        $array_peliculas = $this->cargarCartelera();
        
        $arrayGeneros = $this->cargarGeneros();
 
        $lista_dias = $this->cargarFunciones();

      }catch(Exception $e){

        $message = $e->get_message();
       // throw new Exception($e->get_message());

      }
        

  

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require(VIEWS_PATH.'billboard.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    
    }


    
    public function viewFechas()
    {
        $idFuncion = $_POST['Id_funcion'];

        $array_peliculas = $this->filtarPelisXFecha($idFuncion);
                    
        $arrayGeneros = $this->cargarGeneros();
         
        $lista_dias = $this->cargarFunciones();
        
        
        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_PATH.'billboard.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
            
    }

    public function viewGenero( )
    {

        $idGenero = $_POST['Id_genero'];
        //Agarrar de la tabla peliXgenero las pelis que macheen este idGenero
        $array_peliculas = $this->filtarPelisXgenero($idGenero);

        $arrayGeneros = $this->cargarGeneros();
 
        $lista_dias = $this->cargarFunciones();


        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_PATH.'billboard.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    


    }

    public function viewHomeAdmin(){
       

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require(VIEWS_ADMIN_PATH.'index.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    }

    public function viewAddCine(){
        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require(VIEWS_ADMIN_PATH.'addCine.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    }

    public function viewListCines(){

        $adminController = new AdminController();
        $listCines = $adminController->listarCines();

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require(VIEWS_ADMIN_PATH.'listCines.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    }

 
    public function viewAddFunciones(){

        $adminController = new AdminController();
        // Levanto las peliculas de la base de datos
        $peliculasList = $adminController->listarPeliculas();
        // Levanto las salas de la base de datos
        $cineList = $adminController->listarCines();
     
        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require_once(VIEWS_ADMIN_PATH.'addFunciones.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');

    }

    public function viewAddSalas(){
        $adminController = new AdminController();
        $cineList = $adminController->listarCines();

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require(VIEWS_ADMIN_PATH.'addSalas.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');

        //header('location:../ViewsAdmin/addSalas.php');

    }
    
    public function viewListSalas(){

      $adminController = new AdminController();
      $listSalas = $adminController->listarSalasConCine();

      require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
      require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
      require(VIEWS_ADMIN_PATH.'listSalas.php');
      require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
  }

  public function viewListFunciones(){

    $adminController = new AdminController();
    $listFunciones = $adminController->listarFunciones();

    require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
    require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
    require(VIEWS_ADMIN_PATH.'listFunciones.php');
    require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
}




      public function cargarCartelera(){

        //Levantar peliculas que esten linkeadas en funciones
        $peliculaDao = new PeliculaDAO();
       //$peliculaList = $peliculaDao->GetPeliculasEnFunciones();
       
        try{
          $peliculaList = $peliculaDao->GetAll();
        }catch(Exception $e){
           throw new Exception($e->get_message());
        }

        return  $peliculaList ;
      }


      public function cargarGeneros(){

        $generos_bd = new GeneroDAO();
        $arrayGeneros = $generos_bd->getAll();
        return  $arrayGeneros  ;
      }


      public function cargarFunciones(){

        $funciones_bd = new FuncionDao();
        $funciones = $funciones_bd->GetAll();

        $lista_dias = $this->diasCartelerasSinDuplicados($funciones);

        return $lista_dias;
      }
      
      public function diasCartelerasSinDuplicados($funciones)
      {
          $array_dias = array();
          foreach($funciones as $values){
             array_push($array_dias,$values->getDia());
          }
        return array_unique($array_dias);
      }

    

      private function filtarPelisXgenero($idGenero)
      {
        $peliDAO = new PeliculaDAO();
        $arregloPeliculas = $peliDAO->FiltrarPelisXGenero($idGenero);
        return $arregloPeliculas;

      }

      private function filtarPelisXFecha($idFuncion)
      {
            $funcion = new FuncionDao();

            $aux = $funcion->GetDia($idFuncion);//Me devuelve las funciones de un dia;

            $peliculas_cartelera = $this->fechaToPelicula($aux);

            return $peliculas_cartelera;
      }


       private function fechaToPelicula($funciones)
      {
            $lista_peliculas = array();
            $pelicula = new PeliculaDAO() ;
            foreach($funciones as $values)
            {
                $pelicula_cartelera = $pelicula->RetrieveOne($values->getIdpelicula());//Busco en las a partir del id_pelicula de la funcion
                array_push($lista_peliculas,$pelicula_cartelera);
            }



         return $lista_peliculas;
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


      public function Comprar(){


        $pelicula = new Pelicula();
        $pelicula->setId($_POST["id"]);
        $pelicula->setTitle($_POST["title"]);
        $pelicula->setOverview($_POST["overview"]);

        $adminController = new AdminController();
        $listaFunciones = $adminController->listarFuncionesByIdPelicula( $pelicula->getId() );


        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_PATH.'comprarEntradas.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');

      }

     





} ?>