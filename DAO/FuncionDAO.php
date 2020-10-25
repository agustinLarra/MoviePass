<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\Sala as Sala;
    use Models\Funcion as Funcion;
    use Models\Pelicula as Pelicula;
    use DAO\Connection as connection;


    class FuncionDao
    {        
        private $funcionList = array();
        private $fileName;
        private $connection;

        public function __construct()
        {
            //$this->fileName = dirname(__DIR__)."/Data/Funcion.json";
            $this->connection = null;
        }
        
        public function Add(Funcion $funcion){
            $this->SaveData($funcion);
        }

        public function GetAll() {
            
            $funcionList = $this->RetrieveData();
            return $funcionList;
        }


        private function RetrieveData()
        {
            $funcionList = array();
            try
            {
                $query = "SELECT * FROM funciones";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $Funcion = new Funcion();
                        $Funcion->setId($row["Id_Funcion"]);
                        $Funcion->setIdPelicula($row["Id_Pelicula"]);
                        $Funcion->setIdSala($row["Id_Sala"]);
                        $Funcion->setHorario($row["Horario"]);
                        $Funcion->setDescuento($row["Descuento"]);
       
                         
                        array_push($funcionList, $Funcion);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $funcionList;
        }
  
    
    
        private function SaveData(Funcion $funcion)
        {
            $sql = "INSERT INTO funciones(Id_Pelicula,Id_Sala,Horario,Descuento) VALUES(:Id_Pelicula,:Id_Sala,:Horario,:Descuento)";
    
            $parameters['Id_Pelicula'] = $funcion->getIdPelicula();
            $parameters['Id_Sala'] = $funcion->getIdSala();
            $parameters['Horario'] = $funcion->getHorario();
            $parameters['Descuento'] = $funcion->getDescuento();
            
            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }

        }


       

        
    }
?>