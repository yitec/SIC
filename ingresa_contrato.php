<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();

$result=mysql_query("select MAX(id) as maximo from tbl_conscontratos");
$row=mysql_fetch_assoc($result);
$maximo=$row['maximo']+1;
$_SESSION['contrato']="GE-".$maximo;
desconectar();


$_SESSION['muestras']=0;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<script src="includes/jquery.ui.core.js"></script>
<script src="includes/jquery.ui.widget.js"></script>
<script src="includes/jquery.ui.position.js"></script>
<script src="includes/jquery.ui.autocomplete.js"></script>
<script src="includes/Scripts_Contratos.js" type="text/javascript"></script> 
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
<script>
function validar(){
	exito=true;
	if ($('#txt_nombreSolicitante').val()==""||$('#txt_telefonoSolicitante').val()==""||$('#txt_nombre').val()==""||$('#txt_tipoCliente').val()==""){
		
		alert("Todos los campos son obligatorios debe llenarlos todos.");	
		return ;
	}
	if (exito){
		top.location.href = 'muestras_contrato.php?txt_nombre='+$('#txt_nombre').val()+"&txt_cliente="+$('#txt_nombre').val()+"&txt_tipoCliente="+$('#txt_tipoCliente').val()+"&txt_nombreSolicitante="+$('#txt_nombreSolicitante').val()+"&txt_telefonoSolicitante="+$('#txt_telefonoSolicitante').val()+"&cmb_tipoPago="+$('#cmb_tipoPago').val()+"&cmb_xcorreo="+$('#cmb_xcorreo').val()+"&txt_consumible="+$('#txt_consumible').val()+"&txt_consecutivo="+$('#txt_consecutivo').val();
	}
}
</script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Contratos</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:580px;"></div>
<div    class="contenido_gm" align="center">


<?
require_once('menu_superior.php');
?>

<div id="mainAzulFondo" align="center" style=" padding: 20px; width:620px; "   >
<div id="mainBlancoFondo" align="center" style=" width:600px;"  	 >
	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n del Contrato</div>
    <div align="center" style="margin-top:10px; margin-bottom:10px;" ><img src="img/uno.png" width="48" height="48" /><img src="img/2_gris.png" width="48" height="48" /><img src="img/3_gris.png" width="48" height="48" /></div>
	<table>
    <tr>
    	<td height="29" class="Arial14Morado">Consecutivo</td>
        <td><input name="txt_consecutivo"  value="<?=$_SESSION['contrato'];?>" id="txt_consecutivo" class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td height="25" class="Arial14Morado">Cliente</td>
        <td valign="top"><div style="float:left;"><div class="ui-widget"><input id="txt_nombre" name="txt_nombre"  size="40"  class="inputbox" type="text" /></div></div>
          
          <div style="margin-top:2px; float:left;"><a id="ver" href="mantenimiento_clientes.php"><img src="img/add_icon.png" width="20" height="20" /></a></div>
          </td>
    </tr>
    <tr>
    	<td height="25" class="Arial14Morado">Tipo cliente</td>
        <td><input  id="txt_tipoCliente" name="txt_tipoCliente"  size="20" class="inputbox" type="text" /></td>
    </tr>
	<tr>
    	<td height="25" class="Arial14Morado">Nombre Solicitante</td>
        <td><input name="txt_nombreSolicitante" id="txt_nombreSolicitante" size="50" class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td height="25" class="Arial14Morado">Tel&eacute;fono Solicitante</td>
        <td><input name="txt_telefonoSolicitante" id="txt_telefonoSolicitante" class="inputbox" type="text" /></td>
    </tr>    
    
    
	<tr>
    	<td class="Arial14Morado">Tipo Pago</td>
        <td><select class="combos" id="cmb_tipoPago" name="cmb_tipoPago">
          <option selected="selected">Contado</option>
          <option >Tarjeta</option>

          
        </select></td>
    </tr>
	<tr>
	  <td class="Arial14Morado">Envio por correo</td>
	  <td><select class="combos" id="cmb_xcorreo" name="cmb_xcorreo">
          <option selected="selected">No</option>
          <option selected="selected">Si</option>
        </select></td>
	  </tr>            
    </table>
    <br />
    <div align="center">
    <input name="txt_consumible" id="txt_consumible" type="hidden" value="" />
    <input name="txt_consumido" id="txt_consumido" type="hidden" value="" />
    <div id="consumible" style="float:left; margin-left:190px;" class="Arial14Negro"></div>
    
    <div id="consumido" style="float:left" class="Arial14Negro"></div>
    </div>
    <br />
	<div align="center">
    
    <input  id="btn_siguiente"  type="image" onclick="validar()" src="img/btn_continuar.png" /><br /></div>

</div><!--fin cuadro gris--> 

</div><!--fin cuadro Azul--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:580px;"></div>
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
