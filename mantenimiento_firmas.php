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
<script src="includes/datetimepicker_css.js"></script>

<script src="includes/Scripts_Firmas.js" type="text/javascript"></script> 



</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Firmas</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>


<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">
	<div class="Arial14Negro" style="margin-left:470px; float:left; margin-top:5px;   ">Contrato:</div>
     <div class="ui-widget" style="float:left;"><input class="inputboxPequeno" size="20" id="txt_contrato_buscar" name="txt_orden" type="text"  /></div>
    <input name="btn_buscar" id="btn_buscar" type="image" src="img/search.png" />

	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n General Firmas</div>
    <table>
    <tr>
    	<td class="Arial14Negro">Contrato</td><td><input name="txt_contrato" id="txt_contrato" type="text"  class="inputbox" size="15" /></td>
    </tr>
    </table>
    <table>
    <tr>
    <td class="Arial14Negro">Entrega firma Qu&iacute;mica</td>
    <td><input name="txt_equimica" id="txt_equimica" type="text" class="inputbox" size="15" /><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_equimica')" style="cursor:pointer"/></td>
    <td class="Arial14Negro">Recepci&oacute;n firma Qu&iacute;mica</td>
    <td><input name="txt_fquimica" id="txt_fquimica" type="text" class="inputbox" size="15"/><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_fquimica')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Entrega firma Microbiolog&iacute;a</td>
    <td><input name="txt_emicro" id="txt_emicro" type="text" class="inputbox" size="15"/><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_emicro')" style="cursor:pointer"/></td>
    <td class="Arial14Negro">Recepci&oacute;n firma Microbiolog&iacute;a</td>
    <td><input name="txt_fmicro" id="txt_fmicro" type="text" class="inputbox" size="15"/><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_fmicro')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Entrega firma Bromatolog&iacute;a</td>
    <td><input name="txt_ebroma" id="txt_ebroma" type="text" class="inputbox" size="15"/><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_ebroma')" style="cursor:pointer"/></td>
    <td class="Arial14Negro">Recepci&oacute;n firma Bromatolog&iacute;a</td>
    <td><input name="txt_fbroma" id="txt_fbroma" type="text" class="inputbox" size="15"/><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_fbroma')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Entrega firma Zootecnia</td>
    <td><input name="txt_ezootecnia" id="txt_ezootecnia" type="text" class="inputbox" size="15"/><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_ezootecnia')" style="cursor:pointer"/></td>
    <td class="Arial14Negro">Recepci&oacute;n firma Zootecnia</td>
    <td><input name="txt_fzootecnia" id="txt_fzootecnia" type="text" class="inputbox" size="15"/><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_fzootecnia')" style="cursor:pointer"/></td>
    </tr>
    
    </table>
	<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardar" id="btn_guardar" type="image" src="img/btn_guardar.png" />
	</div>    

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
