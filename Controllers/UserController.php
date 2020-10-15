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

	public function create(User $user)
	{
		$user_sign = new User($user);
		//$this->repository->Add($user);
		$this->pdo->Add($user_sign); 	
	}

	public function getByEmail($email)
	{
		$userDAO = $this->pdo->getByEmail($email);
    }
    
    

	public function signUp ($firstName,$lastName,$dni,$email,$password)
	{
        $userDAO = $this->pdo->getByEmail($email);
        $validation = false;
        if ($firstName != '' && $lastName != '' && $dni < 0 && $dni != '' && $password != '') {
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validation = true;
            }
        }
		if($userDAO !== null)
		{
            if($validation){
                
                //ACA VA LA PAGINA DIRECTAMENTE
                $this->homeController->viewLogin();
            }else{
                //ACA VA MENSAJE DE ALERTA
                //$this->homeController->viewSignUp();

            }
        }else
        {
              //ACA VA MENSAJE DE ALERTA
            //$this->homeController->viewSignUp();
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
                   // header('location:/MoviePass/');
                }
            }
            else{
              //  header('location:/MoviePass/');
            }
        }
    }

    public function viewLogin()
    {
        include('Views/login.php');

    }
    public function viewSignup()
    {
        include('Views/signUp.php');

    }
}
