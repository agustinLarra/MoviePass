<?php namespace DAO;


use Models\User as User;
use DAO\Connection as Connection;

interface IDAO {

    function add(User $user);
    function getAll();
 
}