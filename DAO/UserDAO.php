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
      

        public function checkUsuario($email,$pass)
        {
            $user = new User();
            try
            {
                $query = "SELECT * FROM users WHERE Pass = '$pass' AND Email = '$email'";
                $this->connection = connection::GetInstance();   
                $resultSet = $this->connection->execute($query);
                
                if(!empty($resultSet)) {
                    foreach($resultSet as $row) { ///PROBAR DE HACERLO TODO JUNTO COMO ESTA EN EL GITHUB DEL PROFESOR
                        
                      
                        $user->setId($row["Id_User"]);
                        $user->setFirstName($row["FirstName"]);
                        $user->setLastName($row["LastName"]);
                        $user->setDNI($row["DNI"]);
                        $user->setEmail($row["Email"]);
                        $user->setPassword($row["Pass"]);
                         
                    }
                }
                
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            
            return $user;

        }

        function checkUserFacebook($userData = array()){
            try{
                if(!empty($userData)){
                    // Revisar si la información de usuario ya existe
                    $firstName = $userData['first_name'];
                    $lastName = $userData['last_name'];

                    $query = "SELECT * FROM users WHERE  FirstName='Aguustiin 'AND LastName='Larra'  ";
                    $this->connection = connection::GetInstance();   
                    $prevResult = $this->connection->execute($query);

                    if($prevResult->num_rows < 0){
        
                        $sql = "INSERT INTO users(FirstName,LastName) VALUES(:FirstName,:LastName)";
                
                        $parameters['FirstName'] =  $userData['first_name'];
                        $parameters['LastName'] = $userData['last_name'];
                    //    $parameters['Email'] = $userData['email'];
                    // $parameters['Pass'] = $user->getPassword();

                        $this->connection = connection::GetInstance();
                        $this->connection->ExecuteNonQuery($sql,$parameters);
                                
                    }
                    // Tomar la información de la BD

                    $query = "SELECT * FROM users WHERE  FirstName='$firstName' AND LastName='lastName' ";
                    $this->connection = connection::GetInstance();   
                    $result = $this->connection->execute($query);
                    $userData = $result->fetch_assoc();
                }
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            
            // return
            return $userData;
        }





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

    
        public function create_facebook($email)
        {
            $sql = "INSERT INTO users(Email) VALUES(:Email)";

            $parameters['Email'] = $email;

            try{
                $this->connection = connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }

        }


        public function getByEmail($email)
        {
            $user = new User();
            try{
                $query = "SELECT * FROM users WHERE Email = '$email'";
                $this->connection = connection::GetInstance();
                $resultSet = $this->connection->execute($query);

                if(!empty($resultSet)) {
                    foreach($resultSet as $row) { ///PROBAR DE HACERLO TODO JUNTO COMO ESTA EN EL GITHUB DEL PROFESOR

                       
                        $user->setId($row["Id_User"]);
                        $user->setFirstName($row["FirstName"]);
                        $user->setLastName($row["LastName"]);
                        $user->setDNI($row["DNI"]);
                        $user->setEmail($row["Email"]);
                        $user->setPassword($row["Pass"]);

                    }
                }

            }catch(PDOException $e){
                throw new PDOException($e->getMessage());
            }
            return $user;
        }
        
    }
?>



