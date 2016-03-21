<?php
 $dest  = 'clientes.cina@gmail.com' . ', ';
	   echo $dest .= 'sergio.barrantes@hotmail.com, mizard6@yahoo.es, serbarrantes@gmail.com ';
       $head = "From: info@siccina.ucr.ac.cr<info@siccina.ucr.ac.cr>\r\n";
	   $asunto = "Contrato Termindado = ".$_REQUEST['contrato'];
	   $email = "info@siccina.ucr.ac.cr";
		$msg="Test de correo del cina";
		if (mail($dest, $asunto, $msg, $head)) {
      
	   echo 'Enviado correo';	   
       } else {
       echo 'error correo';
	   }

?>