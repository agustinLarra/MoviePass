<?php
    namespace Controllers;

    use Models\User as User;

    interface UserRepository
    {
        function Add(User $User);
        function GetAll();
    }
?>