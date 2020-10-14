<?php
    require_once("Config\Autoload.php");

    use repositories\actionsRepositories as actionsRepositories;
    use Models\client as client;

    if($_POST)
    {
        $id = $_POST[$id];
        $firstName = $_POST[$firstName];
        $lastName = $_POST[$lastName];

        $client = new client();
        $client->setId($id);
        $client->setFirstName($firstName);
        $client->setLastName($lastName);
        $client->setEmail($email);
        $client->setPassword($password);
        $client->setDni($dni);
        $client->setUserName($userName);

       $actionsRepositories = new actionsRepositories();
       
       $actionsRepositories->Add($client);
        
    }

    header("location:index.php");
?>