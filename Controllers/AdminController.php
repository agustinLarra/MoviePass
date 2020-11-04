<?php 

namespace Controllers;

use Controllers\HomeController as HomeController;
use Models\Cine as Cine;
use DAO\CineDAO as CineDAO;
use Models\Sala as Sala;
use DAO\SalaDAO as SalaDAO;
use Models\Pelicula as Pelicula;
use DAO\PeliculaDAO as PeliculaDAO;
use Models\Funcion as Funcion;
use DAO\FuncionDAO as FuncionDAO;
use Controllers\ApiController as Api;
use DAO\GeneroDao as GeneroDao;
use DateTime ;


class AdminController{


    private $homeController;
    private $cineDao;
    private $salaDao;
    private $peliculaDao;

    function __constructor(){
        $this->cineDao = new CineDAO();
        $this->salaDao = new SalaDAO();
        $this->peliculaDao = new PeliculaDAO();
		$this->homeController = new homeController();
    }

    public function deleteCine($id){

        $cine = new Cine();

        $cine->setId($id);

        $cineDao = new CineDAO();
        $cineDao->Delete($cine);


        $this->homeController->viewListCines();

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


        $this->homeController->viewListCines();
    }

    public function addSala($idCine, $nombreSala, $precio, $capacidad,$tipoSala){


        $sala = new Sala();
        $sala->setNombre($nombreSala);
        $sala->setIdCine($idCine);
        $sala->setPrecio($precio);
        $sala->setCapacidad($capacidad);
        $sala->setTipoSala($tipoSala);

        $salaDao = new SalaDAO();
        $salaDao->Add($sala);

        $this->homeController->viewListSalas();
            
    }



    public function deleteSala($id){
        $sala = new Sala();

        $sala->setId($id);

        $salaDao = new SalaDAO();
        $salaDao->Delete($sala);

        $this->homeController->viewListSalas();
    }



    
    public function addFuncion($idPelicula, $dia,$hora, $idCine, $idSalas)//Deveria recibir la pelicula(por id) y la sala (por id)
    {
        $horario = $dia .' ' . $hora; //Traigo el dia y la hora por separado y las concateno , haci no hay problema con la letra del dia cuando se guarda en la base de datos
      
        $diaDeLaSemana = $this->saber_dia($dia);
        
       $funcion = new Funcion();
       $funcion->setIdPelicula($idPelicula);
       $funcion->setIdSala($idSalas);
       $funcion->setDia($dia);
       $funcion->setHora($hora);
       $funcion->setDescuento($this->diasDeDescuento($diaDeLaSemana));


        if( $this->checkHorario($dia,$hora))
        {  
                $this->newFuncion($funcion);
        }else{
            
            echo '<script>alert("Horario No disponible( aplique 15 minutos de diferencia)");</script>';
                /*
                require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
                require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
                require_once(VIEWS_ADMIN_PATH .'index.php');
                require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
                */
                $this->homeController->viewAddFunciones();
            }
      
    }

    private function newFuncion(Funcion $funcion)
    {   
        $funcionDAO = new FuncionDAO();
        $funcionDAO->Add($funcion);

        $this->homeController->viewListFunciones();
    }

    public function checkHorario($dia,$hora_aux)
    {
        $lista_funciones = new FuncionDAO();
        $lista_funciones = $lista_funciones->GetAll();
        $flag = 0;
        
        foreach($lista_funciones as $values)
        {
            

           if($dia == $values->getDia())
           {        
                   
                $aux = $values->getHora();//Asigno a aux la hora de la funcion

                $horario = new DateTime();//creo una variable tipo DateTime(solo nos interesa la hora)
                $horario_menor = new DateTime();

                list($hora,$minuto) = explode(":",$aux); //Divido la hora(ej: 12:30) en dos variables $hora=12 $minuto=30

                $horario->setTime($hora,$minuto);//Al horario le agrego la hora que teniamos en la funcion
                $horario_menor->setTime($hora,$minuto);

                $horario->modify('+15 minute');//Y aca le puedo agregar los 15 minutos,necesarios para la diferencia de horarios entre peliculas
                $horario_menor->modify('-15 minute');
            
                if(($hora_aux > ($horario->format('H:i:s'))) || ($hora_aux < ($horario_menor->format('H:i:s'))))//Comprueba 15 minutos antes y despues 
                {
                    return true;
                }
                else return false;
           }
        
        }

        return true;

    }
    
