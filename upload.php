<?php 
session_start();
$status = "";
$total_sms=0;

if ($_POST["action"] == "upload") {
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$destino =  "img_impuestos/".$archivo;
		$nombre=$archivo;

		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			
			$_SESSION['nombre_archivo']=$nombre;	
			//$status = "Archivo subido: <b>".$archivo."</b>";
			header("Location:archivo_upload.php?status=1&archivo=".$archivo);
		} else {
			//$status = "Error al subir el archivo";
			header("Location:archivo_upload.php?status=error&archivo=".$archivo);
		}
	} else {
		$status = "Error al subir archivo";
	}
}

?>
