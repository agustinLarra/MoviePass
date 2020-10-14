<?php 

namespace Controllers;
use Controllers\ApiController as Api;


class HomeController{

    public function __construct(){
       //Constructor VACIO
    }
     
        /// Abrir session y verificar si hay usarios en session.
        //  Si no hay --> se llama a la funcion login()
        //  Si hay, se hace lo esto de abajo (Tendriamos que hacerla una funcion aparte)
        // *!implementar cuando funcione el login!*

        /*
        $apiController = new Api();
        $arrayCartelera = $apiController->getCarteleraApi();
        include('Views/home.php');
        */

    public function viewLogin(){
        //ACA EL HEADER
        require(VIEWS_PATH.'/login.php');
        //ACA EL FOOTER
    }
    public function viewSignUp(){
        //Header
        require(VIEWS_PATH.'signUp.php');
        //footer
    }
    


}



?>