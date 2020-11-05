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

          
        public function Add(Compra $compra){
           
            $sql = "INSERT INTO compras(Id_User , Numero_Tarjeta , Cantidad_Entradas , Total) VALUES(:Id_User,:Numero_Tarjeta,:Cantidad_Entradas,:Total)";
    
            var_dump($compra);
            $parameters['Id_User'] = $compra->getIdUser();
            $parameters['Numero_Tarjeta'] = $compra->getNumeroTarjeta();
            $parameters['Cantidad_Entradas'] = $compra->getCantidadEntradas();
            $parameters['Total'] = $compra->getTotal();
            
            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }
        }


        public function GetAll() {
            
            $salaList = $this->RetrieveData();
            return $salaList;
        }

        public function getUltimaRow(){

            
        }



    }
?>
