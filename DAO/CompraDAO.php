<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\Compra as Compra;
    use DAO\Connection as connection;


    class CompraDAO
    {        
        private $compraList = array();
        private $fileName;
        private $connection;

          
        public function Add( $compra){
           
            $sql = "INSERT INTO compras(Id_User , Numero_Tarjeta , Cantidad_Entradas , Total) VALUES(:Id_User,:Numero_Tarjeta,:Cantidad_Entradas,:Total)";
    
            $parameters['Id_User'] = $compra->getIdUser();
            $parameters['Numero_Tarjeta'] = $compra->getNumeroTarjeta();
            $parameters['Cantidad_Entradas'] = $compra->getCantidadEntradas();
            $parameters['Total'] = $compra->getTotal();
            
            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
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

        public function getUltimaRow(){
           
            $compra = new Compra();
            try
            {
                $query = "SELECT  Id_Compra FROM compras ORDER BY Id_Compra ASC";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $compra->setId($row["Id_Compra"]);                        
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $compra;
            
        }

        public function getById($idCompra){

            $compra = new Compra();
            try
            {
                $query = "SELECT  * FROM compras WHERE Id_Compra = '$idCompra'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $compra->setId($row["Id_Compra"]);         
                        $compra->setCantidadEntradas($row["Cantidad_Entradas"]); 
                        $compra->setTotal($row["Total"]);               
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $compra;
        }


        public function getByIdUser($idUser){
            
            $arregloCompras = array();
            try
            {
                $query = "SELECT  * FROM compras WHERE Id_User = '$idUser'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        $compra = new Compra();
                        $compra->setId($row["Id_Compra"]);         
                        $compra->setCantidadEntradas($row["Cantidad_Entradas"]); 
                        $compra->setTotal($row["Total"]);            
                        
                        array_push($arregloCompras,$compra);
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $arregloCompras;

        }

    }
?>
