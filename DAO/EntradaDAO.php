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

        



    }
?>
