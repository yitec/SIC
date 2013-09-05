<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?
date_default_timezone_set('America/Denver');
       $dest = "sbarrantes@yitec.net,sergio.barrantes@hotmail.com,mizard6@yahoo.es";
       $head = "From: info@siccina.ucr.ac.cr<info@siccina.ucr.ac.cr>\r\n";
	   $asunto = "Articulo en existencia minima = ".$_REQUEST['cmb_nombrei'];
	   $email = "info@siccina.ucr.ac.cr";
		$msg="El articulo  ".$_REQUEST['cmb_nombrei']." esta dentro del rango de existencia minima.";
		mail($dest, $asunto, $msg, $head);
			  /* if (mail($dest, $asunto, $msg, $head)) {
      
	   echo 'Enviado correo';	   
       } else {
       echo 'error correo';
	   }*/
?>
</body>
</html>