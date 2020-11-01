<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\Pelicula as Pelicula;
    use DAO\Connection as connection;
    use DAO\GeneroDao as GeneroDao;
    use Models\Genero as Genero;

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

        public function checkPeliRepetida($pelicula){

            $idPelicula = $pelicula->getId();
            $repetido = true;
            try
            {
                $query = "SELECT * FROM peliculas WHERE Id_Pelicula = '$idPelicula'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(empty($resultSet)) {
                    $repetido = false;
                }
            
            }catch(PDOException $e){
                echo $e;
            }
    
            return $repetido;
        }




        public function SaveFromApi($pelicula)
        {
            $this->SaveDataApi($pelicula);
            $this->ConectarConPeliXGenero($pelicula);
        }

        private function ConectarConPeliXGenero($pelicula)
        {

            $listaGenerosDeLaPelicula = $pelicula->getGenres();

            $sizeArreglo = count($listaGenerosDeLaPelicula);
            $i=0;


            while( $i < $sizeArreglo){

                $sql = "INSERT INTO peliculasXgenero (Id_Genero,Id_Pelicula) VALUES (:Id_Genero,:Id_Pelicula)";
                    
                $parameters["Id_Genero"] = $listaGenerosDeLaPelicula[$i];
                $parameters["Id_Pelicula"] = $pelicula->getId();
                
                
                try{
                        $this->connection = connection::GetInstance();
                         $this->connection->ExecuteNonQuery($sql,$parameters);
                    }
                catch(PDOException $e){
                        echo $e;
                    }

                $i++;    
            }


        }


        //guarda todas las peliculas de la api en la base de datos
        private function SaveDataApi($pelicula)
        {
            $arrayToEncode = array();
            $sql = "INSERT INTO peliculas (Id_Pelicula,PosterPath,PosterHorizontal,Title,Overview) VALUES (:Id_Pelicula,:PosterPath,:PosterHorizontal,:Title,:Overview)";

            $parameters["Id_Pelicula"] = $pelicula->getId();
            $parameters["PosterPath"] = $pelicula->getPosterPath();
            $parameters["PosterHorizontal"] = $pelicula->getPosterHorizontal();
            $parameters["Title"] = $pelicula->getTitle();
            $parameters["Overview"] = $pelicula->getOverview();  
           

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
       

        
        public function FiltrarPelisXGenero($idGenero){


            $arregloIdsPeliculas = $this->getPelisIdConEsteGenero($idGenero);

            $arregloPeliculas = array();
            foreach($arregloIdsPeliculas as $idPelicula){

               $pelicula =  $this->getPeliByID($idPelicula);
               array_push($arregloPeliculas, $pelicula);

            }
            
            return $arregloPeliculas;
        }


        private function getPelisIdConEsteGenero($idGenero){
            
            $arregloIdsPeliculas = array();
            try
            {
                $query = "SELECT Id_Pelicula FROM peliculasXgenero WHERE Id_Genero = '$idGenero'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                                                
                        $row["Id_Pelicula"];
                        
                        array_push($arregloIdsPeliculas, $row["Id_Pelicula"]);
                    }
                }
            }catch(PDOException $e){
                        echo $e;
            }
    
            return $arregloIdsPeliculas;
        }


        public function getPeliByID($idPelicula){


            $pelicula ;
            try
            {
                $query = "SELECT * FROM peliculas WHERE Id_Pelicula = '$idPelicula'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {

                        $pelicula = new Pelicula();
                            
                        $pelicula->setId($row["Id_Pelicula"]);
                        $pelicula->setPosterPath($row["PosterPath"]);
                        $pelicula->setPosterHorizontal($row["PosterHorizontal"]);
                        $pelicula->setTitle($row["Title"]);
                        $pelicula->setOverview($row["Overview"]);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }

            return $pelicula;
        }

       
        
    }
?>
