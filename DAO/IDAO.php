<?php namespace DAO;


use Models\User as User;
use DAO\connection as connection;

interface IDAO {

    function add();
    function getAll();
 
}