<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\Sala as Sala;
    use DAO\Connection as connection;


    class SalaDAO
    {        
        private $salaList = array();
        private $fileName;
        private $connection;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/Sala.json";
            $this->connection = null;
        }
        
        public function Add(Sala $sala){
            $this->SaveData($sala);
        }

        public function GetAll() {
            
            $salaList = $this->RetrieveData();
            return $salaList;
        }


        private function RetrieveData()
        {
            $salaList = array();
            try
            {
                $query = "SELECT * FROM salas;";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $sala = new Sala();
                        
<<<<<<< HEAD
                        $sala->setId($row["Id_Sala"]);
=======
                        //$sala->setId($row["Id_sala"]);
>>>>>>> 741892d6c85cb9b16257a3cbab3a33ba8f0a4190
                        $sala->setNombre($row["Nombre"]);
                        $sala->setPrecio($row["Precio"]);
                        $sala->setCapacidad($row["Capacidad"]);
                        $sala->setIdCine($row["Id_Cine"]);
       
                         
                        array_push($salaList, $sala);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $salaList;
        }
  
    
    
        private function SaveData(Sala $sala)
        {
            $sql = "INSERT INTO salas(Nombre,Precio,Capacidad,Id_Cine,Tipo_sala) VALUES(:Nombre,:Precio,:Capacidad,:Id_Cine,:Tipo_sala)";
    
            $parameters['Nombre'] = $sala->getNombre();
            $parameters['Precio'] = $sala->getPrecio();
            $parameters['Capacidad'] = $sala->getCapacidad();
            $parameters['Id_Cine'] = $sala->getIdCine();
            $parameters['Tipo_sala'] = $sala->getTipoSala();
            
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