    public function deleteFuncion($id){
        $funcion = new Funcion();
        $funcion->setId($id);
        $funcionDAO = new FuncionDAO();
        $funcionDAO->Delete($funcion);
    }


    public function listarFunciones(){ 
        $FuncionDao = new FuncionDAO();
        $listaFunciones = $FuncionDao->GetAll();
        //Aca tengo en  $listaFunciones Todas las funciones
        $listaFuncionesConSalas = $this->agregarNombreSalaAFunciones(  $listaFunciones);
        //Aca tengo en  $listaFuncionesConSalas TODAS LAS FUNCIONES CON EL NOMBRE DE sala AGREGADO

        $listaFuncionesConCine = $this->agregarNombreCineAFunciones(  $listaFuncionesConSalas);
        //Aca tengo en  $listaFuncionesConCine TODAS LAS FUNCIONES CON EL NOMBRE DE cine AGREGADO
        $listaFuncionesCOMPLETA = $this->agregarTitlePeliculaAFunciones(  $listaFuncionesConCine);
        //Aca tengo en  $listaFuncionesCOMPLETA TODAS LAS FUNCIONES CON EL title de pelicula AGREGADO
    
        
        return $listaFuncionesCOMPLETA;
    }

    public function listarFuncionesByIdPelicula( $idPelicula ){ 
        $funcionDAO = new FuncionDAO();
        $listaFunciones = $funcionDAO->getFuncionesByIdPelicula($idPelicula);
        //Aca tengo en  $listaFunciones Todas las funciones
        $listaFuncionesConSalas = $this->agregarNombreSalaAFunciones(  $listaFunciones);
        //Aca tengo en  $listaFuncionesConSalas TODAS LAS FUNCIONES CON EL NOMBRE DE sala AGREGADO

        $listaFuncionesConCine = $this->agregarNombreCineAFunciones(  $listaFuncionesConSalas);
        //Aca tengo en  $listaFuncionesConCine TODAS LAS FUNCIONES CON EL NOMBRE DE cine AGREGADO
        $listaFuncionesCOMPLETA = $this->agregarTitlePeliculaAFunciones(  $listaFuncionesConCine);
        //Aca tengo en  $listaFuncionesCOMPLETA TODAS LAS FUNCIONES CON EL title de pelicula AGREGADO
    
        
        return $listaFuncionesCOMPLETA;
    }




    public function listarCinesConFuncion_ByIdPelicula($idPelicula){

        $funcionDAO = new FuncionDAO();
        $listaFunciones = $funcionDAO->getFuncionesByIdPelicula($idPelicula);
        //aca agarro las salas
        $listaFuncionesConSalas = $this->agregarNombreSalaAFunciones(  $listaFunciones);
        // aca agarro el cine
        $listaFuncionesConCine = $this->agregarCineAFunciones(  $listaFuncionesConSalas);

        return $listaFuncionesConCine;

    }




    public function listarFuncionesByIdPelicula( $idPelicula ){ 
        $funcionDAO = new FuncionDAO();
        $listaFunciones = $funcionDAO->getFuncionesByIdPelicula($idPelicula);
        //Aca tengo en  $listaFunciones Todas las funciones
        $listaFuncionesConSalas = $this->agregarNombreSalaAFunciones(  $listaFunciones);
        //Aca tengo en  $listaFuncionesConSalas TODAS LAS FUNCIONES CON EL NOMBRE DE sala AGREGADO

        $listaFuncionesConCine = $this->agregarCineAFunciones(  $listaFuncionesConSalas);
        //Aca tengo en  $listaFuncionesConCine TODAS LAS FUNCIONES CON EL NOMBRE DE cine AGREGADO
        $listaFuncionesCOMPLETA = $this->agregarTitlePeliculaAFunciones(  $listaFuncionesConCine);
        //Aca tengo en  $listaFuncionesCOMPLETA TODAS LAS FUNCIONES CON EL title de pelicula AGREGADO
    
        
        return $listaFuncionesCOMPLETA;
    }

    public function listarCiudadesXfuncion(  $listaFunciones ){

        $cineDAO = new CineDAO();
        $listaCiudades = array();
        foreach( $listaFunciones as $funcion ){

            $idCine = $funcion->getIdCine();
            array_push($listaCiudades,  $cineDAO->getCiudadById( $idCine ));

        }
        
        return $listaCiudades;
    }


