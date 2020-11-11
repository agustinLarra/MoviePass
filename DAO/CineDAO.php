<?php

    namespace DAO;

    use Models\Cine as Cine;
    use PDOException;
    use DAO\IDAO as IDAO;
    use DAO\Connection as connection;

    class CineDAO
    {        
        private $cineList = array();
        private $fileName;
        private $connection;
        
        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/Cine.json";
        }

        public function Add(Cine $cine)
        {
            try{
               $this->SaveData($cine);
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
        }

        public function GetAll() 
        {
            try{
               $cineList = $this->RetrieveData();
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
            return $cineList;
        }

        public function Delete($id)
        {
        
            $sql ="UPDATE cines SET Eliminado = '1' WHERE cines.Id_Cine = '$id'";
            $parameters["Eliminado"]= 1;

            try{
                $this->connection = connection::GetInstance();
                 $this->connection->ExecuteNonQuery($sql,$parameters);
                 return true;
            }
            catch(PDOException $e){
                echo $e;
            }
            return false;
        }

        public function Alta($id)
        {
          
            $sql ="UPDATE cines SET Eliminado = '0' WHERE cines.Id_Cine = '$id'";
            $parameters["Eliminado"]= 0;
            try{
                $this->connection = connection::GetInstance();
                $this->connection->ExecuteNonQuery($sql,$parameters);
                
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }

        }
  

        public function SaveData(Cine $cine){
            ///REVISAR POR QUE ACA EN LOS VALUES NO SE PASA EL ID.

            $sql = "INSERT INTO cines(Nombre,Ciudad,Calle,Numero,Eliminado) VALUES(:Nombre,:Ciudad,:Calle,:Numero,:Eliminado)";
    
            $parameters['Nombre'] = $cine->getNombre();
            $parameters['Ciudad'] = $cine->getCiudad();
            $parameters['Calle'] = $cine->getCalle();
            $parameters['Numero'] = $cine->getNumero();
            $parameters['Eliminado'] = 0;

            
            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
        }

        public function RetrieveData(){
            
            $cineList = array();
            try
            {
                $query = "SELECT * FROM cines;";
                $this->connection = connection::GetInstance();    
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $cine = new Cine();
                                                
                        $cine->setId($row["Id_Cine"]);
                        $cine->setNombre($row["Nombre"]);
                        $cine->setCiudad($row["Ciudad"]);
                        $cine->setNumero($row["Numero"]);
                        $cine->setCalle($row["Calle"]);
                        $cine->setEstado($row["Eliminado"]);
                        array_push($cineList, $cine);
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $cineList;
        }


        ///---------------------------

        public function GetIdByName(){ 

            // $idCine = $cineDao->getIDbyName($nombreCine);
            //Consulta que haga Select id_sala from sala where nombre = $nombreSala;
       
        }


        public function ModifyCine(Cine $cine)
        {
            $parameters = $cine->getId();
            $sql = "UPDATE cines SET nombre=?,telefono=?,email=? WHERE Id_Cine= $parameters";

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }


        }



        public function RetrieveOne($id)
        {
            try{
               $cines = $this->RetrieveData();
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
            foreach($cines as $values)
            {
                if($values->getId()==$id)
                    return $values;
            }
        }

        public function getByID($idCine){

            $cine = new Cine();
            try
            {
                $query = "SELECT * FROM cines WHERE Id_Cine = '$idCine'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {

                       
                        $cine->setId($row["Id_Cine"]);
                        $cine->setNombre($row["Nombre"]);
                        $cine->setCiudad($row["Ciudad"]);
                        $cine->setNumero($row["Numero"]);
                        $cine->setCalle($row["Calle"]);
                        $cine->setEstado($row["Eliminado"]);
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }

            return $cine;
        }
        
        public function getAll_Id()
        {
            $id_cines = array();
            $array = array();
            
            try{
                 $query = "SELECT Id_Cine FROM cines";
                 $this->connection = connection::GetInstance();   
                 $resultSet = $this->connection->execute($query); 

                 if(!empty($resultSet)) {
                    foreach($resultSet as $row) {

                       
                        $id_cines = ($row["Id_Cine"]);
                        array_push($array,$id_cines);

                    }
                }
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $array;

        }

        public function RetrieveDataExist(){
            
            $cineList = array();
            try
            {
                $query = "SELECT * FROM cines WHERE Eliminado = '0' ";
                $this->connection = connection::GetInstance();    
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $cine = new Cine();
                                                
                        $cine->setId($row["Id_Cine"]);
                        $cine->setNombre($row["Nombre"]);
                        $cine->setCiudad($row["Ciudad"]);
                        $cine->setNumero($row["Numero"]);
                        $cine->setCalle($row["Calle"]);
                        $cine->setEstado($row["Eliminado"]);
                        array_push($cineList, $cine);
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $cineList;
        }



    

    
    }
?>



