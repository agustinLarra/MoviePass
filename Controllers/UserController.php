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

                    echo"El usuario y la contraseña son correctos";
                    
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

}


