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
            $this->SaveData($cine);
        }

        public function GetAll() 
        {
            $cineList = $this->RetrieveData();
            return $cineList;
        }

        public function SaveData(Cine $cine){
            ///REVISAR POR QUE ACA EN LOS VALUES NO SE PASA EL ID.

            $sql = "INSERT INTO cines(Id_Cine,Nombre,Ciudad,Calle,Numero) VALUES(:Nombre,:Ciudad,:Calle,:Numero)";
    
            $parameters['Nombre'] = $cine->getNombre();
            $parameters['Ciudad'] = $cine->getCiudad();
            $parameters['Calle'] = $cine->getCalle();
            $parameters['Numero'] = $cine->getNumero();
            
            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }
        }

        public function RetrieveData(){
            
            $cineList = array();
            try
            {
                $query = "SELECT * FROM cines;"; /// 
                $this->connection = connection::GetInstance();    
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $cine = new Cine();
                        
                        ///HASTA ACA !
                        
                        ///FALTA ID_USER.
                        $cine->setNombre($row["Nombre"]);
                        $cine->setCiudad($row["Ciudad"]);
                        $cine->setNumero($row["Numero"]);
                        $cine->setCalle($row["Calle"]);
                         
                        array_push($cineList, $cine);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $cineList;
        }


        ///---------------------------

        public function GetIdByName(){ 

            // $idCine = $cineDao->getIDbyName($nombreCine);
            //Consulta que haga Select id_sala from sala where nombre = $nombreSala;
       
        }

        public function Delete(){
                
        }


    /*
        public function getByEmail($email) {
            $this->RetrieveData();
            //$validationGetByEmail = false;

            foreach ($this->UserList as $key => $user) {
                if($user->getEmail() == $email) {
                    //$validationGetByEmail = true;
                    return $user;
                }
            }
            return null;
            /*
            if($validationGetByEmail == 'false'){
                return $validationGetByEmail;
            }
             
        }
    */   


    

    
    }
?>



?>