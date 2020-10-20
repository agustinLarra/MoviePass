<?php namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\User as User;
    use DAO\Connection as Connection;

    ///REVISAR POR QUE LAS FUNCIONES ACA ESTAN DISTINTAS A LAS QUE TIENE EL PROFESOR EN EL GITHUB. 

    class UserDAO
    {        
        private $UserList = array();
        private $fileName;
        private $connection;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/User.json";
        }

        public function Add(User $user)
        {
            $this->RetrieveData();
            
            array_push($this->UserList, $user);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->UserList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->UserList as $user)
            { 
            
                $valuesArray["firstName"] = $user->getFirstName();
                $valuesArray["lastName"] = $user->getLastName();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

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
        
        public function getByEmail($email) {
            $this->RetrieveData();
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
            }*/
                
        }

        /*
        public function create($user) {
            $sql = "INSERT INTO Users(firstName,lastName,dni,email,pass) VALUES(:firstName,:lastName,:dni,:email,:pass)";
            $parameters['firstName'] = $user->getFirstName();
            $parameters['lastName'] = $user->getLastName();
            $parameters['dni'] = $user->getDni();
            $parameters['email'] = $user->getEmail();
            $parameters['password'] = $user->getPassword();
            
            try{
                this->connection = Connection::getInstance();
            }
            return $this->connection->ExecuteNonQuery($sql,$parameters);
        }
        */
    }
?>



