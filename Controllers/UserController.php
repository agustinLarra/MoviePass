<?php 

namespace Controllers;
use Models\User as User;
use Models\Compra as Compra;
use Models\Entrada as Entrada;
use DAO\UserDAO as UserDAO;
use DAO\CompraDAO as CompraDAO;
use DAO\EntradaDAO as EntradaDAO;
use DAO\FuncionDAO as FuncionDAO;
use Controllers\HomeController as HomeController;
use DAO\DescuentoDAO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use QRcode;

require 'Librerias/PHPMailer/Exception.php';
require 'Librerias/PHPMailer/PHPMailer.php';
require 'Librerias/PHPMailer/SMTP.php';
require "Librerias/phpqrcode/qrlib.php";   


class UserController{
    
    private $pdo;

	function __construct()
	{

		$this->pdo = new UserDAO();

    }

	public function signUp ($firstName, $lastName, $dni, $email,$password){


        $homeController = new HomeController();

        if($this->pdo->checkEmailRegistrado($email))
        {
        
            $user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setDni($dni);
            $user->setEmail($email);
            $user->setPassword($password);
        
         
            $validation = false;
            /*
            if ($user->getFirstName() != '' && $user->getLastName() != '' && $user->getDni() < 0 && $user->getDni() != '' && $user->getPassword() != '') {
                */
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $validation = true;
                }
            /*}*/
            
              if($validation){
                
                  //ACA VA LA PAGINA DIRECTAMENTE
                  $this->pdo->create($user);
                 //INICIA SESSION ANTES
                 if(!isset($_SESSION['userLog']))
                  {
                     $_SESSION['userLog'] = $user;
                     $homeController = new HomeController();
                     $homeController->viewCartelera();  
                }

                	
                }
            
        }else
        {
            echo "<script>alert('The email entered already exists, please enter another');";
            echo "</script>";
            $homeController->viewSignUp();
        }
	}

        
	/*public function getByEmail($email){
		$userDAO = $this->pdo->getByEmail($email);
    }*/
    
    public function login($email,$pass){

        $homeController = new HomeController();

        $userDAO = new UserDAO();
        try{
                $user = $userDAO->checkUsuario($email,$pass);
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }

       
        if(isset($user))
        {    
             if($user->getEmail() =="admin@gmail.com" && $user->getPassword() =="admin123")
             {
                $_SESSION['userLog'] = $user;
                $homeController->viewHomeAdmin();
             }
             else{
                  $_SESSION['userLog'] = $user;
                  $homeController->viewCartelera();
             }

        }
        else 
        {
            echo '<script>alert("Datos Incorrectos, vuelva a intentar");</script>';

           $homeController->viewLogin();
        }
        
    }

    public function logout(){

        $homeController = new HomeController();

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        unset($_SESSION['userLog']);
        $homeController->Index();
    }


