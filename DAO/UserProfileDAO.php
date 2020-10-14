<?php namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\UserProfile as UserProfile;
    use Models\User as User;

    class UserProfileDAO implements IDAO
    {
        private $userProfileList = array();

        public function Add($userProfile){
            $this->retrieveData();
            array_push($this->userProfileList, $userProfile);
            $this->saveData();
        }
    
        public function GetAll(){
            $this->retrieveData();
            return $this->userProfileList;
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

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userProfileList as $userProfile)
            {
                $valuesArray["firstName"] = $userProfile->getFirstName();
                $valuesArray["lastName"] = $userProfile->getLastName();
                $valuesArray["dni"] = $userProfile->getDni();
                $valuesArray["email"] = $userProfile->getEmail();
                $valuesArray["password"] = $userProfile->getPassword();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('data/usersProfile.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userProfileList = array();

            if(file_exists('data/usersProfile.json'))
            {
                $jsonContent = file_get_contents('data/usersProfile.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $userProfile = new userProfile();
                    
                    $userProfile->setFirstName($valuesArray["firstName"]);
                    $userProfile->setLastName($valuesArray["lastName"]);
                    $userProfile->setDni($valuesArray["dni"]);
                    $userProfile->setEmail($valuesArray["email"]);
                    $userProfile->setPassword($valuesArray["password"]);
            
                    array_push($this->userProfileList, $userProfile);
                }
            }
        }
        /*
        public function getByEmail($email) {
            $this->RetrieveData();

            foreach ($this->usersList as $key => $user) {
                if($user->getEmail() == $email) {
                    return $user;
                }
            }
        }
        */
    }
?>