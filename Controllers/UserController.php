<?php 

namespace Controllers;
use Models\User as User;
use Models\Compra as Compra;
use Models\Entrada as Entrada;
use DAO\UserDAO as UserDAO;
use DAO\CompraDAO as CompraDAO;
use DAO\EntradaDAO as EntradaDAO;
use DAO\FuncionDAO as FuncionDAO;
use Controllers\HomeController as HomeController;


class UserController{
    
    private $pdo;

	function __construct()
	{

		$this->pdo = new UserDAO();

    }

	public function signUp ($firstName, $lastName, $dni, $email,$password){

        $userDAO = $this->pdo->getByEmail($email);
        
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setDni($dni);
        $user->setEmail($email);
        $user->setPassword($password);
       
        $homeController = new HomeController();
        $validation = false;
        /*
        if ($user->getFirstName() != '' && $user->getLastName() != '' && $user->getDni() < 0 && $user->getDni() != '' && $user->getPassword() != '') {
            */
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validation = true;
            }
        /*}*/
        
		if($userDAO == null)
		{
            
            if($validation){
                
                //ACA VA LA PAGINA DIRECTAMENTE
                $this->pdo->create($user);
                $homeController->viewCartelera();
                	
            }
            
        }else
        {
            echo "<script>alert('The email entered already exists, please enter another');";
            echo "</script>";
            $homeController->viewSignUp();
        }
	}

        
	public function getByEmail($email){
		$userDAO = $this->pdo->getByEmail($email);
    }
    
    public function login($email,$pass){
        
        $userDAO = new UserDAO();
        $userList = $userDAO->getAll();
        $loggedUser = NULL;
        $homeController = new HomeController();

        foreach($userList as $value){
            if($email == $value->getEmail()){
                if($pass == $value->getPassword()){
                    
                    $loggedUser = $value;
                    //session_start();
                    $_SESSION['userLog'] = $loggedUser;
                    
                    $homeController->viewCartelera();
                    
                }
                else{
                    $homeController->viewLogin();
                }
            }
            else{
                $homeController->viewLogin();
            }
        }
    }

    public function logout(){

        $homeController = new HomeController();

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        unset($_SESSION['userLog']);
        $homeController->Index();
    }


// ##------------------------- Compra ----------------------- ##



    public function funcionElegida(){

        // AGARRO LOS DATOS Y CALCULO EL TOTAL
        $idFuncion =  $_POST['funcion'];
        $funcionDao = new FuncionDAO();
        $funcion = $funcionDao->getById($idFuncion);
        $cantidadEntradas =  $_POST['cantidadEntradas'];
        $total = $cantidadEntradas * $funcion->getClassSala()->getPrecio();
        $descuento = 0;

        if($funcion->getDescuento() == 1){

            $descuento = (26/100) * $total;
            $total -=  $descuento;
        }


        // GUARDO LOS DATOS EN SESSION
        if(!isset($_SESSION)){
            session_start(); 
        } 

        $_SESSION['total'] = $total;
        $_SESSION['descuento'] =  $descuento;
        $_SESSION['cantidadEntradas'] = $cantidadEntradas;
        $_SESSION['idFuncion'] = $idFuncion;
        $_SESSION['userLog'] = 1;

        if(isset($_SESSION['userLog'])){

           $homeController = new HomeController();
           $homeController->formularioTarjeta();

        }else{

        }


    }





    public function finalizarCompra(){

        $numeroTarjeta = $_POST['numeroTarjeta'];
        $nombre = $_POST['nombre'];
        //$mes = $_POST['mes'];  FALTA COMPROBACION
        //$year = $_POST['year'];
        $ccv = $_POST['ccv'];

        echo '<script>alert("Tarjera aprobada");</script>';

        //Agarro todos los datos 
        $total = $_SESSION['total'];
        $cantidadEntradas = $_SESSION['cantidadEntradas'];
        $idFuncion = $_SESSION['idFuncion'] ;
        $idUser = $_SESSION['loggedUser'];

        // Guardo la compra en la base de datos
        $compra = new Compra();
        $compra->setNumeroTarjeta($numeroTarjeta);
        $compra->setIdUser($idUser);
        $compra->setCantidadEntradas($cantidadEntradas);
        $compra->setTotal($total);
        $compraDAO = new CompraDAO();
        $compraDAO->Add($compra);
        $Ultimacompra = $compraDAO->getUltimaRow();

        //Ahora hay que generar la entrada
        for( $i=1; $i <= $cantidadEntradas ; $i++ ){
            
            $entrada = new Entrada();
            $entrada->setQR(345);
            $entrada->setIdCompra($Ultimacompra->getId());
            $entrada->setIdFuncion($idFuncion);
            $entradaDAO = new EntradaDAO();
            $entradaDAO->Add($entrada);
        }
      
        $homeController = new HomeController();
        $homeController->viewFinCompra();

    }


    private function numeroTarjetaValido( $numeroTarjeta ){

        //Paso el numero (int) a un array
        $array  = array_map('intval', str_split($numeroTarjeta));
        // Doy vuelta el arreglo
        $arrayInvertido = array_reverse($array);
        echo 'array original';
        var_dump($array);
        echo '<br><br><br>array invertido';
        var_dump($arrayInvertido);

        // Partiendo de la posicion 1 tengo que agarrar a todos los inpares
        for($i=1; $i < 19; $i++){
            //agarro los impares
            if (!$i%2==0){
                //Multiplico el numero por 2
               $multiplicacion =  $arrayInvertido[$i] * 2;
               // Si es mayor que 10 sumo los 2 digitos
               if($multiplicacion >= 10){
                $mayorDeDiezArray  = array_map('intval', str_split($multiplicacion));
                $numeroNuevo =   $mayorDeDiezArray[0] +  $mayorDeDiezArray[1];
                $arrayInvertido[$i] = $numeroNuevo;
               }else{ // si es menor, solo lo remplazo
                    $arrayInvertido[$i] = $multiplicacion;
               }
            } 

        }

        echo '<br><br>array invertido MODIFICADO';
        var_dump($arrayInvertido);


    }






}


