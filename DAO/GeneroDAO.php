<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\Pelicula as Pelicula;
    use DAO\Connection as connection;
use Models\Genero;

class GeneroDAO
    {        
        private $generoList = array();
        private $fileName;
        private $connection;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/genero.json";
            $this->connection = null;
        }
        
 
        public function GetAll() {
            try{
                $generoList = $this->RetrieveData();
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
           
            return $generoList;
        }
        public function GetOne($id)
        {
            try{
               $genero = $this->RetrieveOne($id);
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
        }

    

        private function RetrieveData()
        {
            $generoList = array();
            try
            {
                $query = "SELECT * FROM generos;";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $genero = new Genero();
                        
                        $genero->setTipo($row["Nombre"]);
                        $genero->setId($row["Id_Genero"]);
          
       
                         
                        array_push($generoList, $genero);
                    }
                }
            
            }catch(Exception $e){
                throw new Exception($e->get_message());
         }
            return $generoList;
        }

        private function RetrieveOne($id)
        {
            $generoList =  $this->RetrieveData();
            foreach($generoList as $values)
            {
                if($values->getId()==$id)
                {
                    return $values;
                }
            }
            return false;
        }

        public function SaveGenero($Genero)
        {
            $this->SaveDataApiGenero($Genero);
        }

        //guarda todas los Generos de la api en la base de datos
        private function SaveDataApiGenero($Genero)
        {
            $arrayToEncode = array();
            $sql = "INSERT INTO generos (Id_Genero,Nombre) VALUES (:Id_Genero,:Nombre)";
            
            $parameters["Id_Genero"] = $Genero->getId();
            $parameters["Nombre"] = $Genero->getTipo();
           
            try{
                    $this->connection = connection::GetInstance();
                    return $this->connection->ExecuteNonQuery($sql,$parameters);
                }catch(Exception $e){
                    throw new Exception($e->get_message());
             }
            

        }

        public function checkGeneroRepetido($genero){

            $idGenero = $genero->getId();
            $repetido = true;
            try
            {
                $query = "SELECT * FROM generos WHERE Id_Genero = '$idGenero'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(empty($resultSet)) {
                    $repetido = false;
                }
            
            }catch(Exception $e){
                throw new Exception($e->get_message());
         }
    
            return $repetido;
        }



        

        
    }
?>