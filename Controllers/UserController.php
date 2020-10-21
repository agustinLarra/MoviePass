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
    /*
	public function create($user)
	{
        $user_sign = new User($user);
        $email = $user_sign->getEmail();
        $pass = $user_sign->getPassword();
        $userPDO = new UserDAO();
        $userList = $userPDO->getAll();
        
        $validationUser = FALSE;
        
        foreach($userList as $values)
            {
                if($user_sign->getEmail() == $values->getEmail())
                {
                    $validationUser=TRUE;
                    $userPDO->modify($email,$pass);
                    //$msj='El usuario ya existe';
                    //$type='Success';
                    $this->homeController->Index();
                }    
            }          
        if($validationUser == FALSE){
            
            $userPDO->Add($user_sign);
            //$msj='Se ha agregado exitosamente el usuario';
             //$type='success';
             $this->homeController->viewCartelera();
        }   
    }
    */

    public function create($user){
        $sql = "INSERT INTO users(firstName,lastName,dni,email,pass) VALUES(:firstName,:lastName,:dni,:email,:pass)";

        $parameters['firstName'] = $user->getFirstName();
        $parameters['lastName'] = $user->getLastName();
        $parameters['dni'] = $user->getDni();
        $parameters['email'] = $user->getEmail();
        $parameters['pass'] = $user->getPassword();
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql,$parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
        
    }

    
    
	public function getByEmail($email){
		$userDAO = $this->pdo->getByEmail($email);
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
                $this->pdo->add($user);
                $this->homeController->viewCartelera();
                	
            }
            
        }else
        {
            echo "<script>alert('The email entered already exists, please enter another');";
            echo "</script>";
              //ACA VA MENSAJE DE ALERTA
            $this->homeController->viewSignUp();
        }
	}

    public function login($email,$password){
        

        $userDAO = new UserDAO();
        $userList = $userDAO->GetAll();
        $loggedUser = NULL;

        foreach($userList as $value){
            if($email == $value->getEmail()){
                if($password == $value->getPassword()){
                    $loggedUser = $value;
                    
                    session_start();
                    $_SESSION['userLog'] = $loggedUser;
                    
                    include('Views/home.php');
                }
                else{
                    require_once(VIEWS_PATH.'/login.php');
                }
            }
            else{
                require_once(VIEWS_PATH.'/login.php');
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

}


