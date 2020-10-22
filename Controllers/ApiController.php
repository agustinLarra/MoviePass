<?php 

namespace Controllers;
use Models\Pelicula as Pelicula;
use Models\Genero as Genero;


class ApiController{


    public function getCarteleraApi(){
        
        $arregloCartelera = array();

        $ch=file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=b285f5e6eecdd8eda1b3f5a82415153b&language=es-ARG&page=1",true);
        //$aux=json_decode($ch);
        $array= ($ch) ? json_decode($ch, true) : array();
        foreach($array as $values=>$key)
        {
            if($values=='results')
            {
                foreach($key as $v=>$k){
                    
                   $peli = new Pelicula();
                   $peli->setTitle($k['title']);
                   $peli->setPoster($k['poster_path']);
                   $peli->setPosterHorizontal($k['backdrop_path']);
                   $peli->setGenre($k['genre_ids']);
                    array_push($arregloCartelera,$peli);
                   //echo $k['title'] .  "</br>" . "</br>";

                 }
            }
        }
        return $arregloCartelera;
    }

    public function getGenerosApi()
    {
        $arregloGeneros= array();
        $ch=file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=b285f5e6eecdd8eda1b3f5a82415153b&language=es");
        $array = ($ch) ? json_decode($ch, true) : array();

        foreach ($array as $values => $key)
        {
           foreach($key as $v=>$k)
           {
                $genero = new Genero();
                $genero->setId($k["id"]);
                $genero->setTipo($k["name"]);
                array_push($arregloGeneros,$genero);  
           }
        }
        return $arregloGeneros;
    }

}
?>