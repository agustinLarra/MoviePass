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
            $this->RetrieveData();
            
            array_push($this->cineList, $cine);

            $this->SaveData();
        }



        public function GetAll() ///MODIFICAR 
        {
            //$this->RetrieveData();

            //return $this->cineList;

            $cineList = array();
            try
            {
                $query = "SELECT * FROM cines;";
                $this->connection = connection::GetInstance();    
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $cine = new Cine();
                        
                        ///HASTA ACA !

                        $cine->setId($row["Id_User"]);
                        $cine->setFirstName($row["FirstName"]);
                        $cine->setLastName($row["LastName"]);
                        $cine->setDNI($row["DNI"]);
                        $cine->setEmail($row["Email"]);
                        $cine->setPassword($row["Pass"]);
                         
                        array_push($userList, $user);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $userList;



        }




















        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cineList as $cine)
            { 
                // Modificar este codigo para acomodarlo. 

                $valuesArray["nombre"] = $cine->getNombre();
                $valuesArray["direccion"] = $cine->getDireccion();
                $valuesArray["capacidad"] = $cine->getCapacidad();
                $valuesArray["valorEntrada"] = $cine->getValorEntrada();
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cineList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cine = new Cine();
                    $cine->setNombre($valuesArray["nombre"]);
                    $cine->setDireccion($valuesArray["direccion"]);
                    $cine->setCapacidad($valuesArray["capacidad"]);
                    $cine->setValorEntrada($valuesArray["valorEntrada"]);

                    array_push($this->cineList, $cine);
                }
            }
        }
    }
?>



?>