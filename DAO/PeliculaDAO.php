<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\Pelicula as Pelicula;
    use DAO\Connection as connection;


    class PeliculaDAO
    {        
        private $peliculaList = array();
        private $fileName;
        private $connection;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/pelicula.json";
            $this->connection = null;
        }
        
        public function Delete(Pelicula $pelicula){
            //$this->SaveData($pelicula);
        }

        public function GetAll() {
            
            $peliculaList = $this->RetrieveData();
            return $peliculaList;
        }



        private function RetrieveData()
        {
            $peliculaList = array();
            try
            {
                $query = "SELECT * FROM peliculas;";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $pelicula = new pelicula();
                        
                        $pelicula->setId($row["Id_Pelicula"]);
                        $pelicula->setPosterPath($row["PosterPath"]);
                        $pelicula->setPosterHorizontal($row["PosterHorizontal"]);
                        $pelicula->setTitle($row["Title"]);
                        $pelicula->setOverview($row["Overview"]);
       
                         
                        array_push($peliculaList, $pelicula);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $peliculaList;
        }

        public function RetrieveOne($id)
        {
            $peliculas = $this->RetrieveData();
            foreach($peliculas as $values)
            {
                if($values->getId()==$id)
                    return $values;
            }
        }

        public function SaveApi($cartelera)
        {
            $this->SaveDataApi($cartelera);
        }

        //guarda todas las peliculas de la api en la base de datos
        private function SaveDataApi($Cartelera)
        {
            $arrayToEncode = array();
            $sql = "INSERT INTO peliculas (PosterPath,PosterHorizontal,Title,Overview) VALUES (:PosterPath,:PosterHorizontal,:Title,:Overview)";

            
            $parameters["PosterPath"] = $Cartelera->getPosterPath();
            $parameters["PosterHorizontal"] = $Cartelera->getPosterHorizontal();
            $parameters["Title"] = $Cartelera->getTitle();
            $parameters["Overview"] = $Cartelera->getOverview();  
           

            try{
                    $this->connection = connection::GetInstance();
                    return $this->connection->ExecuteNonQuery($sql,$parameters);
                }
            catch(PDOException $e){
                    echo $e;
                }
            

        }


        public function GetPeliculasEnFunciones() {
            
            $peliculaList = array();
            try
            {
                $query = "  SELECT p.* 
                            FROM peliculas as p
                            INNER JOIN funciones as f
                            ON f.Id_Pelicula = p.Id_Pelicula;";

                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $pelicula = new pelicula();
                        
                        $pelicula->setId($row["Id_Pelicula"]);
                        $pelicula->setPosterPath($row["PosterPath"]);
                        $pelicula->setPosterHorizontal($row["PosterHorizontal"]);
                        $pelicula->setTitle($row["Title"]);
                        $pelicula->setOverview($row["Overview"]);
       
                        // Es para que no se repitan las peliculas y se muestren mas de una vez en la cartelera
                         if($this->checkRepetido($peliculaList, $pelicula) == false ){
                             array_push($peliculaList, $pelicula);
                         }    
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $peliculaList;
        }

        private function checkRepetido($peliculaList,$pelicula){
            $flag = false;
            foreach($peliculaList as $value){
                if($value->getId() == $pelicula->getId() ){
                    $flag = true;
                }
            }
            return $flag;
        }
       

        
    }
?>
