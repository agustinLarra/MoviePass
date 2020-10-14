<?php 

namespace Controllers;
use Models\UserProfile as UserProfile;
use DAO\UserProfileDAO as UserProfileDAO;
use Controllers\HomeController as homeC;


class UserProfileController{

	private $homeController;
	private $pdo;

	function __construct()
	{
	
		$this->pdo = new UserProfileDAO();
		$this->homeController = new homeC();
	}

	public function create($firstName,$lastName,$dni,$email,$password)
	{
		$userProfile = new UserProfile($firstName,$lastName,$dni,$email,$password);
		//$this->repository->Add($user);
		$this->pdo->Add($userProfile); 	
	}

	public function getByEmail($email)
	{
		$userProfile = $this->pdo->getByEmail($email);
	}

	public function signUp ($firstName,$lastName,$dni,$email,$password)
	{
        $userProfile = $this->pdo->getByEmail($email);
        $validation = false;
        if ($firstName != '' && $lastName != '' && $dni > 0 && $password != '') {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validation = true;
            }
        }
		if($userProfile !== null)
		{
            if($validation){
                //ACA VA LA PAGINA DIRECTAMENTE
                /*$this->homeController->viewHome*/
            }else{
                //ACA VA MENSAJE DE ALERTA
                $this->homeController->viewSignUp();

            }
		}
	}
}