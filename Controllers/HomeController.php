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
        
        require(VIEWS_PATH.'/login.php');
     
    }
    public function viewSignUp(){
        require_once('Views/header.php');
        require(VIEWS_PATH.'signUp.php');
        require_once('Views/footer.php');
    }
    public function viewCartelera(){
        $apiController = new Api();
        $arrayCartelera = $apiController->getCarteleraApi();
        require_once(VIEWS_PATH.'header.php');
        require_once(VIEWS_PATH.'nav.php');
        require(VIEWS_PATH.'carteleracompleta.php');
        require_once(VIEWS_PATH.'footer.php');

    }

    


}



?>