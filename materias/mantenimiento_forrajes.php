<?
session_start();
require_once('../cnx/session_activa.php');
require_once('../cnx/conexion_inventario.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="../css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
<link href="../css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />

<script src="../includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="../includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="../includes/jquery.ui.core.js"></script>
<script src="../includes/jquery.ui.widget.js"></script>
<script src="../includes/jquery.ui.autocomplete.js"></script>
<script src="../includes/jquery.ui.position.js"></script>
<script src="../includes/Scripts_Materias.js"></script>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style="width:1100px;"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Mantenimiento Materias</div><div align="rightx" ></div> </div>
<div class="der_sup_g" style="postion: relative; margin-left: 1110px;"></div>
<div class="lineaAzul" style="width: 1117px;"></div>
<div class="izq_lat_g" style="height:1200px;"></div>
<div class="contenido_gm">
<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" style="padding:10px; width:1000px;"  align="center">
<div id="mainBlancoFondo" style=" width:990px;" align="center">
	
    <input id="opcion" name="opcion" type="hidden" value="1" />

	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Nombre del nuevo tipo de materia</div>
	<table>
	<tr>
      <td class="Arial14Negro"><div align="left">C&oacute;digo</div></td>      
      <td class="Arial14Negro"><input id="txt_codigo" class="inputbox"  type="text" /></td>
      </tr>
	  <tr>
      <td class="Arial14Negro"><div align="left">Clasificación</div></td>
      <td><select class="combos" title="q" id="cmb_clasificacion"><option value="0" selected >Seleccione</option><option value="1">Forrajes secos y alimentos con mas de 18% de fibra</option><option value="2">Pasturas cultivadas utilizadas</option><option value="3">Ensilaje</option><option value="4">Alimentos Energeticos, Productos con menos de 20% de proteína y menos de 18% de fibra</option><option value="5">Suplemento proteíco con mas de 20% de proteína</option><option value="6">Suplemento vitamínico</option><option value="7">Suplemeto mineral</option><option value="8">Aditivos, antibióoticos, colorantes, aromatizantes, hormonas, medicamentos, etc</option><option value="9">Alimentos terminados</option><option value="10">No aplica</option></select>
      </td>
      </tr>
      <tr>
      <td class="Arial14Negro"><div align="left">Categoria</div></td>
      <td><select class="combos" title="q" id="cmb_categoria_1_1" onChange="actualiza_tipo(1)"><option value="0" selected >Seleccione</option><option value="1">Subproducto origen animal</option><option value="2">Granos-Cereales</option><option value="3">Subproducto origen vegetal</option><option value="4">Plantas, sin procesar</option><option value="5">Pastos y forrajes</option><option value="6">Alimento terminado</option><option value="7">Ensilajes</option><option value="8">Otros</option><option value="9">Aguas</option><option value="10">Sedimentos</option><option value="11">L&aacute;cteos</option><option value="12">Minerales y Suplementos</option><option value="13">Semillas</option><option value="14">Leguminosas</option><option value="15">Plasma</option></select>
      </td>
      </tr>
      <tr>
      <td class="Arial14Negro"><div align="left">Sub Categoria</div></td>	      
      <td><select class="combos" title="q" id="cmb_subcategoria_1_1"></select></td>
      </tr>
      <tr>
      <td class="Arial14Negro"><div align="left">Nombre</div></td>      
	    <td class="Arial14Negro"><input id="txt_nombre" class="inputbox" type="text" /></td>	    
	    </tr>	        
	  </table>
	<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardarm" id="btn_guardarm" type="image" src="../img/btn_guardar.png" /></div>    
</div><!--fin cuadro blanco--> 
</div><!--fin cuadro azul--> 
</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="position:relative; margin-left: 1110px; height: 1200px;"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g" style="width:1100px;"></div>
<div class="der_inf_g" style="position:relative; margin-left: 1110px;"></div>
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
