<?php 

namespace Controllers;
use Controllers\ApiController as Api;


class HomeController{

    public function Index(){
       /// Abrir session y verificar si hay usarios en session.
        //  Si no hay --> se llama a la funcion login()
        //  Si hay, se hace lo esto de abajo (Tendriamos que hacerla una funcion aparte)
        // *!implementar cuando funcione el login!*

        $apiController = new Api();
        $arrayCartelera = $apiController->getCarteleraApi();
        require_once('Views/header.php');
        require('Views/inicio.php');
       
    }

    public function viewLogin(){
        ///require_once('Views/login.php');
        require_once(VIEWS_PATH.'login.php');
     
    }
    public function viewSignUp(){
        require_once('Views/header.php');
        require(VIEWS_PATH.'signUp.php');
        require_once('Views/footer.php');
    }
    public function viewCartelera(){
        $apiController = new Api();
        $arrayCartelera = $apiController->getCarteleraApi();
        $arrayGeneros = $apiController->getGenerosApi();
        require_once(VIEWS_PATH.'nav.php');
        require(VIEWS_PATH.'billboard.php');
    
    }
    public function viewGenero()
    {
        $tipo = $_POST['genero'];
       
        $apiController = new Api();
        $arrayCartelera = $apiController->getCarteleraApi();
        $arrayGeneros = $apiController->getGenerosApi();
        include_once('Views/carteleragenero.php');
    }

    


}



?>