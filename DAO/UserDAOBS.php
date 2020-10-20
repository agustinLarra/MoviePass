<?php namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\User as User;
    use DAO\Connection as Connection;

    ///REVISAR POR QUE LAS FUNCIONES ACA ESTAN DISTINTAS A LAS QUE TIENE EL PROFESOR EN EL GITHUB. 

    class UserDAO
    {        
        private $connection;
        private $tableName = "users";

        public function Add(User $user){
            $query = "INSERT INTO " .$this->tableName."($firstName,$lastName,$dni,$email,$password) VALUES(:firstName,:lastName,:dni,:email,:password)";

            $parameters['firstName'] = $user->getFirstName();
            $parameters['lastName'] = $user->getLastName();
            $parameters['dni'] = $user->getDni();
            $parameters['email'] = $user->getEmail();
            $parameters['password'] = $user->getPassword();

            $this->connection->ExecuteNonQuery($query,$parameters);
        }


        public function GetAll()
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $user = new Student();
                    $user->setFirstName($row["firstName"]);
                    $user->setLastName($row["lastName"]);
                    $user->setDni($row["dni"]);
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);

                    array_push($userList, $user);
                }

                return $userList;
            }
        }





    }
?>

