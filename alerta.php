<?
session_start();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><br />
	<div  class="Arial14blanco">SIC-CINA
    </div>

</div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div align="center"   class="contenido_gm">
<div align="center"><img src="img/logo_grande.png"  /></div>

	<div id="mainAzulFondo"  style="padding: 20px; margin-top:10px; width:400px;">
	<div id="mainBlancoFondo" >
    		<table><tr>
  <td><div class="Arial18Azul">
  <div align="center">Alerta<div> <br>El Documento Testing Vencimiento necesita revisión.</div>
  </td> 
  </tr>
    </table>
    <form action="menu.php" method="post"  enctype="multipart/form-data">
    
    <div align="center"><input name="btn_login" type="image" src="img/btn_continuar.png" /></div>
    
  </form>
  <br />
    <?
		echo '<div align="center" class="Arial14Morado">'.$_SESSION['r_login'].'</div>';
		unset($_SESSION['r_login']);
		
	?>
	
	</div>
	</div>

</div>
<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>
</td></tr></table>
</div>

</body>

</html>
