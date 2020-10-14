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
        include('Views/home.php');
    }


}



?>