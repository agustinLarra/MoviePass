<?php 

namespace Controllers;
use Controllers\ApiController as Api;


class HomeController{

    public function Index(){
    
        $apiController = new Api();
        $arrayCartelera = $apiController->getCarteleraApi();
        include('Views/home.php');
    }


}



?>