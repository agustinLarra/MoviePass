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

	public function create($user)
	{
		$user_sign = new User($user);
		//$this->repository->Add($user);
		$this->pdo->Add($user_sign); 	
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
