<?php
session_start();
error_reporting(E_all);
require_once('../cnx/conexion.php');
conectar();

echo $result=mysql_query('select consecutivo_contrato from tbl_resultados where fecha_aprobacion >= CURDATE()');
while ($row=mysql_fetch_object($result)){
	echo $row->consecutivo_contrato."<br>";
	$result3=mysql_query("select COUNT(consecutivo_contrato) as total from tbl_resultados where consecutivo_contrato='".$row->consecutivo_contrato."' and estado=1");
	$row3=mysql_fetch_assoc($result3);
	echo $total_ap=$row3['total'];
	
	
	$result3=mysql_query("select COUNT(id_contrato) as total from tbl_analisis where id_contrato='".$row->consecutivo_contrato."'");
	
	$row3=mysql_fetch_assoc($result3);
	echo $total_an=$row3['total'];




}//end while



$result2=mysql_query("update tbl_contratos set fecha_terminado='".$hoy."', estado='"."4"."' where consecutivo='".$_REQUEST['contrato']."'");
		 		date_default_timezone_set('America/Denver');
       //$dest = "kmadrigal@feednet.ucr.ac.cr";
       //$dest  = 'kmadrigal@feednet.ucr.ac.cr' . ', ';
       $dest  = 'clientes.cina@gmail.com' . ', ';
	   $dest .= 'sergio.barrantes@hotmail.com';
       $head = "From: info@siccina.ucr.ac.cr<info@siccina.ucr.ac.cr>\r\n";
	   $asunto = "Contrato Termindado = ".$_REQUEST['contrato'];
	   $email = "info@siccina.ucr.ac.cr";
		$msg="El contrato ".$_REQUEST['contrato']." ha finalizado su proceso, por favor genere el informe";
			   if (mail($dest, $asunto, $msg, $head)) {
      
	   //echo 'Enviado correo';	   
       } else {
       //echo 'error correo';
	   }
?>