<?php namespace DAO;

    use PDOException;
    use DAO\IDAO as IDAO;
    use Models\User as User;
    use DAO\Connection as connection;

    ///REVISAR POR QUE LAS FUNCIONES ACA ESTAN DISTINTAS A LAS QUE TIENE EL PROFESOR EN EL GITHUB. 

    class UserDAO
    {        
        private $UserList = array();
        private $fileName;
        private $connection;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/User.json";
            $this->connection = null;
        }

        
        public function create($user){
           
            $sql = "INSERT INTO users(FirstName,LastName,DNI,Email,Pass) VALUES(:FirstName,:LastName,:DNI,:Email,:Pass)";
            
            $parameters['FirstName'] = $user->getFirstName();
            $parameters['LastName'] = $user->getLastName();
            $parameters['DNI'] = $user->getDni();
            $parameters['Email'] = $user->getEmail();
            $parameters['Pass'] = $user->getPassword();
            
            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            
        }

        public function getAll() {
            
            $userList = array();
            try
            {
                $query = "SELECT * FROM users;";
                $this->connection = connection::GetInstance();    ///aca esta.
                $resultSet = $this->connection->execute($query);  ///aca esta.

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) { ///PROBAR DE HACERLO TODO JUNTO COMO ESTA EN EL GITHUB DEL PROFESOR
                        
                        $user = new User();
                        
                        $user->setId($row["Id_User"]);
                        $user->setFirstName($row["FirstName"]);
                        $user->setLastName($row["LastName"]);
                        $user->setDNI($row["DNI"]);
                        $user->setEmail($row["Email"]);
                        $user->setPassword($row["Pass"]);
                         
                        array_push($userList, $user);
                    }
                }
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            
            return $userList;
        }

 

        public function checkEmailRegistrado($email)
        { 
            try
            {
                $query = "SELECT * FROM users WHERE Email = '$email'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);
            
                if(!empty($resultSet)) {
                    return false;
                }
                else return true;
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            
        }
        public function checkPass ($pass)
        {
            try
            {
                $query = "SELECT * FROM users WHERE Pass = '$pass'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);
            
                if(!empty($resultSet)) {
                    return false;
                }
                else return true;
            
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            

        }

        public function checkUsuario($email,$pass)
        {
            
            if(!$this->checkEmailRegistrado($email))
            {
           
                if(!$this->checkPass($pass))
                {
                        return true;
                }
                else return false;

            }
            else return false ;

        }



       /* public function getByEmail($email) {
            $this->getAll();
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
                
        }*/

        public function modify($email,$pass){
            $sql = "UPDATE users SET  email = :email , pass = :pass, WHERE email = :email";
            $parameters['email'] = $email;
            $parameters['pass'] = $pass;
            try {
                $this->Connection = Connection::getInstance();
                return $this->Connection->ExecuteNonQuery($sql, $parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            
        }

        ///********************
        ///********************
/*
        private function RetrieveData()
        {
            $this->UserList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $user = new User();
                   
                    $user->setFirstName($valuesArray["firstName"]);
                    $user->setLastName($valuesArray["lastName"]);
                    $user->setDni($valuesArray["dni"]);
                    $user->setEmail($valuesArray["email"]);
                    $user->setPassword($valuesArray["password"]);

                    array_push($this->UserList, $user);
                }
            }
        }
    */
  


        /* ELIMINAR PERSONA
        public function Delete($email){
            if($_SESSION['loggedUser']->getEmail() === $email){
                session_destroy();
                header("location: index.php");
            }
            $this->retrieveData();
            $newList = array();
            foreach ($this->usersList as $user) {
                if($user->getEmail() != $email){
                    array_push($newList, $user);
                }
            }
    
            $this->usersList = $newList;
            $this->saveData();
        }
        */

        
    }
?>



