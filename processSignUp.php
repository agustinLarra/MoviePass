<?php
    require_once("Config\Autoload.php");

    use Controllers\UserController as UserController ;
    use Models\User as User;

    if($_POST)
    {
        //$id = $_POST[$id];
        $firstName = $_POST[$firstName];
        $lastName = $_POST[$lastName];
        $dni = $_POST[$dni];
        $email = $_POST[$email];
        $password = $_POST[$password];

        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setDni($dni);
        $user->setEmail($email);
        $user->setPassword($password);

       $userController = new UserController();
       
       $userController->create($user);
        
    }

    header("location:index.php");
?>