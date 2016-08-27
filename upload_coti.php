<?php 
session_start();
require_once('cnx/conexion_compras.php');
conectarc();
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
		$destino =  "img_cotizaciones/".$archivo;
		$nombre=$archivo;
		
		$sql="select consecutivo from tbl_archivos where consecutivo='".$_SESSION['consecutivo']."'";
		$result=mysql_query($sql);
		if (mysql_num_rows($result)>=1){
			echo "Ups!!, solo se permite un archivo por pedido";
			die();
		}


		$sql="insert into tbl_archivos (consecutivo,nombre) values ('".$_SESSION['consecutivo']."','".$nombre."')";
		mysql_query($sql);
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			
			$_SESSION['nombre_archivo']=$nombre;	
			//$status = "Archivo subido: <b>".$archivo."</b>";
			header("Location:cotizacion_upload.php?status=1&archivo=".$archivo);
		} else {
			//$status = "Error al subir el archivo";
			header("Location:cotizacion_upload.php?status=error&archivo=".$archivo);
		}
	} else {
		$status = "Error al subir archivo";
	}
}

?>
