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

use Librerias\PHPMailer\PHPMailer\PHPMailer;
use Librerias\PHPMailer\PHPMailer\Exception;
use Librerias\phpqrcode\bindings\tcpdf\qrcode as QRcode;

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

        $userDAO = $this->pdo->getByEmail($email);
        
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setDni($dni);
        $user->setEmail($email);
        $user->setPassword($password);
       
        $homeController = new HomeController();
        $validation = false;
        /*
        if ($user->getFirstName() != '' && $user->getLastName() != '' && $user->getDni() < 0 && $user->getDni() != '' && $user->getPassword() != '') {
            */
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validation = true;
            }
        /*}*/
        
		if($userDAO == null)
		{
            
            if($validation){
                
                //ACA VA LA PAGINA DIRECTAMENTE
                $this->pdo->create($user);
                $homeController->viewCartelera();
                	
            }
            
        }else
        {
            echo "<script>alert('The email entered already exists, please enter another');";
            echo "</script>";
            $homeController->viewSignUp();
        }
	}

        
	public function getByEmail($email){
		$userDAO = $this->pdo->getByEmail($email);
    }
    
    public function login($email,$pass){
        
        $userDAO = new UserDAO();
        $userList = $userDAO->getAll();
        $loggedUser = NULL;
        $homeController = new HomeController();

        foreach($userList as $value){
            if($email == $value->getEmail()){
                if($pass == $value->getPassword()){
                    
                    $loggedUser = $value;
                    //session_start();
                    $_SESSION['userLog'] = $loggedUser;
                    
                    $homeController->viewCartelera();
                    
                }
                else{
                    $homeController->viewLogin();
                }
            }
            else{
                $homeController->viewLogin();
            }
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

        // AGARRO LOS DATOS Y CALCULO EL TOTAL
        $idFuncion =  $_POST['funcion'];
        $funcionDao = new FuncionDAO();
        $funcion = $funcionDao->getById($idFuncion);
        $cantidadEntradas =  $_POST['cantidadEntradas'];
        $total = $cantidadEntradas * $funcion->getClassSala()->getPrecio();
        $descuento = 0;

        if($funcion->getDescuento() == 1){

            $descuento = (26/100) * $total;
            $total -=  $descuento;
        }


        // GUARDO LOS DATOS EN SESSION
        if(!isset($_SESSION)){
            session_start(); 
        } 

        $_SESSION['total'] = $total;
        $_SESSION['descuento'] =  $descuento;
        $_SESSION['cantidadEntradas'] = $cantidadEntradas;
        $_SESSION['idFuncion'] = $idFuncion;
        $_SESSION['userLog'] = 1;

        if(isset($_SESSION['userLog'])){

           $homeController = new HomeController();
           $homeController->formularioTarjeta();

        }else{

        }


    }





    public function finalizarCompra(){

        $numeroTarjeta = $_POST['numeroTarjeta'];
        $nombre = $_POST['nombre'];
        //$mes = $_POST['mes'];  FALTA COMPROBACION
        //$year = $_POST['year'];
        $ccv = $_POST['ccv'];

        echo '<script>alert("Tarjera aprobada");</script>';

        //Agarro todos los datos 
        $total = $_SESSION['total'];
        $cantidadEntradas = $_SESSION['cantidadEntradas'];
        $idFuncion = $_SESSION['idFuncion'] ;
        $idUser = $_SESSION['userLog'];

        // Guardo la compra en la base de datos
        $compra = new Compra();
        $compra->setNumeroTarjeta($numeroTarjeta);
        $compra->setIdUser($idUser);
        $compra->setCantidadEntradas($cantidadEntradas);
        $compra->setTotal($total);
        $compraDAO = new CompraDAO();
        $compraDAO->Add($compra);
        $Ultimacompra = $compraDAO->getUltimaRow();

        //Ahora hay que generar la entrada
        for( $i=1; $i <= $cantidadEntradas ; $i++ ){
            
            $entrada = new Entrada();
            $entrada->setQR(345);
            $entrada->setIdCompra($Ultimacompra->getId());
            $entrada->setIdFuncion($idFuncion);
            $entradaDAO = new EntradaDAO();
            $entradaDAO->Add($entrada);
        }
      
       // $userDAO = new UserDAO();
       // $user = $userDAO->getById($idUser);

       $qr = $this->generarQr(31231); // Id Entrada

        $this->enviarMail($numeroTarjeta,$cantidadEntradas,$total);
        
        
        $homeController = new HomeController();
        $homeController->viewFinCompra();

    }

    private function enviarMail($numeroTarjeta,$cantidadEntradas,$total){

        $mail = new PHPMailer(true);

        try {
            //Server settings
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
            $mail->addAddress('agustinlarra98@gmail.com');     // Add a recipient
                    // Name is optional
        
            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true); 
                                             // Set email format to HTML
            $mail->Subject = 'Entradas cine Movie Pass';
            //Contenido
            $fecha= time();
            $fechaFormato = date("j/n/Y",$fecha);
            $cuerpo = "--=C=T=E=C=\r\n";
            $cuerpo .= "Content-type: text/plain";
            $cuerpo .= "charset=utf-8\r\n";
            $cuerpo .= "Content-Transfer-Encoding: 8bit\r\n";
            $cuerpo .= "\r\n"; // línea vacía
            $cuerpo .= "Correo enviado por: Movie Pass ";
            $cuerpo .= " con fecha: " . $fechaFormato;
            $cuerpo .= "Email: " . $MI_MAIL;
            $cuerpo .= "Mensaje: Aqui estan los tickets de las entradas que acaba de comprar en nuestra web";
            $cuerpo .= "\r\n";// línea vacía
        
            // -> segunda parte del mensaje (archivo adjunto)
                //    -> encabezado de la parte
            $cuerpo .= "--=C=T=E=C=\r\n";
            $cuerpo .= "Content-Type: application/octet-stream; ";
            $cuerpo .= "name=" . $nameFile . "\r\n";
            $cuerpo .= "Content-Transfer-Encoding: base64\r\n";
            $cuerpo .= "Content-Disposition: attachment; ";
            $cuerpo .= "filename=" . $nameFile . "\r\n";
            $cuerpo .= "\r\n"; // línea vacía


            $mail->Body = $cuerpo; 
            $mail->send();
        
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
    }

    public function generarQr($idEntrada){
        
	
	    //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = 'Views/img/qrs';

	    //Si no existe la carpeta la creamos
	    if (!file_exists($dir)){
            mkdir($dir,0777);
        }
        
            //Declaramos la ruta y nombre del archivo a generar
            $filename = $dir.'test.png';
    
            //Parametros de Condiguración
        
        $tamaño = 10; //Tamaño de Pixel
        $level = 'M'; //Precisión Baja
        $framSize = 3; //Tamaño en blanco
        $contenido = $idEntrada; //Texto
        
            //Enviamos los parametros a la Función para generar código QR 
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
        
            //Mostramos la imagen generada
      //  echo '<img src="'.$dir.basename($filename).'" /><hr/>';  
        return $dir.basename($filename);

    }

    public function Ejemplomail(){

        ini_set("SMTP","mail.escuelactec.com");
        ini_set("smtp_port","localhost");
        ini_set('sendmail_from', 'info@escuelactec.com');
        
        $name = strip_tags($_POST["nombre"]);
        $apellido = strip_tags( $_POST["apellidos"]);
        $mail = strip_tags($_POST["correo"]);
        $mensaje = strip_tags($_POST["comentario"]);
    
        $nameFile = $_FILES["archivo"]["name"];
        $sizeFile= $_FILES["archivo"]["size"];
        $typeFile= $_FILES["archivo"]["type"];
        $tempFile= $_FILES["archivo"]["tmp_name"];
    

            
        echo "Nombre: " . $nameFile . "<br>";
        echo "Tamaño: " . $sizeFile . "<br>";
        echo "Tipo: ". $typeFile . "<br>";
        echo "Temporal: " . $tempFile . "<br>";
    
    
        $correoDestino = "info@escuelactec.com";
        
        //asunto del correo
        $asunto = "Enviado por " . $name . " ". $apellido;
    
         // -> mensaje en formato Multipart MIME
        $cabecera = "MIME-VERSION: 1.0\r\n";
        $cabecera .= "Content-type: multipart/mixed;";
        $cabecera .="boundary=\"=C=T=E=C=\"\r\n";
        $cabecera .= "From: {$mail}";
    
        //Primera parte del mensaje (texto plano)
        //    -> encabezado de la parte
        $fecha= time();
        $fechaFormato = date("j/n/Y",$fecha);
        $cuerpo = "--=C=T=E=C=\r\n";
        $cuerpo .= "Content-type: text/plain";
        $cuerpo .= "charset=utf-8\r\n";
        $cuerpo .= "Content-Transfer-Encoding: 8bit\r\n";
        $cuerpo .= "\r\n"; // línea vacía
        $cuerpo .= "Correo enviado por: Movie Pass ";
        $cuerpo .= " con fecha: " . $fechaFormato;
        $cuerpo .= "Email: " . $MI_MAIL;
        $cuerpo .= "Mensaje: " . $mensaje;
        $cuerpo .= "\r\n";// línea vacía
    
         // -> segunda parte del mensaje (archivo adjunto)
            //    -> encabezado de la parte
        $cuerpo .= "--=C=T=E=C=\r\n";
        $cuerpo .= "Content-Type: application/octet-stream; ";
        $cuerpo .= "name=" . $nameFile . "\r\n";
        $cuerpo .= "Content-Transfer-Encoding: base64\r\n";
        $cuerpo .= "Content-Disposition: attachment; ";
        $cuerpo .= "filename=" . $nameFile . "\r\n";
        $cuerpo .= "\r\n"; // línea vacía
    
        $fp = fopen($tempFile, "rb");
        $file = fread($fp, $sizeFile);
        $file = chunk_split(base64_encode($file));
    
        //    -> lectura del archivo correspondiente al archivo adjunto
        //$datos = file_get_contents($archivo);
        
        //    -> codificación y fragmentación de los datos
        //$datos = chunk_split(base64_encode($datos));
        //    -> datos de la parte (integración en el mensaje)
        //$mensaje .= "$datos\r\n";
        $cuerpo .= "$file\r\n";
        $cuerpo .= "\r\n"; // línea vacía
        // Delimitador de final del mensaje.
        $cuerpo .= "--=C=T=E=C=--\r\n";
        // Envío del mensaje.
        // $ok = mail($destinatarios,$asunto,$mensaje,$encabezados);
        echo 'Nota: la línea de código que permite enviar el correo está en el comentario.<br />';
    
        //Enviar el correo
        if(mail($correoDestino, $asunto, $cuerpo, $cabecera)){
            echo "Correo enviado";
        }else{
            echo "Error de envio";
        }
    }

    private function numeroTarjetaValido( $numeroTarjeta ){

        //Paso el numero (int) a un array
        $array  = array_map('intval', str_split($numeroTarjeta));
        // Doy vuelta el arreglo
        $arrayInvertido = array_reverse($array);
        echo 'array original';
        var_dump($array);
        echo '<br><br><br>array invertido';
        var_dump($arrayInvertido);

        // Partiendo de la posicion 1 tengo que agarrar a todos los inpares
        for($i=1; $i < 19; $i++){
            //agarro los impares
            if (!$i%2==0){
                //Multiplico el numero por 2
               $multiplicacion =  $arrayInvertido[$i] * 2;
               // Si es mayor que 10 sumo los 2 digitos
               if($multiplicacion >= 10){
                $mayorDeDiezArray  = array_map('intval', str_split($multiplicacion));
                $numeroNuevo =   $mayorDeDiezArray[0] +  $mayorDeDiezArray[1];
                $arrayInvertido[$i] = $numeroNuevo;
               }else{ // si es menor, solo lo remplazo
                    $arrayInvertido[$i] = $multiplicacion;
               }
            } 

        }

        echo '<br><br>array invertido MODIFICADO';
        var_dump($arrayInvertido);


    }






}


