<?php namespace JsonDAO;
use Models\Pelicula as Pelicula;


class PeliculaJson{

    private $PeliculasList = array();
    private $fileName;   
 
 
    public function __construct()
    {
        $this->fileName = dirname(__DIR__)."/Data/Peliculas.json";
    }

    public function saveMovieToJson($peli)
    {
        $this->RetrieveData();
        array_push($this->PeliculasList,$peli);
        $this->SaveData();
    }

    public function GetMovieJson()
    {
        $this->RetrieveData();
        return $this->PeliculasList;
    }

    private function RetrieveData()
    {
         $this->PeliculasList = array();
   

        if(file_exists($this->fileName))
        {
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
           
            foreach($arrayToDecode as $valuesArray)
            {
                $pelicula = new Pelicula();
            
                $pelicula->setId($valuesArray["Id"]);
                $pelicula->setPosterPath($valuesArray["PosterPath"]);
                $pelicula->setPosterHorizontal($valuesArray["PosterHorizontal"]);
                $pelicula->setTitle($valuesArray["Title"]);
                $pelicula->setOverview($valuesArray["Overview"]);
                $pelicula->setVideo($valuesArray["Video"]);
                $pelicula->setRunTime($valuesArray["RunTime"]);
                $pelicula->setReleaseDate($valuesArray["ReleaseDate"]);
                $pelicula->setGenre($valuesArray["genre_ids"]);
                $pelicula->setVotes($valuesArray['vote_average']);
                
                array_push($this->PeliculasList, $pelicula);
            }
        }
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        if(file_exists($this->fileName))
        {
            foreach($this->PeliculasList as $pelicula)
            {
                $valuesArray["Id"] = $pelicula->getId();
                $valuesArray["PosterPath"] = $pelicula->getPosterPath();
                $valuesArray["PosterHorizontal"] = $pelicula->getPosterHorizontal();
                $valuesArray["Title"] = $pelicula->getTitle();
                $valuesArray["Overview"] = $pelicula->getOverview();
                $valuesArray["Video"] = $pelicula->getVideo();
                $valuesArray["RunTime"] = $pelicula->getRunTime();
                $valuesArray["ReleaseDate"] = $pelicula->getReleaseDate();
                $valuesArray["genre_ids"] = $pelicula->getGenres();
                $valuesArray['vote_average'] = $pelicula->getVotes();

                array_push($arrayToEncode, $valuesArray);
            }

        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT); 
        $aux =file_put_contents($this->fileName, $jsonContent);
    }

    public function checkPeliRepetidaJson($pelicula)
    {
        $idPelicula = $pelicula->getId();

        if(file_exists($this->fileName))
        {      
           $this->RetrieveData(); 
            if(!empty($this->PeliculasList))
            {

                foreach($this->PeliculasList as $values)
                { 
                
                    if(($values->getId())==$pelicula->getId())
                    {
                    return true;
                    }
                }
            }
            else return false;
        }
     return false;
    }

    public function returnById($id)
    {
        $this->RetrieveData();

        return $this->BuscaId($id);
        
    }

    private function BuscaId($id)
    {
        foreach($this->PeliculasList as $value)
        {
            if(($value->getId())==$id)
            {
                return $value;
            }
        }
        return false;
    }

    public function GetPorFechaDeEstreno($dia)
    {
        $array_pelicula = array();
        $this->RetrieveData();
        foreach($this->PeliculasList as $values)
        {
            if(($values->getReleaseDate())==$dia)
            {
                array_push($array_pelicula,$values);
            }
        }
        return $array_pelicula;
    }

 
    public function GetPorGenero($genero)
    {
        $array_pelicula = array();
        $this->RetrieveData();
        foreach($this->PeliculasList as $values)
        {
            foreach($values->getGenres() as $genero_list)
            {

                if($genero_list == $genero)
                {
                    array_push($array_pelicula,$values);
                }
        }
        }
        return $array_pelicula;

    }
}

?>