    public function listarCines(){
        $listaCines = $this->cineDao->GetAll();
        return $listaCines;
    }

    public function listarSalas(){

        $salaDao = new SalaDAO();
        $listaSalas = $salaDao->GetAll();
        return $listaSalas;
    }

    
    public function listarSalasConCine(){

        $salaDao = new SalaDAO();

        $listaSalas = $salaDao->GetAll();
        $listaSalasConCine = $this->agregarNombreCineASala($listaSalas);
        return $listaSalasConCine;
    }

   

    public function listarPeliculas(){

        $peliculaDao = new PeliculaDAO();
        $peliculasList = $peliculaDao->GetAll();
        return $peliculasList;
    }


    public function agregarNombreCineASala( $listaSalas){

        $cineDao = new CineDAO();

        foreach($listaSalas as $sala){

            $cine = $this->cineDao->getByID($sala->getIdCine());
            $sala->setNombreCine(  $cine->getNombre()  );
        }
        
        return $listaSalas;
    }

    public function agregarNombreSalaAFunciones( $listaFunciones){

        $salaDao = new SalaDAO();

        foreach($listaFunciones as $funcion){

            $sala = $this->salaDao->getByID($funcion->getIdSala());
            $funcion->setNombreSala(  $sala->getNombre()  );
            $funcion->setIdCine(  $sala->getIdCine()  );

        }
        
        return $listaFunciones;
    }

    public function agregarCineAFunciones( $listaFunciones){


        $cineDao = new CineDAO();

        foreach($listaFunciones as $funcion){

            $cine = $this->cineDao->getByID($funcion->getIdCine());
            $funcion->setNombreCine(  $cine->getNombre()  );
            $funcion->setCiudad(  $cine->getCiudad()  );
        }
        
        return $listaFunciones;
    }

    
    public function agregarTitlePeliculaAFunciones( $listaFunciones){

        $peliculaDao = new PeliculaDAO();

        foreach($listaFunciones as $funcion){

            $pelicula = $this->peliculaDao->getPeliByID($funcion->getIdPelicula());
            $funcion->setTitlePelicula(  $pelicula->getTitle()  );
        }
        
        return $listaFunciones;
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


   




    private function saber_dia($nombredia) {
        
        $dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
        $fecha = $dias[date('N', strtotime($nombredia))];
        return  $fecha;
    }
    private function diasDeDescuento($dia)
    {   
        if((strcmp($dia,DIA_DESCUENTO_1)==0) || (strcmp($dia,DIA_DESCUENTO_2)==0)) {
            return true;
        }
        
        return 0;
    }
    


      
    public function actualizarPeliculas(){
  
        $this->generosToBd();

        $this->peliculasToBd();
        
        $this->homeController->viewHomeAdmin();


        //Poner un script que diga que se registraron exitosamente
    }

      //Funcion que pasa de la Api a la bd,Comprobar los tips de datos de la bd
      public function peliculasToBd()
      { 
          $peliculaDao = new PeliculaDAO();

          $arrayCartelera = array();
          $apiPeliculas = new Api();
          $arrayCartelera = $apiPeliculas->getCarteleraApi();
          foreach($arrayCartelera as $value)
          {
              if(  $this->peliculaDao->checkPeliRepetida($value) == false ){

                $this->peliculaDao->SaveFromApi($value);
              }
          }
      }

     
      public function generosToBd()
      {
          $apiGeneros = new Api();
          $arrayGeneros = $apiGeneros->getGenerosApi();
          $generoDao = new GeneroDao();
          foreach($arrayGeneros as $values)
          {
            if(  $generoDao->checkGeneroRepetido($values) == false ){

                $generoDao->SaveGenero($values);
            
            }    
          }
  
      }


      public function modifyCine($id)
    {
        echo $id;
        $cine = new Cine();
        $cine->setId($id);

        $retrieve = $this->cineDAO->RetrieveOne($id);


        var_dump($retrieve); ///ME GUARDA EN UN ARRAY TODO EL CINE QUE TENGA EL ID QUE LE PASO.

        $updateCine = $this->cineDAO->ModifyCine($cine);


        echo $updateCine;
        include_once('ViewsAdmin/modifyShowList.php');
        //$this->showModifyCine($retrieve);
    }

    public function showModifyCine($retrieve){
        //$listaCines = $this->retrieve();
        include_once('ViewsAdmin/modifyShowList.php');

    }

}
?>