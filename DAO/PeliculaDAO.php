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
            
            $peliculaList = $this->SaveData();
            return $peliculaList;
        }

    

        private function RetrieveData()
        {
            $peliculaList = array();
            try
            {
                $query = "SELECT * FROM pelicula;";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $pelicula = new pelicula();
                        
                        $pelicula->setId($row["Id_Pelicula"]);
                        $pelicula->setPosterPath($row["PosterPath"]);
                        $pelicula->setPosterHorizontal($row["PosterHorizontal"]);
                        $pelicula->setTitle($row["Title"]);
                        $pelicula->setGenre($row["Genre"]);
                        $pelicula->setOverview($row["Overview"]);
       
                         
                        array_push($peliculaList, $pelicula);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $peliculaList;
        }

       

        
    }
?>
