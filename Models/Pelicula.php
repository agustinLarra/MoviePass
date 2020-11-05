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
    private $runtime;
    private $release_date;

    public function getId(){
        return $this->id ;
    }
    public function setId($id){
        $this->id = $id ;
    }


    public function getTitle(){
        return $this->title ;
    }
    public function setTitle($title){
        $this->title = $title ;
    }

    public function getPosterPath(){
        return $this->poster_path ;
    }
    public function setPosterPath($poster_path){
        $this->poster_path = $poster_path ;
    }
    
    public function  setPosterHorizontal($poster_horizontal){
        $this->poster_horizontal = $poster_horizontal ;
    }
    public function  getPosterHorizontal(){
        return $this->poster_horizontal ;
    }
    public function getGenres()
    {
        return $this->genre_ids;
    }
    public function setGenre($genre)
    {
        $this->genre_ids=$genre;
    }
    public function getUngenre()
    {
        return $this->genre_ids[0];//Devuelve el primer id de genero para buscar por este
    }

    public function getOverview(){
        return $this->overview ;
    }
    public function setOverview($overview){
        $this->overview = $overview ;
    }

    public function getVideo()
    {
        return $this->video;
    }
    public function setVideo($video)
    {
        $this->video = $video;
    }

    public function setRunTime($runtime)
    {
        $this->runtime = $runtime;
    }
    public function getRuntime()
    {
        return $this->runtime;
    }

    public function getReleaseDate()
    {
        return $this->release_date;
    }
    public function setReleaseDate($date)
    {
        $this->release_date = $date;
    }


}

