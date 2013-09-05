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
<script src="../includes/datetimepicker_css.js"></script>

<script src="../includes/Scripts_Inventarios.js" type="text/javascript"></script> 



</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Inventario</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>


<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">
	<div class="Arial14Negro" style="margin-left:470px; float:left; margin-top:5px;   ">articulo:</div>
     <div class="ui-widget" style="float:left;"><input class="inputboxPequeno" size="20" id="txt_articulo_buscar" name="txt_orden" type="text"  /></div>
    <input name="btn_buscar" id="btn_buscar_articulo" type="image" src="../img/search.png" />
    <input id="opcion" name="opcion" type="hidden" value="1" />

	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n General del Articulo</div>
	<table>
	  <tr>
      	<td height="33" class="Arial14Negro">Categoría</td>
	    <td class="Arial14Negro">C&oacute;digo</td>
        <td class="Arial14Negro">Nombre</td>
        <td class="Arial14Negro">Existencia</td>        
	    
	    
	    </tr>
	  <tr>
	    <td height="29" class="Arial14Negro"><select name="cmb_categoria" id="cmb_categoria" class="combos">
        <option selected="selected" value="Seleccione">Seleccione</option>
        
        <?
		$result=mysql_query("select * from tbl_categorias");
		while($row=mysql_fetch_object($result)){
			echo '<option value="'.$row->id.'">'.utf8_encode($row->nombre).'</option>';	
			
		}
		?>
	      
	      </select></td>
	    <td class="Arial14Negro"><input id="txt_codigo" class="inputbox" type="text" /></td>

        <td class="Arial14Negro"><input id="txt_nombre" class="inputbox" type="text" /></td>
        <td class="Arial14Negro"><input id="txt_existencia" class="inputbox" type="text" /></td>        
	    
	    </tr>
	  <tr>
	    <td height="34" class="Arial14Negro">Existencia mínima</td>
	    <td class="Arial14Negro">Ubicación</td>
	    <td class="Arial14Negro">Unidad</td>
	    </tr>
	  <tr>
	    <td height="41" class="Arial14Negro"><input id="txt_existenciam" class="inputbox" type="text" /></td>
	    <td class="Arial14Negro"><input id="txt_ubicacion" class="inputbox" type="text" /></td>
	    <td class="Arial14Negro"><input id="txt_unidades" size="10" class="inputbox" type="text" /></td>
	    </tr>
	  <tr>
	    
	    <td height="35" class="Arial14Negro">Recipientes</td>
        <td class="Arial14Negro">Cantidad Recipientes</td>
	    </tr>
	  <tr>
	 
	    <td class="Arial14Negro"><input type="radio" name="rnd_botellas" value="1" id="rnd_botellas_1" />
	        Si
	        <input type="radio" name="rnd_botellas" value="0" id="rnd_botellas_0" />
	        No</td>
            <td class="Arial14Negro"><input id="txt_cbotellas" class="inputbox" type="text" />
              <img src="../img/add_icon.png" id="btn_codigosar" width="20" height="20" /></td>
            
	    </tr>
	
	        
	  </table>
<div id="botellas">
<br />
<span class="Arial18Azul">Ingrese los códigos de las botellas</span>
<br />
<table>
		<tr id="linea1"></tr>
        <tr id="linea2"></tr>
        <tr id="linea3"></tr>
        <tr id="linea4"></tr>
        <tr id="linea5"></tr>
        <tr id="linea6"></tr>
        <tr id="linea7"></tr>
        <tr id="linea8"></tr>
        <tr id="linea9"></tr>
        <tr id="linea10"></tr>
        <tr id="linea11"></tr>
        <tr id="linea12"></tr>
        <tr id="linea13"></tr>
        <tr id="linea14"></tr>
        <tr id="linea15"></tr>
        <tr id="linea16"></tr>
        <tr id="linea17"></tr>
        <tr id="linea18"></tr>
        <tr id="linea19"></tr>
        <tr id="linea20"></tr>
</table>


</div>      
      
      
<div id="cristaleria" class=" Arial14Negro">
<br />
<span class="Arial18Azul">Cristaleria</span>
	<table width="571">
   	<tr>
    	<td width="142" class="Arial14Negro">Tipo Material</td>
    	<td width="192" class="Arial14Negro">Capacidad</td>
    	<td width="221" class="Arial14Negro">Presentación</td>        
	</tr>
   	<tr>
    	<td class="Arial14Negro"><select class="combos" name="cmb_tipo" id="cmb_tipo">
        <option  selected="selected">Seleccione</option>
        <option value="Vidrio">Vidrio</option>
        <option value="Porcelana">Porcelana</option>
        <option value="Ámbar">Ámbar</option>                
        <option value="Hule">Hule</option>        
        <option value="Plástico">Plástico</option>        
        <option value="Metal">Metal</option>        
        <option value="Madera">Madera</option>                        
        <option value="Papel">Papel</option>                
        </select>
        </td>
    	<td class="Arial14Negro"><input id="txt_capacidad" class="inputbox" type="text" /></td>
    	<td class="Arial14Negro"><input id="txt_presentacion" class="inputbox" type="text" /></td>        
	</tr>
    
    </table>


</div>      
<div id="medios" class=" Arial14Negro">
<br />
<span class="Arial18Azul">Medios de Cultivo</span>
    <table >
    <tr>
        <td width="142" class="Arial14Negro">Fabricante</td>
        <td width="192" class="Arial14Negro">Referencia</td>
        <td width="221" class="Arial14Negro">Lote</td>        
        <td width="221" class="Arial14Negro">Fecha Caducidad</td>        
    </tr>
    <tr>
        <td class="Arial14Negro"><input id="txt_fabricante" class="inputbox" type="text" /></td>
        <td class="Arial14Negro"><input id="txt_referencia" class="inputbox" type="text" /></td>
        <td class="Arial14Negro"><input id="txt_lote"  size="20"class="inputbox" type="text" /></td>        
        <td class="Arial14Negro"><input id="txt_fecha" maxlength="10" size="10" max class="inputbox" type="text" /><img src="../img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_fecha')" style="cursor:pointer"/></td>        
    </tr>    
    </table>
</div>      

	<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardara" id="btn_guardara" type="image" src="../img/btn_guardar.png" /><input name="btn_eliminar" id="btn_eliminar" type="image" src="../img/btn_eliminar.png" /></div>    

</div><!--fin cuadro blanco--> 
</div><!--fin cuadro azul--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:3000px;"></div>
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
