<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\Sala as Sala;
    use Models\Funcion as Funcion;
    use Models\Pelicula as Pelicula;
    use DAO\Connection as connection;


    class FuncionDao
    {        
        private $funcionList = array();
        private $fileName;
        private $connection;

        public function __construct()
        {
            //$this->fileName = dirname(__DIR__)."/Data/Funcion.json";
            $this->connection = null;
        }
        
        public function Add(Funcion $funcion){
            $this->SaveData($funcion);
        }

        public function GetAll() {
            
            $funcionList = $this->RetrieveData();
            return $funcionList;
        }
        public function GetId($id)
        {
            return $this->RetrieveOne($id);

        }
        public function GetDia($dia)
        {
            return $this->RetrieveDia($dia);
        }
        public function DeleteFuncionId($id)
        {
            $this->DeleteId($id);
        }


        private function RetrieveData()
        {
            $funcionList = array();
            try
            {
                $query = "SELECT * FROM funciones";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $Funcion = new Funcion();
                        $Funcion->setId($row["Id_Funcion"]);
                        $Funcion->setIdPelicula($row["Id_Pelicula"]);
                        $Funcion->setIdSala($row["Id_Sala"]);
                        $Funcion->setDia($row["Dia"]);
                        $Funcion->setHora($row["Hora"]);
                        $Funcion->setDescuento($row["Descuento"]);
       
                         
                        array_push($funcionList, $Funcion);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $funcionList;
        }

        private function RetrieveOne($id)
        {
            $funcionlist =  $this->RetrieveData();
            foreach($funcionlist as $values)
            {
                if($values->getId()==$id)
                {
                    return $values;
                }
            }
            return false;
        }

        private function RetrieveDia($dia)
        {
            $array_funcion = array();
            $funcionlist =  $this->RetrieveData();
            foreach($funcionlist as $values)
            {
                if($values->getDia()==$dia)
                {
                    array_push($array_funcion,$values);
                }
            }
            return $array_funcion;
        }
  
    
    
        private function SaveData($funcion)
        {
            $sql = "INSERT INTO funciones(Id_Pelicula,Id_Sala,Dia,Hora,Descuento) VALUES(:Id_Pelicula,:Id_Sala,:Dia,:Hora,:Descuento)";
    
            $parameters['Id_Pelicula'] = $funcion->getIdPelicula();
            $parameters['Id_Sala'] = $funcion->getIdSala();
            $parameters['Dia'] = $funcion->getDia();
            $parameters['Hora'] = $funcion->getHora();
            $parameters['Descuento'] = $funcion->getDescuento();
            $parameters['Eliminado'] = $funcion->getEstado();
            
            try{
                $this->connection = connection::GetInstance();
                 $this->connection->ExecuteNonQuery($sql,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }
        }

        private function DeleteId($id)
        {
            $sql = "DELETE FROM funciones  WHERE Id_Funcion = '$id'";

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$id);
            }
            catch(PDOException $e){
                echo $e;
            }
        }

        public function getById($idFuncion){

            $funcion = new Funcion();
            try
            {
                $query = "SELECT f.Id_Funcion, s.Precio, f.Descuento
                          FROM funciones as f
                          INNER JOIN salas as s
                          ON f.Id_Sala = s.Id_Sala
                          WHERE f.Id_Funcion = '$idFuncion'";

                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $funcion->setId($row["Id_Funcion"]);
                        $funcion->setDescuento($row["Descuento"]);
                        $sala = new Sala();
                        $sala->setPrecio($row["Precio"]);
                        $funcion->setClassSala($sala);

                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $funcion;
        }
        


        public function getFuncionesByIdPelicula($idPelicula){

            $funcionList = array();
            try
            {
                $query = "SELECT * FROM funciones WHERE Id_Pelicula = '$idPelicula'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $Funcion = new Funcion();
                        $Funcion->setId($row["Id_Funcion"]);
                        $Funcion->setIdPelicula($row["Id_Pelicula"]);
                        $Funcion->setIdSala($row["Id_Sala"]);
                        $Funcion->setDia($row["Dia"]);
                        $Funcion->setHora($row["Hora"]);
                        $Funcion->setDescuento($row["Descuento"]);
       
                         
                        array_push($funcionList, $Funcion);
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $funcionList;
        }

        public function getFuncionCompleta($idFuncion){

            $Funcion = new Funcion();
            try
            {
                $query = "  SELECT p.PosterPath, p.Title, c.Nombre as NombreCine, s.Nombre as NombreSala, f.Dia, f.Hora 
                            FROM funciones as f
                            INNER JOIN peliculas as p
                            ON p.Id_Pelicula = f.Id_Pelicula
                            INNER JOIN salas as s
                            ON s.Id_Sala = f.Id_Sala
                            INNER JOIN cines as c
                            ON c.Id_Cine = s.Id_Cine
                            WHERE f.Id_Funcion = '$idFuncion'";

                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $Funcion->setPosterPelicula($row["PosterPath"]);
                        $Funcion->setTitlePelicula($row["Title"]);
                        $Funcion->setNombreCine($row["NombreCine"]);
                        $Funcion->setNombreSala($row["NombreSala"]);
                        $Funcion->setDia($row["Dia"]);
                        $Funcion->setHora($row["Hora"]);
                        
                    }
                }
            
            }catch(PDOException $e){
                echo $e;
            }
            return $Funcion;

        }


        public function Delete($id)
        {
           // $parameters = $sala->getId();
            $sql ="UPDATE funciones SET Eliminado = '1' WHERE funciones.Id_Funcion = '$id'";

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$id);
            }
            catch(PDOException $e){
                echo $e;
            }
        }

        public function Alta($id)
        {
          
            $sql ="UPDATE funciones SET Eliminado = '0' WHERE funciones.Id_Funcion = '$id'";

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }

        }


        
  







        
    }
?>