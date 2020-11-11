<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\Descuento as Descuento;
    use DAO\Connection as connection;


    class DescuentoDAO
    {        
        private $compraList = array();
        private $fileName;
        private $descuento;
        private $connection;

          
     /*   public function Add(Entrada $entrada){
           
            $sql = "INSERT INTO entradas(QR , Id_Compra , Id_Funcion) VALUES(:QR,:Id_Compra,:Id_Funcion)";
    
            $parameters['QR'] = $entrada->getQR();
            $parameters['Id_Compra'] = $entrada->getIdCompra();
            $parameters['Id_Funcion'] = $entrada->getIdFuncion();
            
            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
        }
*/
        private function RetrieveData()
        {
            $descuentoList = array();
            try
            {
                $query = "SELECT * FROM descuento;";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $descuento = new Descuento();
                        
                       $descuento->setIdDescuento($row["Id_Descuento"]);
                       $descuento->setPorcentaje($row["porcentaje"]);

                        array_push($descuentoList, $descuento);
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $descuentoList;
        }



        public function GetAll() {
            
            $descuento = $this->RetrieveData();
            return $descuento;
        }

        public function getPorcentajeBtId($idDescuento)
        {
            
            try
            {
                $query = "SELECT porcentaje FROM Descuento WHERE Id_Descuento = '$idDescuento'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $this->descuento = $row["porcentaje"];
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $this->descuento;
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
                throw new PDOException($e->getMessage());
            }

            $ArregloIdsUnique = array_unique($idCompraList);

            return $ArregloIdsUnique;

        }

        public function getByIdCompra($idCompra){

          //  $entrada = new Entrada();
            try
            {
                $query = "SELECT Id_Funcion  FROM entradas WHERE Id_Compra = '$idCompra';";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                      //  $entrada->setIdFuncion($row["Id_Funcion"]);
                       
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }


           // return $entrada;
        }



    }
?>
