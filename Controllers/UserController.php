<?php 

namespace Controllers;
use Models\User as User;
use DAO\UserDAO as UserDAO;
use Controllers\HomeController as homeC;


class UserController{
    
    private $homeController;
    private $pdo;

	function __construct()
	{

		$this->pdo = new UserDAO();
		$this->homeController = new homeC();

    }

	public function signUp ($firstName, $lastName, $dni, $email,$password){

        $userDAO = $this->pdo->getByEmail($email);
        
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setDni($dni);
        $user->setEmail($email);
        $user->setPassword($password);
       
    
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
                $this->homeController->viewCartelera();
                	
            }
            
        }else
        {
            echo "<script>alert('The email entered already exists, please enter another');";
            echo "</script>";
            $this->homeController->viewSignUp();
        }
	}

        
	public function getByEmail($email){
		$userDAO = $this->pdo->getByEmail($email);
    }
    
    public function login($email,$pass){
        
        $userDAO = new UserDAO();
        $userList = $userDAO->getAll();
        $loggedUser = NULL;
        $this->homeController = new homeC();

        foreach($userList as $value){
            if($email == $value->getEmail()){
                if($pass == $value->getPassword()){
                    
                    $loggedUser = $value;
                    session_start();
                    $_SESSION['userLog'] = $loggedUser;
                    
                    $this->homeController->viewCartelera();
                    
                }
                else{
                    $this->homeController->viewLogin();
                    
                }
            }
            else{
                $this->homeController->viewLogin();
            }
        }
    }

    public function logout(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        unset($_SESSION['userLog']);
        $this->homeController->Index();
    }


// ##------------------------- Compra ----------------------- ##

    public function validarTarjeta(){

        $numeroTarjeta = $_POST['numeroTarjeta'];
        $nombre = $_POST['nombre'];
        $mes = $_POST['mes'];
        $year = $_POST['year'];
        $ccv = $_POST['ccv'];

        echo '<script>alert("Tarjera aprobada");</script>';

        //$this->numeroTarjetaValido($numeroTarjeta);
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


