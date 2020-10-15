<?php
namespace Models;

class Pelicula{

    private $id;
    private $poster_path;
    private $poster_horizontal;
    private $title;
    private $genre_ids = array();
    private $video;
    private $overview;

    public function getTitle(){
        return $this->title ;
    }
    public function setTitle($title){
        $this->title = $title ;
    }

    public function getPoster(){
        return $this->poster_path ;
    }
    public function setPoster($poster_path){
        $this->poster_path = $poster_path ;
    }
    
    public function  setPosterHorizontal($poster_horizontal){
        $this->poster_horizontal = $poster_horizontal ;
    }
    public function  getPosterHorizontal(){
        return $this->poster_horizontal ;
    }
   

}


?>