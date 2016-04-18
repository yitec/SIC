<?php
session_start();
require_once('cnx/conexionprod.php');
conectar();
$hoy=date("Y-m-d H:i:s");

$result=mysql_query('select consecutivo_contrato from tbl_resultados where fecha_aprobacion >= CURDATE()');
while ($row=mysql_fetch_object($result)){
	echo $row->consecutivo_contrato."<br>";
	$result2=mysql_query("select COUNT(consecutivo_contrato) as total from tbl_resultados where consecutivo_contrato='".$row->consecutivo_contrato."' and estado=1");
	$row2=mysql_fetch_assoc($result2);
	echo $total_ap=$row2['total'];
	echo ' / ';
	
	
	$result2=mysql_query("select COUNT(id_contrato) as total from tbl_analisis where id_contrato='".$row->consecutivo_contrato."'");
	
	$row2=mysql_fetch_assoc($result2);
	echo $total_an=$row2['total'];
	echo "<br>";

if($total_ap==$total_an){
		echo "Entro";		
		$result3=mysql_query("select estado from tbl_contratos where consecutivo ='".$row->consecutivo_contrato."' ");
		while ($row3=mysql_fetch_object($result3)){
			if ($row3->estado!=4){
				echo "<br>Actualizando".$row->consecutivo_contrato."<br>";
				mysql_query("update tbl_contratos set fecha_terminado='".$hoy."', estado=4 where consecutivo = '".$row->consecutivo_contrato."' ");
				$texto=$row->consecutivo_contrato.' / '.$hoy;
				$bitacora='Bitacora_Pegados.txt';
				$fh=fopen($bitacora,'a')or die();
				fwrite($fh,$texto.PHP_EOL);
				fclose($fh);
		 		date_default_timezone_set('America/Denver');       
       			$dest  = 'clientes.cina@gmail.com' . ', ';
	   			$dest .= 'mizard6@yahoo.es'. ', ';
	   			$dest .= 'cina@ucr.ac.cr';
       			$head = "From: info@siccina.ucr.ac.cr<info@siccina.ucr.ac.cr>\r\n";
	   			$asunto = "Contrato Termindado = ".$_REQUEST['contrato'];
	   			$email = "info@siccina.ucr.ac.cr";
				$msg="El contrato ".$_REQUEST['contrato']." ha finalizado su proceso, por favor genere el informe";
			    if (mail($dest, $asunto, $msg, $head)) {
      			//echo 'Enviado correo';	   
       			} else {
       			//echo 'error correo';
	   			}
	   		}
	   	}
	
}



}//end while




?>