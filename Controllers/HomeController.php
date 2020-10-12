<?php 

namespace Controllers;

class HomeController{

   /* public function Index(){
        echo 'hola';
    }*/

    public function Index()
    {echo "ola";
        $now=curl_exec("https://api.themoviedb.org/3/movie/now_playing?api_key=b285f5e6eecdd8eda1b3f5a82415153b&language=en-US&page=1");
        var_dump($now);
    }


}



?>