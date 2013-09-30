<?php
if(isset($_POST["idmarca"]))
	{
		$opciones = '<option value="0"> Elige un modelo</option>';

		$conexion= new mysqli("localhost","usuario","password","base",3306);
		$strConsulta = "select id, modelo from modelo where idmarca = ".$_POST["idmarca"];
		$result = $conexion->query($strConsulta);
		

		while( $fila = $result->fetch_array() )
		{
			$opciones.='<option value="'.$fila["id"].'">'.$fila["modelo"].'</option>';
		}

		echo $opciones;
	}
?>
