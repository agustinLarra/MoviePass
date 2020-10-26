<?php
	use Models\Sala as Sala;
    use DAO\SalaDAO as SalaDAO;

    $salaDao = new SalaDAO();
    $listaSalas = $salaDao->GetByIdCine($_GET['id_cine']);

	$consulta = "SELECT * FROM paises";
	$ejecutarConsulta = mysqli_query($enlace, $consulta);
	
	echo'<select name="select" id="select">';
           foreach($listaSalas as $value){      
                echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
           }
	echo'</select>';
?>