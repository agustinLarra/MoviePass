<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\Cine as Cine;
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
            try{
               $this->SaveData($funcion);
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
        }

        public function GetAll() {
            try{
                $funcionList = $this->RetrieveData();
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
            return $funcionList;
        }

        public function GetAll_Exist() {
            try{
                $funcionList = $this->RetrieveDataExist();
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
            return $funcionList;
        }



        public function GetId($id)
        {
            try{
                $funcion = $this->RetrieveOne($id);
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            return $funcion;

        }
        public function GetDia($dia)
        {
            try{
              $dia  = $this->RetrieveDia($dia);
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
            return $dia;
        }
        public function DeleteFuncionId($id)
        {
            try{
               $this->DeleteId($id);
            }catch(Exception $e){
                   throw new Exception($e->get_message());
            }
            
            
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
                        $Funcion->setEstado($row["Eliminado"]);
       
                         
                        array_push($funcionList, $Funcion);
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $funcionList;
        }

        private function RetrieveDataExist()
        {
            $funcionList = array();
            try
            {
                $query = "SELECT * FROM funciones WHERE Eliminado = '0";
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
                throw new PDOException($e->getMessage());
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
            $sql = "INSERT INTO funciones(Id_Pelicula,Id_Sala,Dia,Hora,Descuento,Eliminado) VALUES(:Id_Pelicula,:Id_Sala,:Dia,:Hora,:Descuento,:Eliminado)";
    
            $parameters['Id_Pelicula'] = $funcion->getIdPelicula();
            $parameters['Id_Sala'] = $funcion->getIdSala();
            $parameters['Dia'] = $funcion->getDia();
            $parameters['Hora'] = $funcion->getHora();
            $parameters['Descuento'] = $funcion->getDescuento();
            $parameters['Eliminado'] = 0;
            
                $this->connection = connection::GetInstance();
                $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
        }

        private function DeleteId($id)
        {
            $sql = "DELETE FROM funciones  WHERE Id_Funcion = '$id'";

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$id);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
        }

    /*    public function Delete(Funcion $funcion)
        {
            $parameters = $funcion->getId();
            $sql = "DELETE FROM funciones WHERE Id_Funcion = '$parameters'";

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
        }*/

        public function getById($idFuncion){

            $Funcion = new Funcion();
            try
            {
                $query = "SELECT f.*, s.Precio,s.Nombre as NombreSala, p.Title, c.*
                          FROM funciones as f
                          INNER JOIN salas as s
                          ON f.Id_Sala = s.Id_Sala
                          INNER JOIN peliculas as p
                          ON p.Id_Pelicula = f.Id_Pelicula
                          INNER JOIN cines as c
                          ON c.Id_Cine = s.Id_Cine
                          WHERE f.Id_Funcion = '$idFuncion'";

                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) {
                        
                        $Funcion->setId($row["Id_Funcion"]);
                        $Funcion->setIdPelicula($row["Id_Pelicula"]);
                        $Funcion->setDia($row["Dia"]);
                        $Funcion->setHora($row["Hora"]);
                        $Funcion->setDescuento($row["Descuento"]);
                        $Funcion->setTitlePelicula($row["Title"]);
                        $cine = new Cine();
                        $cine->setNombre($row["Nombre"]);
                        $cine->setNumero($row["Numero"]);
                        $cine->setCalle($row["Calle"]);
                        $sala = new Sala();
                        $sala->setPrecio($row["Precio"]);
                        $sala->setNombre($row["NombreSala"]);
                        $Funcion->setClassSala($sala);
                        $Funcion->setClassCine($cine);
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $Funcion;
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
                throw new PDOException($e->getMessage());
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
                throw new PDOException($e->getMessage());
            }
            return $Funcion;

        }


        public function Delete($id)
        {
           // $parameters = $sala->getId();
            $sql ="UPDATE funciones SET Eliminado = '1' WHERE funciones.Id_Funcion = '$id'";
            $parameters["Eliminado"] = 1;

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }
        }

        public function Alta($id)
        {
          
            $sql ="UPDATE funciones SET Eliminado = '0' WHERE funciones.Id_Funcion = '$id'";
            $parameters["Eliminado"] = 0;
            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }
            catch(PDOException $e){
                echo $e;
            }

        }

        public function CheckExistenciaSala($idPelicula,$dia)
        {

            $query = "SELECT funciones.Id_Funcion FROM funciones WHERE Id_pelicula = '$idPelicula'  AND dia = '$dia' AND Eliminado = '0' ";
            $this->connection = connection::GetInstance();   
            $resultSet = $this->connection->execute($query);  

            try{
                if(!empty($resultSet)) {
 
                    return true;
                }
            }catch (PDOException $e){
                throw new PDOException($e->getMessage());
                }
            
            return false;
                
        }

        public function CheckExistenciaCine($idPelicula,$dia,$idCine)
        {
            $query = "SELECT * FROM funciones WHERE Id_pelicula = '$idPelicula'  AND dia = '$dia' ";
            $this->connection = connection::GetInstance();   
            $resultSet = $this->connection->execute($query);  

            try{
                if(!empty($resultSet)) {
                   /* foreach($resultSet as $row) {
                        
                        $Funcion = new Funcion();
                        $Funcion->setId($row["Id_Funcion"]);
                        $Funcion->setIdPelicula($row["Id_Pelicula"]);
                        $Funcion->setIdSala($row["Id_Sala"]);
                        $Funcion->setDia($row["Dia"]);
                        $Funcion->setHora($row["Hora"]);
                        $Funcion->setDescuento($row["Descuento"]);
    
                        
                        array_push($funcionList, $Funcion);
                    }*/
                    return true;
                }
            }catch (PDOException $e){
                throw new PDOException($e->getMessage());
                }
            
            return false;
        }
        public function CheckExistenciaCine_aux($idPelicula,$dia,$cine){

            $Funcion = new Funcion();
            try
            {
                $query = "  SELECT  f.Id_Funcion 
                            FROM funciones as f
                            INNER JOIN salas as s
                            ON s.Id_Sala = f.Id_Sala
                            INNER JOIN cines as c
                            ON c.Id_Cine = s.Id_Cine
                            WHERE c.Id_Cine = '$cine' AND f.Dia = '$dia' AND f.Id_Pelicula = '$idPelicula' AND f.Eliminado = '0'";

                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);  

                if(!empty($resultSet)) {
     
                    return true;
                }
            
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return false;

        }


        
        public function consultaPorIdPeliBetween($ID_Pelicula,$Fecha_Inicio,$Fecha_Fin){

           
            $funcionList = array();
            try
            {
                $query = " SELECT * FROM `funciones` WHERE `Id_Pelicula`= '$ID_Pelicula' AND `Dia` BETWEEN '$Fecha_Inicio' AND '$Fecha_Fin'";
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
                throw new PDOException($e->getMessage());
            }
            return $funcionList;
        }

        public function consultaPorIdSalaBetween($Id_sala,$Fecha_Inicio,$Fecha_Fin){
            $funcionList = array();
            try
            {
                $query = " SELECT * FROM `funciones` WHERE `Id_Sala`= '$Id_sala' AND `Dia` BETWEEN '$Fecha_Inicio' AND '$Fecha_Fin'";
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
                throw new PDOException($e->getMessage());
            }
            return $funcionList;
        }







        
    }
?>