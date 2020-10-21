<?php  

    require "Config/Autoload.php";

    class Conexion{
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $db = "db_moviepass";
        private $conect;

    public function __construct(){
        ///aca se puede implementar a CONFIG e implementar las variables definidas en vez de hacer this->host

        $connectionString = "mysql:host=".$this->host.";dbname=".$this->db;
        try{
            $this->conect = new PDO($connectionString,$this->user,$this->password);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            echo "Conexion Correcta";

        } catch (Exception $e){
            $this->conect = "Error de conexion";
            echo "ERROR " . $e->getMessage();
            }
        }
    }

    $conect = new Conexion();

?>