// ##------------------------- Compra ----------------------- ##



    public function funcionElegida(){

        $descuento_bd = new DescuentoDAO();

        if(!isset($_SESSION['userLog'])){

            echo '<script>alert("Antes de comprar una entrada debe iniciar sesion");</script>';
            $homeController = new HomeController();
            $homeController->viewLogin();

        }else{

                // AGARRO LOS DATOS Y CALCULO EL TOTAL
            $idFuncion =  $_POST['funcion'];
            $funcionDao = new FuncionDAO();

            try{
                $funcion = $funcionDao->getById($idFuncion);   
            }catch(Exception $e){
                throw new Exception($e->get_message());
            }
            
            $cantidadEntradas =  $_POST['cantidadEntradas'];
            $total = $cantidadEntradas * $funcion->getClassSala()->getPrecio();
            $descuento = 0;

            if($funcion->getDescuento() > 1){

                //$descuento = (26/100) * $total;
                $descuento = (($descuento_bd->getPorcentajeBtId($funcion->getDescuento()))/100) * $total;
                $total -=  $descuento;
            }


            // GUARDO LOS DATOS EN SESSION
            if(!isset($_SESSION)){
                session_start(); 
            } 

            $_SESSION['NombreCine'] = $_POST['NombreCine'];
            $_SESSION['CalleCine'] = $_POST['CalleCine'];
            $_SESSION['NumeroCine'] = $_POST['NumeroCine'];
            $_SESSION['total'] = $total;
            $_SESSION['descuento'] =  $descuento;
            $_SESSION['cantidadEntradas'] = $cantidadEntradas;
            $_SESSION['Funcion'] = $funcion;
            $_SESSION['idPeli'] = $funcion->getIdPelicula();
            $_SESSION['tituloPelicula'] = $funcion->getTitlePelicula();

    
            $homeController = new HomeController();
            $homeController->formularioTarjeta();

        }

    }





    public function finalizarCompra($NumeroTarjeta, $nombre, $mes, $year, $ccv){

        $numeroTarjeta = $NumeroTarjeta;
        $nombre = $_POST['nombre'];
        //$mes = $_POST['mes'];  FALTA COMPROBACION
        //$year = $_POST['year'];
        $ccv = $_POST['ccv'];




            echo '<script>alert("Tarjera aprobada");</script>';

            //Agarro todos los datos 
            $total = $_SESSION['total'];
            $cantidadEntradas = $_SESSION['cantidadEntradas'];
            $Funcion = $_SESSION['Funcion'];
            $tituloPelicula = $_SESSION['tituloPelicula'];
            $user = $_SESSION['userLog'];
            if(isset($_SESSION['email_facebook']))
            {$usuario_fb = new UserDAO();
            $fb_user = $usuario_fb->getByEmail($_SESSION['email_facebook']);

            if($fb_user == null){
            $usuario_fb->create_facebook($_SESSION['email_facebook']);
            }


           $user = $usuario_fb->getByEmail($_SESSION['email_facebook']);

        }


            // Guardo la compra en la base de datos
            $compra = new Compra();
            $compra->setNumeroTarjeta($numeroTarjeta);
            $compra->setIdUser($user->getId());
            $compra->setCantidadEntradas($cantidadEntradas);
            $compra->setTotal($total);
            $compraDAO = new CompraDAO();
            
            try{
                $compraDAO->Add($compra);
                $Ultimacompra = $compraDAO->getUltimaRow();   
            }catch(Exception $e){
                throw new Exception($e->get_message());
            }
            
            $entrada = new Entrada();
            //Ahora hay que generar la entrada
            for( $i=1; $i <= $cantidadEntradas ; $i++ ){
                
                $entrada->setQR($Ultimacompra->getId()  . "100"+$i);
                $entrada->setIdCompra($Ultimacompra->getId());
                $entrada->setIdFuncion($Funcion->getId());
                $entradaDAO = new EntradaDAO();

                $qr =$this->generarQr($entrada->getQR()); // Id Entrada

                $this->enviarEmail($user->getEmail(),$total,$cantidadEntradas,$tituloPelicula,$Funcion,$qr);

                try{
                $entradaDAO->Add($entrada);
                }catch(Exception $e){
                    throw new Exception($e->get_message());
                }
                
            }
        
            $homeController = new HomeController();
            $homeController->viewFinCompra();

    

    }

    public function generarQr($idEntrada){
        
	
	    //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = 'Views/img/qrs/';

	    //Si no existe la carpeta la creamos
	    if (!file_exists($dir)){
            mkdir($dir,0777);
        }
        
            //Declaramos la ruta y nombre del archivo a generar
            $filename =$dir.uniqid() . ".png";
    
            //Parametros de Condiguración
        
        $tamaño = 10; //Tamaño de Pixel
        $level = 'M'; //Precisión Baja
        $framSize = 3; //Tamaño en blanco
        $contenido = $idEntrada; //Texto
        
            //Enviamos los parametros a la Función para generar código QR 
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
        

        return $dir.basename($filename);

    }

    public function enviarEmail($email, $total, $cantidadEntradas,$tituloPelicula,$Funcion,$directorio_qr){
   
       // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $fecha= time();
        $fechaFormato = date("j/n/Y",$fecha);

        try {
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'moviepassrsml@gmail.com';                     // SMTP username
            $mail->Password   = 'Moviepass2020';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

             //Recipients
             $MI_MAIL = "moviepassrsml@gmail.com";
             $mail->setFrom($MI_MAIL, 'Movie Pass');
             $mail->addAddress($email);     // Add a recipient

            // Attachments
          //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
          //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
          $mail->addEmbeddedImage( ROOT  .$directorio_qr , 'qrcode');    // Optional nameC:\wamp64\www\MoviePass\Views\img\qrs


            $dia = $Funcion->getDia();
            $hora = $Funcion->getHora();
            $nombreCine = $Funcion->getClassCine()->getNombre();
            $direccion = $Funcion->getClassCine()->getCalle() ." ". $Funcion->getClassCine()->getNumero();
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Compra de entradas en Movie Pass'.$fechaFormato ;
            $mail->Body    = 'Usted ha comprado '.$cantidadEntradas." entradas, con un total de: $".$total."<br> .Para ver la pelicula:".$tituloPelicula."<br>" 
            ."La funcion de la pelicula es el dia: ".$dia." a las: ".$hora." horas<br>. Cine: ".$nombreCine ." (Direccion: ".$direccion.")".'<br><img src="cid:qrcode" />';

            $mail->send();
          
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function numeroTarjetaValido( $numeroTarjeta ){

        //Paso el numero (int) a un array
        //$array  = array_map('intval', str_split($numeroTarjeta));
        
        $array = explode(",",$numeroTarjeta);
        unset($array[4],$array[9],$array[14]);
        // Doy vuelta el arreglo
        $arrayInvertido = array_reverse($array);
       

        // Partiendo de la posicion 1 tengo que agarrar a todos los inpares
        for($i=0; $i <= 15; $i++){
            //agarro los pares
            if ($i%2==0){
                //Multiplico el numero por 2
               $multiplicacion =  $arrayInvertido[$i] * 2;
               echo"<br><br>Posicion: " . $i. "  Multiplicacion: ".$multiplicacion;
               // Si es mayor que 10 sumo los 2 digitos
               if($multiplicacion >= 10){
                $mayorDeDiezArray  = array_map('intval', str_split($multiplicacion));
                $numeroNuevo =   $mayorDeDiezArray[0] +  $mayorDeDiezArray[1];
                $arrayInvertido[$i] = $numeroNuevo;
                echo"<br><br>Numero nuevo: " . $numeroNuevo;
               }else{ // si es menor, solo lo remplazo
                    $arrayInvertido[$i] = $multiplicacion;
               }
            } 
        }

        $resultado = 0;
        for($i=0; $i < 15; $i++){
            $resultado+= $arrayInvertido[$i];
        }

        if ($resultado%2 == 0){
            return true;
        }else{
            return false;
        }

    }

    public function getEntradasAdquiridas($idUser){

        $compraDAO = new CompraDAO();    
        $entradaDAO = new EntradaDAO(); 
        $funcionDao = new FuncionDAO(); 
           
      // agarro las compras que hizo
      // agarro las entradas vinculadas a esa compra
      // con la entrada agarro la funcion
      // con la funcion agarro la peli
        // En div se va a guardar toda la informacion que va a tener una sola vista
        $div = array();
        // Lista de divs esta por si el user vio mas de una funcion
        $listaDeDivs = array();

        try{
             // busco todas las compras que haya hecho este user
            $compraList = $compraDAO->getByIdUser($idUser);

            //por cada compra que hizo
            foreach($compraList as $compra){

                // ya puedo decir cuantas entradas compro y cual fue el costo
                $div['EntradasAdquiridas'] = $compra->getCantidadEntradas();
                $div['Total'] = $compra->getTotal();

                //busco las entradas que sean de esa compra
                $entrada = $entradaDAO->getByIdCompra($compra->getId());
                $funcion = $funcionDao->getFuncionCompleta( $entrada->getIdFuncion() );
                //Esto es para que sea mas facil de leer
                //Al div le agrego los datos que acabo de sacar
                $div['PosterPath'] =  $funcion->getPosterPelicula();
                $div['Title'] =  $funcion->getTitlePelicula();
                $div['NombreCine'] =  $funcion->getNombreCine();
                $div['NombreSala'] =  $funcion->getNombreSala();
                $div['Dia'] =  $funcion->getDia();
                $div['Hora'] =  $funcion->getHora();

                array_push($listaDeDivs, $div);

        }  
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        

        return  $listaDeDivs;

    }

   


    public function  getEntradasAdquiridasPorDia($idUser,$fecha){

        $compraDAO = new CompraDAO();    
        $entradaDAO = new EntradaDAO(); 
        $funcionDao = new FuncionDAO(); 
           
      // agarro las compras que hizo
      // agarro las entradas vinculadas a esa compra
      // con la entrada agarro la funcion
      // con la funcion agarro la peli
        // En div se va a guardar toda la informacion que va a tener una sola vista
        $div = array();
        // Lista de divs esta por si el user vio mas de una funcion
        $listaDeDivs = array();

        try{
             // busco todas las compras que haya hecho este user
            $compraList = $compraDAO->getByIdUser($idUser);

            //por cada compra que hizo
            foreach($compraList as $compra){

                // ya puedo decir cuantas entradas compro y cual fue el costo
                $div['EntradasAdquiridas'] = $compra->getCantidadEntradas();
                $div['Total'] = $compra->getTotal();

                //busco las entradas que sean de esa compra
                $entrada = $entradaDAO->getByIdCompra($compra->getId());
                $funcion = $funcionDao->getFuncionCompleta( $entrada->getIdFuncion() );
                //Esto es para que sea mas facil de leer
                //Al div le agrego los datos que acabo de sacar
                if(($funcion->getDia())==$fecha){
                    $div['PosterPath'] =  $funcion->getPosterPelicula();
                    $div['Title'] =  $funcion->getTitlePelicula();
                    $div['NombreCine'] =  $funcion->getNombreCine();
                    $div['NombreSala'] =  $funcion->getNombreSala();
                    $div['Dia'] =  $funcion->getDia();
                    $div['Hora'] =  $funcion->getHora();

                    array_push($listaDeDivs, $div);
                }

        }  
        }catch(Exception $e){
               throw new Exception($e->get_message());
        }
        

        return  $listaDeDivs;

    }






}


