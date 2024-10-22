<?php 

namespace Controllers;
use Controllers\ApiController as Api;
use DAO\PeliculaDAO as PeliculaDAO;
use DAO\GeneroDao as GeneroDao;
use DAO\FuncionDao as FuncionDao;
use Models\Sala as Sala;
use Models\Pelicula as Pelicula;
use DAO\SalaDAO as SalaDAO;
use JsonDAO\PeliculaJson as PeliculasJson;
use DAO\DescuentoDAO as DescuentoDAO;

class HomeController{


    //----------------------------------------------HOME-----------------------------------------------------------------------------------------------------------------

    public function Index(){
       /// Abrir session y verificar si hay usarios en session.
        //  Si no hay --> se llama a la funcion login()
        //  Si hay, se hace lo esto de abajo (Tendriamos que hacerla una funcion aparte)
        // implementar cuando funcione el login!*

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require(VIEWS_PATH.'inicio.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    }

    public function viewHomeAdmin(){
       
      if($this->adminIsLogged()){

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require(VIEWS_ADMIN_PATH.'index.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }
   
  }




    //----------------------------------------------USUARIO-----------------------------------------------------------------------------------------------------------------

    //----------------------------------------------USUARIO-----------------------------------------------------------------------------------------------------------------

    public function viewLogin(){
      require_once(VIEWS_PATH.'login.php');
   
     }
  public function viewSignUp(){
      require_once('Views/header.php');
      require(VIEWS_PATH.'signUp.php');
      require_once('Views/footer.php');
    }
    #--------------------------------------------------------------------------------------------------------------------------------------------------------------------


    //----------------------------------------------CARTELERA------------------------------------------------------------------------------------------------------------
    public function viewCartelera( ){

      try{
        $array_peliculas = $this->cargarCartelera();
        if(!empty($array_peliculas)){
        
          $arrayGeneros = $this->cargarGeneros();
  
          $lista_dias = $this->cargarFunciones();
        }

      }catch(Exception $e){

        $message = $e->get_message();
       // throw new Exception($e->get_message());

      }
      
        
        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require(VIEWS_PATH.'billboard.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    
    }


    public function cargarCartelera(){

      //Levantar peliculas que esten linkeadas en funciones
      $peliculaDao = new PeliculaDAO();
     //$peliculaList = $peliculaDao->GetPeliculasEnFunciones();
     
      try{
         // $peliculaList = $peliculaDao->GetAll();
         $peliculaList = $peliculaDao->GetPeliculasEnFunciones();

      }catch(Exception $e){
          throw new Exception($e->get_message());
      }

      return  $peliculaList ;
    }

   public function diasCartelerasSinDuplicados($funciones)
  {
          $array_dias = array();
          foreach($funciones as $values){
             array_push($array_dias,$values->getDia());
          }
        return array_unique($array_dias);
  }

    #-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------------------------FECHAS-----------------------------------------------------------------------------------------------------------------
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

    private function filtarPelisXFecha($idFuncion)
    {
        try{

          $funcion = new FuncionDao();

          $aux = $funcion->GetDia($idFuncion);//Me devuelve las funciones de un dia;

          $peliculas_cartelera = $this->fechaToPelicula($aux);

        }catch(Exception $e){
              throw new Exception($e->get_message());
        }
          return $peliculas_cartelera;
    }


    private function fechaToPelicula($funciones)
    {
          $lista_peliculas = array();
          $pelicula = new PeliculaDAO() ;
          try{
              foreach($funciones as $values)
              {
                  $pelicula_cartelera = $pelicula->RetrieveOne($values->getIdpelicula());//Busco en las a partir del id_pelicula de la funcion
                  array_push($lista_peliculas,$pelicula_cartelera);
              }
        }catch(Exception $e){
          throw new Exception($e->get_message());
        }



       return $lista_peliculas;
    }

    #-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------------------------GENEROS-----------------------------------------------------------------------------------------------------------------


    public function viewGenero( )
    {
      try{
        $idGenero = $_POST['Id_genero'];
        
        if((strcmp($idGenero,"todos"))==0)
        {
          $array_peliculas = $this->cargarCartelera();
        }else{
           list($id,$nombre) = explode("-",$idGenero);
           $array_peliculas = $this->filtarPelisXgenero($id);
        }        
  
        $arrayGeneros = $this->cargarGeneros();
   
        $lista_dias = $this->cargarFunciones();

      }catch(Exception $e){
        $message = $e->get_message();
      }
 
        
      require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
      require(VIEWS_PATH.'billboard.php');
      require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    
    }

    
  
    public function cargarGeneros(){
      try{
          $generos_bd = new GeneroDAO();
          $arrayGeneros = $generos_bd->getAll();          
      }catch(Exception $e){
            throw new Exception($e->get_message());
      }
      
      return  $arrayGeneros  ;
    }

    private function filtarPelisXgenero($idGenero)
    {
      $peliDAO = new PeliculaDAO();
      try{
            $arregloPeliculas = $peliDAO->FiltrarPelisXGenero($idGenero);   
      }catch(Exception $e){
             throw new Exception($e->get_message());
      }
    
      return $arregloPeliculas;

    }

  #-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------------------------CINE-----------------------------------------------------------------------------------------------------------------




    public function viewAddCine(){

      if($this->adminIsLogged()){

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require(VIEWS_ADMIN_PATH.'addCine.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }
     
  }

    public function viewListCines(){

      $adminController = new AdminController();
      $listCines = $adminController->listarCines();


      if($this->adminIsLogged()){

          require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
          require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
          require(VIEWS_ADMIN_PATH.'listCines.php');
          require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }
 
  }


      #-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------------------------SALAS-----------------------------------------------------------------------------------------------------------------

   
    public function viewAddSalas(){
      $adminController = new AdminController();
      $cineList = $adminController->listarCines();
      
      if($this->adminIsLogged()){

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require(VIEWS_ADMIN_PATH.'addSalas.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }
      

      //header('location:../ViewsAdmin/addSalas.php');

  }
  
  public function viewListSalas(){

    $adminController = new AdminController();
    try{
          $listSalas = $adminController->listarSalasConCine();     
    }catch(Exception $e){
           throw new Exception($e->get_message());
    }
    
    if($this->adminIsLogged()){

      require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
      require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
      require(VIEWS_ADMIN_PATH.'listSalas.php');
      require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    }else{
      echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
      $this->Index();
    }

    
}

  public function modificarSala($id,$nombre,$precio,$capacidad)
  {
    $sala = new Sala();
    $sala->setId($id);
    $sala->setNombre($nombre);
    $sala->setPrecio($precio);
    $sala->setCapacidad($capacidad);
   

    
    if($this->adminIsLogged()){

      require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
      require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
      require(VIEWS_ADMIN_PATH.'modificarSala.php');
      require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    }else{
      echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
      $this->Index();
    }
 

      
  }



public function selectDinamicoSalas(){
    
  try{
      $salaDao = new SalaDAO();
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


      #-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------------------------FUNCIONES-----------------------------------------------------------------------------------------------------------------
 
 
    public function viewAddFunciones(){

      $adminController = new AdminController();

      // Levanto las peliculas del Json
      try{
            $peliculas = new PeliculasJson();
            $descuento = new DescuentoDAO();
            $peliculasList = $peliculas->GetMovieJson();  
            $cineList = $adminController->listarCines();   
            $descuentosList =$descuento->GetAll();//ahora los descuentos estan en la bd

      }catch(Exception $e){
             throw new Exception($e->get_message());
      } 
     

      // Levanto las salas de la base de datos
     
      if($this->adminIsLogged()){

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require_once(VIEWS_ADMIN_PATH.'addFunciones.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }
     

  }


    public function viewListFunciones(){

      $adminController = new AdminController();
      try{
              $listFunciones = $adminController->listarFunciones();  
      }catch(Exception $e){
             throw new Exception($e->get_message());
      }
     
  
      if($this->adminIsLogged()){

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require(VIEWS_ADMIN_PATH.'listFunciones.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }
      
  }
  
  public function cargarFunciones(){

    $funciones_bd = new FuncionDao();
    $funciones = $funciones_bd->GetAll();

    $lista_dias = $this->diasCartelerasSinDuplicados($funciones);

    return $lista_dias;
  }

  #-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //----------------------------------------------COMPRA-----------------------------------------------------------------------------------------------------------------

    public function Comprar($id){


      $peliculaDAO = new PeliculaDAO(); 
      $adminController = new AdminController();
      
      try{
             $pelicula = $peliculaDAO->RetrieveOne($id);   
             $listaFunciones = $adminController->listarCinesConFuncion_ByIdPelicula( $pelicula->getId() );

      }catch(Exception $e){
             throw new Exception($e->get_message());
      }
      

      require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
      require_once(VIEWS_PATH.'comprarEntradas.php');
      require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');

    }



    public function formularioTarjeta(){

     // require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
      require_once(VIEWS_PATH.'formulario_tarjeta.php');
     // require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');

    }

    public function viewFinCompra(){

      $nombreCine = $_SESSION['NombreCine'];
      $calleCine = $_SESSION['CalleCine'] ;
      $numeroCine = $_SESSION['NumeroCine'];
      $lat;
      $lng;

      if($nombreCine == 'Ambasador'){
        $lat = -38.0015825;
        $lng = -57.5476749;
      }
      if($nombreCine == 'Los gallegos'){
        $lat = -37.9992627;
        $lng = -57.5487967;
      }
      if($nombreCine == 'Aldrey'){
        $lat = -38.0124772;
        $lng = -57.5463054;
      }
      if($nombreCine == 'Cine del Paseo'){
        $lat = '-38.0022085';
        $lng = '-57.5557408';
      }
      
      require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
       require_once(VIEWS_PATH.'finCompra.php');
     // require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    }


    public function selectDinamicoCiudades(){
    

     $ciudad = $_GET['ciudad'];
    // $idPelicula = $_GET['idPelicula'];
    // echo $idPelicula;
      // tengo $ciudad
      // mostrame el cine y la sala pertenecientes a esta funcion

     $adminController = new AdminController();
     try{
             $listaFunciones = $adminController->listarFuncionesByIdPelicula( 539885 );  
    }catch(Exception $e){
           throw new Exception($e->get_message());
    }
     

      foreach($listaFunciones as $funcion){
        echo '<div class="col-lg-4 col-md-6">';
          echo '<div class="single-do text-center mb-30">';
            echo '<div class="do-icon">';
              echo '<span  class="flaticon-tasks"></span>';
            echo '</div>';
            echo '<div class="do-caption">';
                echo '<h4>'. $funcion->getDia() .'</h4>';
                echo '<h4>'. $funcion->getHora(). '</h4>';
                echo ' <p>Pelicula:' .$funcion->getTitlePelicula() .'</p>';
                echo ' <p>Cine:' . $funcion->getNombreCine() .'</p>';
                echo ' <p>Sala:'. $funcion->getNombreSala() .'</p>';
                echo ' <p>Descuento:' .$funcion->getDescuento() .'</p>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
  
      }
   
                                
      /*echo'<select name="select" id="select">';
             foreach($listaSalas as $value){      
                  echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
             }
      echo'</select>';*/
    }


 #-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //---------------------------------------------- PELICULAS -----------------------------------------------------------------------------------------------------------------

    public function viewListPeliculas(){

        try{
          $generoList = $this->cargarGeneros();
          $fechaDeFuncion = $this->cargarFunciones();
          $fechas_estreno = $this->FechaDeEstrenoOrdenada();//Fechas de estrenos ordenadas y sin repetir
          $peliculasList = $this->cargarPeliculasJson();


        }catch(Exception $e){
               throw new Exception($e->get_message());
        }


        if($this->adminIsLogged()){

          require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
          require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
          require_once(VIEWS_ADMIN_PATH.'listaPeliculas.php');
          require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
        
        }else{
          echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
          $this->Index();
        }
        
     
  
    }
    private function cargarPeliculasJson()
    {
      $peliculas = new PeliculasJson();
      return  $peliculasList = $peliculas->GetMovieJson();
    }
    public function viewPeliEstrenoAdmin()
    {
      $seleccion = $_POST['estreno'];
      $peliculasList = $this->Json_PorFechaDeEstreno($seleccion);
  
  
      $generoList = $this->cargarGeneros();
      $fechaDeFuncion = $this->cargarFunciones();
      $fechas_estreno = $this->FechaDeEstrenoOrdenada();//Fechas de estrenos ordenadas y sin repetir
  

      if($this->adminIsLogged()){

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require_once(VIEWS_ADMIN_PATH.'listaPeliculas.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }

  
    }
    public function viewPeliFuncionAdmin()
    {
      $seleccion = $_POST['funcion'];
      $peliculasList =$this->filtarPelisXFecha($seleccion);
  
      $generoList = $this->cargarGeneros();
      $fechaDeFuncion = $this->cargarFunciones();
      $fechas_estreno = $this->FechaDeEstrenoOrdenada();//Fechas de estrenos ordenadas y sin repetir
  
      if($this->adminIsLogged()){

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require_once(VIEWS_ADMIN_PATH.'listaPeliculas.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }
  
  
    }
    public function viewPeliGeneroAdmin($genero)
    {

       list($id,$seleccion) = explode("-",$genero);


       $peliculasList = $this->Json_PorGenero($id);


       $generoList = $this->cargarGeneros();
       $fechaDeFuncion = $this->cargarFunciones();
       $fechas_estreno = $this->FechaDeEstrenoOrdenada();//Fechas de estrenos ordenadas y sin repetir

       if($this->adminIsLogged()){

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require_once(VIEWS_ADMIN_PATH.'listaPeliculas.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');

      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }


    }

    private function Json_PorGenero($genero)
    {


        $json = new PeliculasJson();
        $pelicula = $json->GetPorGenero($genero);


     return $pelicula;
    }

    private function Json_PorFechaDeEstreno($fecha)
    {
      
        $json = new PeliculasJson();
        $pelicula = $json->GetPorFechaDeEstreno($fecha);
    
    return $pelicula;
    }
    public function FechaDeEstrenoOrdenada()
    {
      $peliculas = new PeliculasJson();
      $peliculasList = $peliculas->GetMovieJson();
  
      $fecha_estreno = array();
  
      foreach($peliculasList as $values)
      {
        array_push($fecha_estreno,$values->getReleaseDate());
  
      }
  
       arsort($fecha_estreno);//Lo ordeno de mayor a menor
       $fechaSinrepetidos = array_unique($fecha_estreno);//Elemino los duplicados
  
      return $fechaSinrepetidos;
  
    }
  
  

 #-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //---------------------------------------------- ENTRADAS -----------------------------------------------------------------------------------------------------------------


    public function viewEntradasAdquiridas(){

      //agarro el user en session
      
      $user = $_SESSION['userLog'];
      $idUser = $user->getId();

      $userController = new UserController();
      
      try{
             $listaDeDivs = $userController->getEntradasAdquiridas($idUser);   
      }catch(Exception $e){
             throw new Exception($e->get_message());
      }
      $fechas = $this->EntradasXDia($idUser);  
    

     require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
     require_once(VIEWS_PATH.'entradasAdquiridas.php');
     require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    }

    public function EntradasXDia($idUser)
    {
      $userController = new UserController();
      
      try{
             $listaDeDivs = $userController->getEntradasAdquiridas($idUser);   
      }catch(Exception $e){
             throw new Exception($e->get_message());
      }


      $fechas = array();

      foreach($listaDeDivs as $values)
      {
        array_push($fechas,$values["Dia"]);


      }

      asort($fechas);
      $fechasSinRepetidos = array_unique($fechas);

      return $fechasSinRepetidos;
    }   
    
    
    public function viewFechasEntradas(){

      //agarro el user en session
      
      $user = $_SESSION['userLog'];
      $idUser = $user->getId();

      $fecha_seleccionada = $_POST["Id_fecha"];

      $userController = new UserController();
      
      try{
             $listaDeDivs = $userController->getEntradasAdquiridasPorDia($idUser,$fecha_seleccionada);
              
      }catch(Exception $e){
             throw new Exception($e->get_message());
      }

      $fechas = $this->EntradasXDia($idUser);  
    

     require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
     require_once(VIEWS_PATH.'entradasAdquiridas.php');
     require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
    }

    



 #-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //---------------------------------------------- ENTRADAS -----------------------------------------------------------------------------------------------------------------


    public function viewConsultaTotalesVendidos(){


     $adminController = new AdminController();
    // Cargo una lista de peliculas
    $listaPeliculas = $adminController->listarPeliculas();
    //Cargo una lista de cines
    $listaCines = $adminController->listarCines();


      if($this->adminIsLogged()){

          require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
          require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
          require_once(VIEWS_ADMIN_PATH.'consultaTotalesVendidos.php');
          require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }

    }



    public function viewTotalesVendidos(  $VENTASxPELICULA, $VENTASxCINE,  $Fecha_Inicio,$Fecha_Fin){

      $peliculaVendida = $VENTASxPELICULA;
      $cineVendido = $VENTASxCINE;
      $pelicula;
      $cine;

      if(!empty($peliculaVendida)){
        $pelicula = $peliculaVendida['Pelicula'] ; 
      }

      if(!empty($cineVendido)){
        $cine = $cineVendido['Cine'] ; 
      }
      

      $listaXcine = $VENTASxCINE;
      $DiaInicio = $Fecha_Inicio;
      $DiaFin = $Fecha_Fin;

      if($this->adminIsLogged()){

        require_once(VIEWS_ADMIN_PATH .'headerAdmin.php');
        require_once(VIEWS_ADMIN_PATH .'navAdmin.php');
        require(VIEWS_ADMIN_PATH.'totalesVendidos.php');
        require_once(VIEWS_ADMIN_PATH .'footerAdmin.php');
      }else{
        echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
        $this->Index();
      }

     
    }


    public function adminIsLogged(){

      if(isset($_SESSION['userLog'])){

        $user = $_SESSION['userLog'];

        if($user->getEmail() == "admin@gmail.com"){
          return true;
        }
        else{
         // echo '<script>alert("No tiene acceso para entrar en esta pagina");</script>';
          return false;
        }
      }
      
    }
  
    public function map(){
      require_once(VIEWS_PATH.'map.php');

    }

} ?>