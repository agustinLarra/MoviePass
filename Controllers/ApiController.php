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
                   $peli = $this->getDatosPelicula($k['id']);
                   $peli->setId($k['id']); 
                   $peli->setGenre($k['genre_ids']);//Los generos los seteo aca por que en los detalles de la peli viene con mas informacion que no necesitamos
                  
                   array_push($arregloCartelera,$peli);
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

    public function getDatosPelicula($id_pelicula)//El id de pelicula se usa para obtener la informacion completa
    {
        
        $pelicula = file_get_contents('https://api.themoviedb.org/3/movie/'. $id_pelicula .'?api_key=b285f5e6eecdd8eda1b3f5a82415153b&language=es');
       
        $array = ($pelicula) ? json_decode($pelicula, true) : array();

        $pelicula_completa =  new Pelicula();
           
          $pelicula_completa->setTitle($array['title']);
          $pelicula_completa->setPosterPath($array['poster_path']);
          $pelicula_completa->setPosterHorizontal($array['backdrop_path']);
          $pelicula_completa->setOverview($array['overview']);
          $pelicula_completa->setReleasedate($array['release_date']);
          $pelicula_completa->setRuntime($array['runtime']);
          $pelicula_completa->setVideo($this->getTrilerPelicula($id_pelicula));
          $pelicula_completa->setVotes($array['vote_average']);
          return $pelicula_completa;
    }

    private function getTrilerPelicula($id_pelicula)//Con el id de pelicula nos traemos los datos para el triller
    {
       
        $datos_video = file_get_contents('https://api.themoviedb.org/3/movie/'. $id_pelicula .'/videos?api_key=b285f5e6eecdd8eda1b3f5a82415153b&language=en-US');

        $array = ($datos_video) ? json_decode($datos_video,true) : array();
 
       
        foreach($array as $values=>$key)
        {
            if($values=='results')
            {
               foreach($key as $k)
               {
                   return $k['key'];
               }
            }
        }

        return false;
    }


}
?>