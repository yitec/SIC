<?
session_start();
require_once('cnx/session_activa.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />

<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 

<script src="includes/jquery.ui.core.js"></script>
<script src="includes/jquery.ui.widget.js"></script>
<script src="includes/jquery.ui.autocomplete.js"></script>
<script src="includes/jquery.ui.position.js"></script>

<script src="includes/Scripts_Clientes.js" type="text/javascript"></script> 



</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Clientes</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>


<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">
	<div class="Arial14Negro" style="margin-left:470px; float:left; margin-top:5px;   ">Cliente:</div>
     <div class="ui-widget" style="float:left;"><input class="inputboxPequeno" size="20" id="txt_usuario_buscar" name="txt_orden" type="text"  /></div>
    <input name="btn_buscar" id="btn_buscar" type="image" src="img/search.png" />

	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n General Clientes</div>
	<table>
	  <tr>
	    <td class="Arial14Negro">Nombre</td>
	    <td class="Arial14Negro">C&eacute;dula</td>
	    <td class="Arial14Negro">E-mail</td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><input id="txt_nombre" class="inputbox" type="text" /></td>
	    <td class="Arial14Negro"><input id="txt_cedula" class="inputbox" type="text" /></td>
	    <td class="Arial14Negro"><input id="txt_correo" class="inputbox" type="text" /></td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro">Tipo</td>
	    <td class="Arial14Negro">Tel&eacute;fono Cel</td>
	    <td class="Arial14Negro">Tel&eacute;fono Fijo</td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><select name="cmb_tipo" id="cmb_tipo" class="combos">
	      <option>Particular</option>
	      <option>Investigacion</option>
          <option>Exonerado</option>
          <option>Oficial</option>
	      </select></td>
	    <td class="Arial14Negro"><input id="txt_tel_cel" class="inputbox" type="text" /></td>
	    <td class="Arial14Negro"><input id="txt_tel_fijo" class="inputbox" type="text" /></td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro">Fax</td>
	    <td class="Arial14Negro">Direcci&oacute;n</td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><input id="txt_fax" class="inputbox" type="text" /></td>
	    <td class="Arial14Negro"><input  id="txt_direccion"  class="inputbox" type="text" /><input id="opcion" name="opcion" type="hidden" value="1" /></td>
	    </tr>
	<tr>
	    <td class="Arial14Negro">Consumible</td>
	   
	    <td class="Arial14Negro">Cr&eacute;dito</td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><input id="txt_consumible" class="inputbox" type="text" /></td>
	    
	    <td class="Arial14Negro">
			<input type="radio" name="rnd_credito" value="1" id="rnd_credito_1" />
	        Si
	        <input type="radio" name="rnd_credito" value="0" id="rnd_credito_0" />
	        No</td>
	    </tr>
	  <tr>        
	  </table>
	<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardar" id="btn_guardar" type="image" src="img/btn_guardar.png" /><input name="btn_eliminar" id="btn_eliminar" type="image" src="img/btn_eliminar.png" /></div>    

</div><!--fin cuadro blanco--> 
</div><!--fin cuadro azul--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:350px;float:left" class="Arial8negro">
Sistema de Control e Informaci&oacute;n.  
</div>
<div align="center" style="float:left" class="Arial8azul">&nbsp;CINA.&nbsp;
</div>
<div align="center" style="float:left" class="Arial8negro">
Versi&oacute;n 1.0
</div>
</td></tr></table>

</div>




</body>

</html>
