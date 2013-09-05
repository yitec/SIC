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
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />


<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
<script src="includes/datetimepicker_css.js"></script>

<script src="includes/jquery.ui.core.js"></script>
<script src="includes/jquery.ui.widget.js"></script>
<script src="includes/jquery.ui.autocomplete.js"></script>
<script src="includes/jquery.ui.position.js"></script>

<script src="includes/Scripts_Impuestos.js" type="text/javascript"></script> 

		


</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Impuestos</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>

<input id="opcion" type="hidden" value="1" />
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">
	<div class="Arial14Negro" style="margin-left:470px; float:left; margin-top:5px;   ">Recibo:</div>
     <div class="ui-widget" style="float:left;"><input class="inputboxPequeno" size="20" id="txt_recibo_buscar" name="txt_orden" type="text"  /></div>
    <input name="btn_buscar" id="btn_buscar" type="image" src="img/search.png" />

	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n General Recaudación de impuestos</div>
    
    <div align="center" class="Arial14Morado"><a id="ver" href="archivo_upload.php">Subir imagen<img src="img/add_icon.png" width="25" height="25"  /></a></div>
    <br />
    
	<table>
	  <tr>
	    <td class="Arial14Negro">Empresa</td>
	    <td class="Arial14Negro">Número Recibo</td>
	    <td class="Arial14Negro">Número Deposito</td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><input id="txt_empresa" class="inputbox" type="text" /></td>
	    <td class="Arial14Negro"><input id="txt_recibo" class="inputbox" type="text" /></td>
	    <td class="Arial14Negro"><input id="txt_deposito" class="inputbox" type="text" /></td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro">Monto</td>
	    <td class="Arial14Negro">Monto por mora</td>
	    <td class="Arial14Negro">Fecha Pago</td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><input id="txt_monto" class="inputbox" type="text" /></td>
	    <td class="Arial14Negro"><input id="txt_mora" class="inputbox" type="text" /></td>
	    <td class="Arial14Negro"><input id="txt_fecha" class="inputbox" type="text" /><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_fecha')" style="cursor:pointer"/></td>
	    </tr>
        <tr>
        <td class="Arial14Negro">Semestre</td>
	    <td class="Arial14Negro">Tipo pago</td>
        </tr>
	    <tr>
        <td class="Arial14Negro"><input id="txt_semestre" class="inputbox" type="text" /></td>
        <td class="Arial14Negro"><label>
          <select name="cmb_tipopago" class="combos" id="cmb_tipopago">
          <option value="Deposito">Deposito</option>
          <option value="Contado">Contado</option>
          <option value="Cheque">Cheque</option>
          <option value="Transferencia">Transferencia</option>
          </select>
        </label></td>
        </tr>      
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

<div align="center" id="imagen"></div>

</div>




</body>

</html>
