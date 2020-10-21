<?php namespace DAO;

    require "Config/Autoload.php";
/*
    use DAO\IDAO as IDAO;
    use Models\User as User;
    use DAO\Connection as Connection;
*/
   class User extends Conexion
   {
    private $firstName;
    private $lastName;
    private $dni;
    private $email;
    private $password;
    private $conexion;

    public function __construct(){
        $this->conexion = new Conexion();
    }

    public function insertUsuario(string $firstName,string $lastName,int $dni, string $email, string $password){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dni = $dni;
        $this->email = $email;
        $this->password = $password;

        ///$sql = "INSERT INTO users(FirstName,LastName,DNI,Email,Pass) VALUES(?,?,?,?,?)";
        $sql = "INSERT INTO users(firstName,lastName,dni,email,pass) VALUES(:firstName,:lastName,:dni,:email,:pass)";
        $insert = $this->conexion->prepare($sql);
        $arrData = array($this->firstName,$this->lastName,$this->dni,$this->email,$this->password);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conexion->lastInsertIad();
        return $idInsert;
    }

   }
?>

