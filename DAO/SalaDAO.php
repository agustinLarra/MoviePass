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
            try{
               $this->SaveData($sala);
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
            
        }

        public function GetAll() {
            try{
               $salaList = $this->RetrieveData();
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
            
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
                throw new PDOException($e->getMessage());
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
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
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
                        $sala->setEstado($row["Eliminado"]);

                         
                        array_push($salaList, $sala);
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            
            return $salaList;
        }

        public function GetSalasDisponibles()
        {
            try{
             $salas = $this->RetrieveSalasNoEliminadas();
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
            return $salas;

        }

        private function RetrieveSalasNoEliminadas()
        {
            $salaList = array();
            try
            {
                $query = "SELECT * FROM salas;";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        if($row['Eliminado']==0)
                        {
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
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $salaList;

        }

        public function EditSala($id,$nombre,$precio,$capacidad,$tipo)
        {
            try{
                $query = "UPDATE salas SET Nombre = '$nombre' , Precio = '$precio', Capacidad = '$capacidad' , Tipo_sala = '$tipo' WHERE salas.Id_Sala = '$id'";
               
                $parameters['Nombre'] = $nombre;
                $parameters['Precio'] = $precio;
                $parameters['Capacidad'] =$capacidad;
                $parameters['Tipo_sala'] = $tipo;
             
            

                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }
        }
  
        public function Delete($id)
        {
           // $parameters = $sala->getId();
            $sql ="UPDATE salas SET Eliminado = '1' WHERE salas.Id_Sala = '$id'";
            $parameters["Eliminado"] = $id;

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            
        }

        public function Alta($id)
        {
          
            $sql ="UPDATE salas SET Eliminado = '0' WHERE salas.Id_Sala = '$id'";
            $parameters["Eliminado"] = 0;

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            

        }


        public function getByID($idSala){

           $sala = new Sala();
            try
            {
                $query = "SELECT * FROM salas WHERE Id_Sala = '$idSala'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {

                        
                                                
                        $sala->setId($row["Id_Sala"]);
                        $sala->setNombre($row["Nombre"]);
                        $sala->setPrecio($row["Precio"]);
                        $sala->setCapacidad($row["Capacidad"]);
                        $sala->setTipoSala($row["Tipo_sala"]);
                        $sala->setIdCine($row["Id_Cine"]);
                        $sala->setEstado($row["Eliminado"]);

                     


                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            

            return $sala;
        }



        

        
    }
?>



