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


        public function GetAll() {
            
            $salaList = $this->RetrieveData();
            return $salaList;
        }

        



    }
?>
