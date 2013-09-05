<?
session_start();
include('../cnx/conexion.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<script src="../includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="../includes/datetimepicker_css.js"></script>
<style>
a:visited{
	text-decoration:none;
	font-size:14px;
	color:#000;
	font-family:arial;
 		
}

a:link{
	text-decoration:none;
	font-size:14px;
	color:#000;
	font-family:arial;
 	
}

a:hover{
	text-decoration:none;
	font-size:14px;
	color:#000;
	font-family:arial;
 	
}


</style>

<script>
$("#btn_generar").live("click", function(event){
var validado=true;
if($('#fecha_ini').val()==""){
	alert("Todos los campos son obligatorios por favor verifique");
	validado=false;
	
}

if($('#fecha_fin').val()==""){
	alert("Todos los campos son obligatorios por favor verifique");
	validado=false;
	
}
if($('#cmb_laboratorio').val()==0){
	alert("Todos los campos son obligatorios por favor verifique");
	validado=false;
	
}




if (validado==true){
	top.location.href = 'alaboratorios.php?fecha_ini='+$('#fecha_ini').val()+'&fecha_fin='+$('#fecha_fin').val()+'&cmb_ini='+$('#cmb_ini').val()+'&cmb_fin='+$('#cmb_fin').val()+'&cmb_laboratorio='+$('#cmb_laboratorio').val();
}





});

</script>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style=" width:1100px"><div  class="Arial14blanco"  align="left" style="float:left; margin-top:18px;">Reportes An&aacute;lisis por laboratorio</div><div align="right"></div> </div>
<div class="der_sup_g" style=" position:relative; margin-left:1101px;" ></div>
<div class="lineaAzul" style="width:1109px;"></div>
<div class="izq_lat_g" style="height:1000px"></div>
<div    class="contenido_gm">


<div id="mainAzulFondo" style=" width:1000px;padding:5px;" >
<div id="mainBlancoFondo" style="width:985px;" >
<div align="center">
<br />
 

<table>
    
    <tr>
    <td class="Arial14Negro">Fecha Inicio:</td>
    <td><input type="Text" name="fecha_ini" class="inputbox" id="fecha_ini" maxlength="20" size="20"/>     <img src="../img_calendar/cal.gif" onClick="javascript:NewCssCal('fecha_ini')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Fecha Fin:</td>
    <td><input type="Text" class="inputbox" id="fecha_fin" name="fecha_fin" maxlength="20" size="20"/>     <img src="../img_calendar/cal.gif" onClick="javascript:NewCssCal('fecha_fin')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Hora Inicio:</td>
    <td><label>
      <select class="combos" name="cmb_ini" id="cmb_ini">
      <option>00:00</option>
      <option>01:00</option>
      <option>02:00</option>
      <option>03:00</option>
      <option>04:00</option>
      <option>05:00</option>                        
      <option>06:00</option>
      <option>07:00</option>      
      <option>08:00</option>
      <option>09:00</option>
      <option>10:00</option>
      <option>11:00</option>
      <option>12:00</option>
      <option>13:00</option>
      <option>14:00</option>
      <option>15:00</option>
      <option>16:00</option>
      <option>17:00</option>
      <option>18:00</option>
      <option>19:00</option>
      <option>20:00</option>
      <option>21:00</option>
      <option>22:00</option>
      <option>23:00</option>
      </select>
    </label></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Hora F&iacute;n:</td>
    <td><label>
      <select class="combos" name="cmb_fin" id="cmb_fin">
      <option>00:00</option>
      <option>01:00</option>
      <option>02:00</option>
      <option>03:00</option>
      <option>04:00</option>
      <option>05:00</option>                        
      <option>06:00</option>
      <option>07:00</option>      
      <option>08:00</option>
      <option>09:00</option>
      <option>10:00</option>
      <option>11:00</option>
      <option>12:00</option>
      <option>13:00</option>
      <option>14:00</option>
      <option>15:00</option>
      <option>16:00</option>
      <option>17:00</option>
      <option>18:00</option>
      <option>19:00</option>
      <option>20:00</option>
      <option>21:00</option>
      <option>22:00</option>
      <option>23:00</option>

      </select>
    </label> <input name="opcion" type="hidden" value="1" /></td>
    </tr>
    
    <tr>
    <td class="Arial14Negro">Laboratorio</td>    
    <td><select name="cmb_laboratorio" id="cmb_laboratorio" class="combos">
      <option selected="selected" value="0">Seleccione</option>
      <option value="1">Qu&iacute;mica</option>
      <option value="2">Microbiolog&iacute;a</option>
      <option value="3">Bromatolog&iacute;a</option>
    </select></td>
    </tr>
    
    </table>
    <br />
    <table>
    <tr>
    <td><input id="btn_generar" type="image" src="../img/btn_generar.png" /></td>
    </tr>
    </table>

    
</div><!--div de centrado-->    
    
    
    
    
    
	
    

</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 



</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style=" margin-left:1101px; height:1000px"></div>


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
