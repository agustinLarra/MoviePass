<?php

    namespace DAO;

    use Models\User as User;

    class UserDAO
    {        
        private $UserList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/User.json";
        }

        public function Add(User $User)
        {
            $this->RetrieveData();
            
            array_push($this->UserList, $User);

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

            foreach($this->UserList as $User)
            { 
            
                $valuesArray["email"] = $User->getEmail();
                $valuesArray["password"] = $User->getPassword();

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
                    $User = new User();
                    $User->setEmail($valuesArray["email"]);
                    $User->setPassword($valuesArray["password"]);

                    array_push($this->UserList, $User);
                }
            }
        }
    }
?>



?>