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
                        
                        $sala->setId($row["Id_Sala"]);
                        $sala->setNombre($row["Nombre"]);
                        $sala->setPrecio($row["Precio"]);
                        $sala->setCapacidad($row["Capacidad"]);
                        $sala->setTipoSala($row["Tipo_sala"]);
                        $sala->setIdCine($row["Id_Cine"]);
                        $sala->setEstado($row["Eliminado"]);
       
                         
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
            $sql = "INSERT INTO salas(Nombre,Precio,Capacidad,Id_Cine,Tipo_sala,Eliminado) VALUES(:Nombre,:Precio,:Capacidad,:Id_Cine,:Tipo_sala,:Eliminado)";
    
            $parameters['Nombre'] = $sala->getNombre();
            $parameters['Precio'] = $sala->getPrecio();
            $parameters['Capacidad'] = $sala->getCapacidad();
            $parameters['Id_Cine'] = $sala->getIdCine();
            $parameters['Tipo_sala'] = $sala->getTipoSala();
            $parameters['Eliminado'] = 0;
            
            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }

        }


        public function GetByIdCine($Id_Cine) {
            
            $salaList = array();
            try
            {
                $query = "SELECT * FROM salas WHERE Id_Cine = $Id_Cine ;";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $sala = new Sala();
                        
                        $sala->setId($row["Id_Sala"]);
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




        public function Delete($id)
        {
           // $parameters = $sala->getId();
            $sql ="UPDATE salas SET Eliminado = '1' WHERE salas.Id_Sala = '$id'";

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$id);
            }
            catch(PDOException $e){
                echo $e;
            }
        }
        public function Alta($parameters)
        {
          
            $sql ="UPDATE salas SET Eliminado = '0' WHERE salas.Id_Sala = '$parameters'";

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }

        }


        public function getByID($idSala){

           // $sala;
            try
            {
                $query = "SELECT * FROM salas WHERE Id_Sala = '$idSala'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {

                        $sala = new Sala();
                                                
                        $sala->setId($row["Id_Sala"]);
                        $sala->setNombre($row["Nombre"]);
                        $sala->setPrecio($row["Precio"]);
                        $sala->setCapacidad($row["Capacidad"]);
                        $sala->setTipoSala($row["Tipo_sala"]);
                        $sala->setIdCine($row["Id_Cine"]);

                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }

            return $sala;
        }

        

        
    }
?>



