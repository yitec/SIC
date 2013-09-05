<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SRC</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<style>
a {color: #CCC } 
a:hover {color: #CCC} 
</style>
</head>

<body>
<div align="center">
<div id="mainAzulFondo" style="padding: 20px; margin-top:80px; width:400px;">
<div id="mainBlancoFondo">
	
    
	
  
<?
if($_REQUEST['status']==1){
	echo '<div align="center" class="Arial18Azul">La imagen '.$_REQUEST['archivo'].' fue subida correctamente</div>';
} else{
?>
  <table><tr>
  <td><div class="Arial18Azul">
 Seleccione la imagen escaneada para subir</div>
  </td> 
  </tr>
    </table>
    <br />
  <form action="upload.php" method="post" enctype="multipart/form-data">
  <input name="archivo" type="file" size="35" />
  <input name="enviar" type="submit" value="Subir Archivo" />
  <input name="action" type="hidden" value="upload" />     
</form>
	<br />
<?
}
?>  	
</div><!--Fin cuadro Blanco-->
</div>
</div>




</body>

</html>
