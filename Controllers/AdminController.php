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
use JsonDAO\PeliculaJson as PeliculasJson;
use DAO\EntradaDAO as EntradaDAO;
use DAO\CompraDAO as CompraDAO;
use Models\Compra as Compra;

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
		$this->homeController = new HomeController();
    }

    public function deleteCine($id){
        //$id = $_POST['id'];
        
        $cine = new Cine();

        $cine->setId($id);

        $cineDao = new CineDAO();

        try{
               $cineDao->Delete($id);
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        

        $homeController = new HomeController();
        $homeController->viewListCines();

    }


    public function deleteSala($id){
        $sala = new Sala();

        $sala->setId($id);
  
        $salaDao = new SalaDAO();
        try{
            $salaDao->Delete($id);   
        }catch(Exception $e){
            throw new Exception($e->get_messeage());
        }
        
        $homeController = new HomeController();
        $homeController->viewListSalas();
    }

    public function deleteFuncion($id){
        $funcion = new Funcion();

        $funcion->setId($id);
  
        $funcionDAO = new FuncionDAO();

        try{
            $funcionDAO->Delete($id);
        }
        catch(Exception $e){
            throw new Exception($e->get_messeage());
        }
        
        $homeController = new HomeController();
        $homeController->viewListFunciones();
    }
    


    public function addCine($nombre, $ciudad, $calle, $numero){

        /// Podriamos pedir en el formulario que suban una foto del cine, para despues mostrarlo con foto, para la foto tendriamos que cambiarle el nombre y guardarla en una carpeta local, la foto debe llamarse igual que el cine y anidarle el .jpg para que si en algun momento borran el cine, tambien borrar la fotouse Models\Cine as Cine;
        $cine = new Cine();
        $cine->setNombre($nombre);
        $cine->setCiudad($ciudad);
        $cine->setCalle($calle);
        $cine->setNumero($numero);

        $cineDao = new CineDAO();
        try{
             $cineDao->Add($cine);
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        $homeController = new HomeController();
        $homeController->viewListCines();
    }

    public function addSala($idCine, $nombreSala, $precio, $capacidad,$tipoSala){


        $sala = new Sala();
        $sala->setNombre($nombreSala);
        $sala->setIdCine($idCine);
        $sala->setPrecio($precio);
        $sala->setCapacidad($capacidad);
        $sala->setTipoSala($tipoSala);

        $salaDao = new SalaDAO();
        try{
                $salaDao->Add($sala);
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
       

        $homeController = new HomeController();
        $homeController->viewListSalas();
            
    }



    public function altaSala($id)
    {
        $salaDao = new SalaDAO();

        try{
            $salaDao->Delete($id);   
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        

        $homeController = new HomeController();
        $homeController->viewListSalas();

    }

    public function altaCine($id)
    {
        $salaDao = new SalaDAO();

        try{
             $salaDao->Alta($id);  
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        

        $homeController = new HomeController();
        $homeController->viewListCines();

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


        if( $this->checkHorario($dia,$hora)){  
            
            try{
                $this->newFuncion($funcion);
            }catch(Exception $e){
                throw new Exception($e->get_message());
            }
              
        }else{
            
            echo '<script>alert("Horario No disponible( aplique 15 minutos de diferencia)");</script>';
                /*
                require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
                require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
                require_once(VIEWS_ADMIN_PATH .'index.php');
                require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
                */
                $homeController = new HomeController();
                $homeController->viewAddFunciones();
            }
      
    }
    public function modificarSala($id,$nombre,$precio,$capacidad,$tipo)
    {
        try{
        
        $Sala_dao = new SalaDAO();
        $Sala_dao->EditSala($id,$nombre,$precio,$capacidad,$tipo);

        $Home = new HomeController();
        $Home->viewListSalas();
        }catch(Exception $e){
            throw new Exception($e->get_message());
        }

        
    }

    private function newFuncion(Funcion $funcion)
    {   
       
        $peliculaDAO = new PeliculaDAO();
        $json = new PeliculasJson();//Desde el id de la pelicula en funcion , la busco en el json y la guardo;
        $pelicula = $json->returnById($funcion->getIdPelicula());

        try{
                if($pelicula != false){
                    $resul = $peliculaDAO->RetrieveOne($pelicula->getId());//Para no guardar dos veces una pelicula
                    
                    if($resul == false) {
                            $peliculaDAO->SavePelicula($pelicula);
                    }  
                }
                else {echo "error";}

                $funcion->setPosterPelicula($pelicula->getPosterPath());
                $funcionDAO = new FuncionDAO();
                $funcionDAO->Add($funcion);

        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        $Home_controller = new HomeController();
   
        $Home_controller->viewListFunciones();
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
    /*
    public function deleteFuncion($id){
        $funcion = new Funcion();
        $funcion->setId($id);
        $funcionDAO = new FuncionDAO();
        try{
                $funcionDAO->Delete($funcion);
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
       
    }
*/

    public function listarFunciones(){ 
        $FuncionDao = new FuncionDAO();

        try{

            $listaFunciones = $FuncionDao->GetAll();
            //Aca tengo en  $listaFunciones Todas las funciones
            $listaFuncionesConSalas = $this->agregarNombreSalaAFunciones(  $listaFunciones);
            //Aca tengo en  $listaFuncionesConSalas TODAS LAS FUNCIONES CON EL NOMBRE DE sala AGREGADO
            $listaFuncionesConCine = $this->agregarCineAFunciones(  $listaFuncionesConSalas);
            //Aca tengo en  $listaFuncionesConCine TODAS LAS FUNCIONES CON EL NOMBRE DE cine AGREGADO
            $listaFuncionesConPelicula = $this->agregarTitlePeliculaAFunciones(  $listaFuncionesConCine);
            //Aca tengo en  $listaFuncionesCOMPLETA TODAS LAS FUNCIONES CON EL title de pelicula AGREGADO
            $listaFuncionesCompleta = $this->agregarEntradasAFuncion($listaFuncionesConPelicula);

        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        return $listaFuncionesCompleta;
    }

    public function listarFuncionesByIdPelicula( $idPelicula ){ 
        $funcionDAO = new FuncionDAO();

        try{
                 $listaFunciones = $funcionDAO->getFuncionesByIdPelicula($idPelicula);
                //Aca tengo en  $listaFunciones Todas las funciones
                $listaFuncionesConSalas = $this->agregarNombreSalaAFunciones(  $listaFunciones);
                //Aca tengo en  $listaFuncionesConSalas TODAS LAS FUNCIONES CON EL NOMBRE DE sala AGREGADO
                $listaFuncionesConCine = $this->agregarCineAFunciones(  $listaFuncionesConSalas);
                //Aca tengo en  $listaFuncionesConCine TODAS LAS FUNCIONES CON EL NOMBRE DE cine AGREGADO
                $listaFuncionesCOMPLETA = $this->agregarTitlePeliculaAFunciones(  $listaFuncionesConCine);
                //Aca tengo en  $listaFuncionesCOMPLETA TODAS LAS FUNCIONES CON EL title de pelicula AGREGADO   
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
      
        
        return $listaFuncionesCOMPLETA;
    }




    public function listarCinesConFuncion_ByIdPelicula($idPelicula){

        $funcionDAO = new FuncionDAO();

        try{
                
            $listaFunciones = $funcionDAO->getFuncionesByIdPelicula($idPelicula);
            //aca agarro las salas
            $listaFuncionesConSalas = $this->agregarNombreSalaAFunciones(  $listaFunciones);
            // aca agarro el cine
            $listaFuncionesConCine = $this->agregarCineAFunciones(  $listaFuncionesConSalas);

            $listaFuncionesCompleta = $this->agregarEntradasAFuncion($listaFuncionesConCine);   
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
       

        return $listaFuncionesCompleta;

    }




    public function listarCiudadesXfuncion(  $listaFunciones ){

        $cineDAO = new CineDAO();
        $listaCiudades = array();
        try{
            foreach( $listaFunciones as $funcion ){

                $idCine = $funcion->getIdCine();
                array_push($listaCiudades,  $cineDAO->getCiudadById( $idCine ));
    
            }  
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        
        return $listaCiudades;
    }


    public function listarCines(){
        $cineDao = new CineDAO();
        try{
            $listaCines = $cineDao->GetAll();
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        return $listaCines;
    }

    public function listarSalas(){

        $salaDao = new SalaDAO();
        try{
            $listaSalas = $salaDao->GetAll();   
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        return $listaSalas;
    }

    
    public function listarSalasConCine(){

        $salaDao = new SalaDAO();
        try{
            $listaSalas = $salaDao->GetAll();   
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        $listaSalasConCine = $this->agregarNombreCineASala($listaSalas);
        return $listaSalasConCine;
    }

   

    public function listarPeliculas(){

        $peliculaDao = new PeliculaDAO();
        try{
               $peliculasList = $peliculaDao->GetAll();
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        
        return $peliculasList;
    }


    public function agregarEntradasAFuncion($Listafunciones)
    {
        $arregloDeIdCompra = array();
        $entradaDAO = new EntradaDAO();
        $compraDAO = new CompraDAO();

        try{
              //Por cada funcion que haya
            foreach($Listafunciones as $funcion){
                //Busco las entradas que machean con esta funcion Y guardo los id de compra en un arreglo
                $arregloDeIdCompra = $entradaDAO->getIdCompraByIdFuncion($funcion->getId());
                $entradasVendidas = 0;
                $recaudacionTotal = 0;
                // por cada id de compra, perteneciente a esta funcion
                foreach($arregloDeIdCompra as $idCompra){
                    $compra = $compraDAO->getById($idCompra);
                    // Empiezo a contar por cada compra, las entradas y el total que salio
                    $entradasVendidas += $compra->getCantidadEntradas();
                    $recaudacionTotal += $compra->getTotal();
                }
                // una vez que se repasaron todas las compras vinculadas a esta funcion
                // agrego todas las entradas y totales que saque de cada compra
                $funcion->setEntradasVendidas ($entradasVendidas);
                $funcion->setRecaudacionTotal( $recaudacionTotal );
            }   
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
      

        return $Listafunciones;

    }

    public function agregarNombreCineASala( $listaSalas){

        $cineDao = new CineDAO();
        try{
             foreach($listaSalas as $sala){
                $cine = $cineDao->getByID($sala->getIdCine());
                $sala->setNombreCine(  $cine->getNombre()  );
            }   
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }

       
        
        return $listaSalas;
    }

    public function agregarNombreSalaAFunciones( $listaFunciones){

        $salaDao = new SalaDAO();
        try{
            foreach($listaFunciones as $funcion){
                $sala = $salaDao->getByID($funcion->getIdSala());
                $funcion->setClassSala( $sala );
            }   
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        
        return $listaFunciones;
    }

    public function agregarCineAFunciones( $listaFunciones){


        $cineDao = new CineDAO();
        try{
             foreach($listaFunciones as $funcion){
                $cine = $cineDao->getByID($funcion->getClassSala()->getIdCine());
                $funcion->setClassCine( $cine );
            }  
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        
        
        return $listaFunciones;
    }

    
    public function agregarTitlePeliculaAFunciones( $listaFunciones){

        $peliculaDao = new PeliculaDAO();

        foreach($listaFunciones as $funcion){

            try{
                $pelicula = $peliculaDao->getPeliByID($funcion->getIdPelicula());
                $funcion->setPosterPelicula( $pelicula->getPosterPath() );
                $funcion->setTitlePelicula(  $pelicula->getTitle()  );
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
        }
        
        return $listaFunciones;
    }





    public function selectDinamicoSalas(){
      
        $salaDao = new SalaDAO();

        try{
              $listaSalas = $salaDao->GetByIdCine($_GET['id_cine']);  
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
       


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
    

#**********************************************************ACTUALIZAR PELICULAS DE JSON*****************************************************
      
    public function actualizarPeliculas(){
  
        $this->generosToBd();

        $cantidad = $this->peliculasToJson();


        if($cantidad>0)//Ahora la peliculas se guardan en un json, y en la base de datos solo se guardan las peliculas que tengan una funcion
        {
            echo '<script>alert("Peliculas Nuevas: ' . $cantidad . '");</script>';
            //Despeues de mostrar el script deberia llemar a una nueva vista que muestre todas las peliculas del json
        }
        else
             echo '<script>alert("No hay Peliculas para Actualizar");</script>';



        $homeController = new HomeController();
        $homeController->viewHomeAdmin();


        //Poner un script que diga que se registraron exitosamente
    }



    public function peliculasToJson()
    {
        $flag =0;
        $arrayCartelera = array();
        $json = new PeliculasJson();

        $api = new Api();
        $array_api = $api->getCarteleraApi();
        
          foreach($array_api as  $value)
          {
              if($json->checkPeliRepetidaJson($value) == false )
              {
                      $json->saveMovieToJson($value);
                      $flag++;
              }
          
          }
      return $flag;
    }

      //Funcion que pasa de la Api a la bd,Comprobar los tips de datos de la bd
      public function peliculasToBd()
      { 
          $peliculaDao = new PeliculaDAO();
          $arrayCartelera = array();
          $apiPeliculas = new Api();
          try{
                $arrayCartelera = $apiPeliculas->getCarteleraApi();
                foreach($arrayCartelera as $value)
                {
                    if(  $peliculaDao->checkPeliRepetida($value) == false ){
    
                    $peliculaDao->SavePelicula($value);
                    }
                }
            }catch(Exception $e){
               throw new Exception($e->get_message());
            }

        
          
      }

     
      public function generosToBd()
      {
          $apiGeneros = new Api();
          $arrayGeneros = $apiGeneros->getGenerosApi();
          $generoDao = new GeneroDao();
          try{
              foreach($arrayGeneros as $values){

                if(  $generoDao->checkGeneroRepetido($values) == false ){

                    $generoDao->SaveGenero($values);
                    }    
                } 
            }catch(Exception $e){
                throw new Exception($e->get_message());
            }
        }


      public function modifyCine($id)
    {
        $cine = new Cine();
        $cine->setId($id);

        $cineDAO = new CineDAO();

        try{
            $retrieve = $cineDAO->RetrieveOne($id);


            $updateCine = $cineDAO->ModifyCine($cine);   
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
       
        include_once('ViewsAdmin/modifyShowList.php');
        //$this->showModifyCine($retrieve);
    }

    public function showModifyCine($retrieve){
        //$listaCines = $this->retrieve();
        include_once('ViewsAdmin/modifyShowList.php');

    }


    public function viewTicketsVendidos()
    {


    }

}
?>