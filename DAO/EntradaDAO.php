<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\Entrada as Entrada;
    use DAO\Connection as connection;


    class EntradaDAO
    {        
        private $compraList = array();
        private $fileName;
        private $connection;

          
        public function Add(Entrada $entrada){
           
            $sql = "INSERT INTO entradas(QR , Id_Compra , Id_Funcion) VALUES(:QR,:Id_Compra,:Id_Funcion)";
    
            $parameters['QR'] = $entrada->getQR();
            $parameters['Id_Compra'] = $entrada->getIdCompra();
            $parameters['Id_Funcion'] = $entrada->getIdFuncion();
            
            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }
        }

        private function RetrieveData()
        {
            $generoList = array();
            try
            {
                $query = "SELECT Id_Funcion FROM entradas;";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $ticket = new Entrada();
                        
                       // $genero->setId($row["Nombre"]);
                        $ticket->setIdFuncion($row["Id_Funcion"]);
          
       
                         
                        array_push($generoList, $ticket);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $generoList;
        }



        public function GetAll() {
            
            $entrada = $this->RetrieveData();
            return $entrada;
        }

        public function getIdCompraByIdFuncion($idFuncion){

            $idCompraList = array();
            try
            {
                $query = "SELECT Id_Compra FROM entradas WHERE Id_Funcion = '$idFuncion';";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $idCompra = $row["Id_Compra"];
                        
                        array_push($idCompraList, $idCompra);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }

            $ArregloIdsUnique = array_unique($idCompraList);

            return $ArregloIdsUnique;

        }

        public function getByIdCompra($idCompra){

            $entrada = new Entrada();
            try
            {
                $query = "SELECT Id_Funcion  FROM entradas WHERE Id_Compra = '$idCompra';";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $entrada->setIdFuncion($row["Id_Funcion"]);
                       
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }


            return $entrada;
        }



    }
?>
