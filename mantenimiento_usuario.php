<?
include ('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();

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
<script src="includes/datetimepicker_css.js"></script>

<script src="includes/jquery.ui.core.js"></script>
<script src="includes/jquery.ui.widget.js"></script>
<script src="includes/jquery.ui.autocomplete.js"></script>
<script src="includes/jquery.ui.position.js"></script>

<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Usuarios.js" type="text/javascript"></script> 
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Usuarios</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style=" height:2800px;"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>

<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">
	<div class="Arial14Negro"  style="margin-left:550px; float:left; margin-top:5px;   ">Usuario:</div>
    <div class="ui-widget" style="float:left;"><input class="inputboxPequeno" size="10" id="txt_usuario_buscar" name="txt_usuario" type="text"  /></div>
    <input name="btn_buscar" id="btn_buscar" type="image" src="img/search.png" />

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n General</div>
    
	<table>
    
    <tr>
    	<td class="Arial14Morado">Nombre</td>
    	<td class="Arial14Morado">Apellidos</td> 
        <td class="Arial14Morado">C&eacute;dula</td>               
    </tr>
    <tr>
    	<td height="34" class="Arial14Negro"><input name="txt_nombre" id="txt_nombre" class="inputbox" type="text" /><input id="opcion" name="opcion" type="hidden" value="1" /></td>
    	<td class="Arial14Negro"><input name="txt_apellidos" id="txt_apellidos" class="inputbox" type="text" /></td>        
    	<td class="Arial14Negro"><input name="txt_cedula" id="txt_cedula" class="inputbox" type="text" /></td>                
    </tr>
	<tr>
    	<td class="Arial14Morado">Usuario</td>
    	<td class="Arial14Morado">Password</td> 
        <td class="Arial14Morado">Fecha Caducidad</td>               
    </tr>
    <tr>
    	<td class="Arial14Negro"><input name="txt_usuario" id="txt_usuario" class="inputbox" type="text" /></td>
    	<td class="Arial14Negro"><input name="txt_pass" id="txt_pass" class="inputbox" type="password" /></td>        
        <td class="Arial14Negro"><input name="txt_fecha" id="txt_fecha" class="inputbox" type="text" /><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_fecha')" style="cursor:pointer"/></td>        
    </tr>    
    </table>
    
    <table width="740" >
    <tr>
    	<td width="202" align="center" class="Arial18Azul">Permisos</td>
    </tr>
    </table>
    <table width="740">
    <tr>
      <td align="center"><img src="img/azul.jpg" width="460" height="1" /></td></tr>
    </table>
    <table width="740" >
    <tr>
    	<td width="109" class="Arial14Azul">Contratos=</td>
        <td width="207" height="27" class="Arial14Negro"><input class="ck" name="chk_c_contrato"  id="chk_c_contrato" type="checkbox" value="" />
          Crear Contratos</td>
        <td width="232" class="Arial14Negro"><input class="ck" name="chk_m_contrato" id="chk_m_contrato" type="checkbox" value="" />Modificar Contratos</td>
        <td width="172" class="Arial14Negro"><input class="ck" name="chk_v_contrato" id="chk_v_contrato" type="checkbox" value="" />Ver Contratos</td>
    </tr>
    </table>
    <table width="740">
    <tr>
      <td align="center"><img src="img/azul.jpg" width="460" height="1" /></td></tr>
    </table>
    <table width="740" >
    <tr>
    	<td width="109" class="Arial14Azul">Molienda=</td>
    	<td width="531" height="28" class="Arial14Negro"><input class="ck" name="chk_molienda" id="chk_molienda" type="checkbox" value="" />Molienda</td>
        <td width="38" class="Arial14Negro"></td>
        <td width="42" class="Arial14Negro"></td>
    </tr>
    </table>
    <table width="740">
    <tr>
      <td align="center" ><img src="img/azul.jpg" width="460" height="1" /></td></tr>
    </table>
    <table width="740" > 
     <tr>
    <td width="109" height="27" class=" Arial14Azul">An&aacute;lisis Qu&iacute;mica=</td>
    	<td width="139" class="Arial14Negro"><input class="ck" name="chk_quimica" id="chk_quimica" type="checkbox" value="" />Activar 
    	  </td>
        <td width="461" class="Arial10Negro"><div id="quimica" class="checkboxQuimica">
    	  <div align="" class="Arial14Azul">Marcar Todos<input id="chk_todosQuimica" type="checkbox" value="" /></div>
          <br />
          <? 
		  	$cont=1;
			$result=mysql_query("select * from tbl_nombresanalisis where id_laboratorio='"."1"."' group by nombre");
			while ($row=mysql_fetch_assoc($result))
			{	
				$numero=2;
				$res = ($cont % $numero);
			
				if ($res==0){
					echo '<div style="float:left; width:200px;"><input type="checkbox" class="qm" onclick="agregaAnalisis('.$row['id'].')" name="CheckboxGroupMicro" value="'.$row['id'].'" id="CheckboxGroupMicro_'.$cont.'" />'.utf8_encode($row['nombre']).'</div><br>';
				}else{
					echo '<div style="float:left;  width:200px;"><input type="checkbox" class="qm" onclick="agregaAnalisis('.$row['id'].')" name="CheckboxGroupMicro" value="'.$row['id'].'" id="CheckboxGroupMicro_'.$cont.'" />'.utf8_encode($row['nombre']).'</div>';
				}
		  
		  ?>
    	    
           <?
		   $cont++;
		   }//end while
		   ?>
  	    
    	</div></td>
        <td width="11" class="Arial14Negro">&nbsp;</td>
    </tr>
    </table>
    <table width="740">
    <tr>
      <td align="center"><img src="img/azul.jpg" width="460" height="1" /></td></tr>
    </table>
    <table width="740" >
    <tr>
    <td width="109" height="27" class=" Arial14Azul">An&aacute;lisis Micro=&nbsp;</td>
    	<td width="140" class="Arial14Negro"><input class="ck" name="chk_microb" id="chk_microb" type="checkbox" value="" />Activar 
    	  </td>
        <td width="457" class="Arial10Negro"><div id="microbiologia" class="checkboxMicrobiologia">
        <div align="" class="Arial14Azul">Marcar Todos<input id="chk_todosMicro" type="checkbox" value="" /></div>
    	  <? 
		  	$cont=1;
			$result=mysql_query("select * from tbl_nombresanalisis where id_laboratorio='"."2"."' group by nombre");
			while ($row=mysql_fetch_assoc($result))
			{	
				$numero=2;
				$res = ($cont % $numero);
			
				if ($res==0){
					echo '<div style="float:left; width:200px;"><input type="checkbox" class="mb" onclick="agregaAnalisis('.$row['id'].')" name="CheckboxGroupMicro" value="'.$row['id'].'" id="CheckboxGroupMicro_'.$cont.'" />'.utf8_encode($row['nombre']).'</div><br>';
				}else{
					echo '<div style="float:left;  width:200px;"><input type="checkbox" class="mb" onclick="agregaAnalisis('.$row['id'].')" name="CheckboxGroupMicro" value="'.$row['id'].'" id="CheckboxGroupMicro_'.$cont.'" />'.utf8_encode($row['nombre']).'</div>';
				}
		  
		  ?>
    	    
           <?
		   $cont++;
		   }//end while
		   ?>
    	</div></td>
        <td width="12" class="Arial14Negro">&nbsp;</td>
    </tr>
    </table>
    <table width="740">
    <tr>
      <td align="center"><img src="img/azul.jpg" width="460" height="1" /></td></tr>
    </table>
    <table width="740" >
     <tr>
    <td width="109" height="27" class=" Arial14Azul">An&aacute;lisis Broma=</td>
    	<td width="138" class="Arial14Negro"><input class="ck" name="chk_broma" id="chk_broma" type="checkbox" value="" />Activar 
    	  </td>
        <td width="462" class="Arial10Negro"><div id="bromatologia" class="checkboxBromatologia">
        <div align="" class="Arial14Azul">Marcar Todos<input id="chk_todosBroma" type="checkbox" value="" /></div>
    	  <? 
		  	$cont=1;
			$result=mysql_query("select * from tbl_nombresanalisis where id_laboratorio='"."3"."' group by nombre");
			while ($row=mysql_fetch_assoc($result))
			{	
				$numero=2;
				$res = ($cont % $numero);
			
				if ($res==0){
					echo '<div style="float:left; width:200px;"><input type="checkbox" class="br" onclick="agregaAnalisis('.$row['id'].')" name="CheckboxGroupMicro" value="'.$row['id'].'" id="CheckboxGroupMicro_'.$cont.'" />'.utf8_encode($row['nombre']).'</div><br>';
				}else{
					echo '<div style="float:left;  width:200px;"><input type="checkbox" class="br" onclick="agregaAnalisis('.$row['id'].')" name="CheckboxGroupMicro" value="'.$row['id'].'" id="CheckboxGroupMicro_'.$cont.'" />'.utf8_encode($row['nombre']).'</div>';
				}
		  
		  ?>
    	    
           <?
		   $cont++;
		   }//end while
		   ?>
    	</div></td>
        <td width="10" class="Arial14Negro">&nbsp;</td>
    </tr>
    </table>
    <table width="740">
    <tr>
      <td align="center"><img src="img/azul.jpg" width="460" height="1" /></td></tr>
    </table>
    <table width="740" >
     <tr>
    <td width="109" height="27" class=" Arial14Azul">Reportes=</td>
    	<td width="167" class="Arial14Negro"><input class="ck" name="chk_reportes" id="chk_reportes" type="checkbox" value="" />Activar 
    	  </td>
        <td width="355" class=" Arial10Negro"><div id="reportes" class="checkboxReportes">
        <div align="" class="Arial14Azul">Marcar Todos<input id="chk_todosReporte" type="checkbox" value="" /></div><br />
    	  <? 
		  	$cont=1;
			$result=mysql_query("select * from tbl_reportes where estado='"."1"."'");
			while ($row=mysql_fetch_assoc($result))
			{	
				$numero=2;
				$res = ($cont % $numero);
			
				
					echo '<div style=" width:400px;"><input type="checkbox" class="rp" onclick="agregaReporte('.$row['id'].')" name="CheckboxGroupReportes" value="'.$row['id'].'" id="CheckboxGroupReportes_'.$cont.'" />'.utf8_encode($row['nombre']).'</div><br>';
				
		  ?>
    	    
           <?
		   $cont++;
		   }//end while
		   ?>
    	</div></td>
        <td width="89" class="Arial14Negro">&nbsp;</td>
    </tr>
    </table>
    <table width="740">
    <tr>
      <td align="center"><img src="img/azul.jpg" width="460" height="1" /></td></tr>
    </table>
    <table width="740" >
    <tr>
        <td width="109" height="36" class="Arial14Azul">Resultados=</td>
    	<td width="198" class="Arial14Negro"><input class="ck" name="chk_rquimica" id="chk_rquimi" type="checkbox" value="" />Qu&iacute;mica</td>
        <td width="196" class="Arial14Negro"><input class="ck" name="chk_rmicro" id="chk_rmicro" type="checkbox" value="" />Microbiolog&iacute;a</td>        
        <td width="212" class="Arial14Negro"><input class="ck" name="chk_rbroma" id="chk_rbroma" type="checkbox" value="" />Bromatolog&iacute;a</td>
    </tr>
    </table>
    <table width="740">
    <tr>
      <td align="center"><img src="img/azul.jpg" width="460" height="1" /></td></tr>
    </table>
    <table width="740" >
    <tr>
      <td width="109" class="Arial14Azul">General=</td>
    	
        <td width="189" class="Arial14Negro"><input class="ck" name="chk_usuarios" id="chk_usuarios" type="checkbox" value="" />Mantenimiento Usuarios</td>
        <td width="213" class="Arial14Negro"><input class="ck" name="chk_clientes" id="chk_clientes" type="checkbox" value="" />Mantenimiento Clientes</td>
        <td width="213" class="Arial14Negro"><input class="ck"  id="chk_precios" type="checkbox" value="" />
          Mantenimiento Precios</td>
    </tr>  
    <tr>
      <td width="114" class="Arial14Azul"></td>
    	<td width="204" class="Arial14Negro"><input class="ck" id="chk_rEtiquetas" type="checkbox" value="" />Reimprimir Etiquetas</td>
       <!-- <td width="189" class="Arial14Negro"><input class="ck"  id="chk_mMuestras" type="checkbox" value="" />Mantenimiento Muestras</td>-->
        <td width="213" class="Arial14Negro"><input class="ck"  id="chk_firmas" type="checkbox" value="" />Tiempos Firmas</td>
        <td width="213" class="Arial14Negro"><input class="ck"  id="chk_mAnalisis" type="checkbox" value="" />Mantenimiento Contratos</td>
    </tr>                
    <tr>
      <td width="114" class="Arial14Azul"></td>
      <td width="204" class="Arial14Negro"><input class="ck" name="chk_crearAnalisis" id="chk_crearAnalisis" type="checkbox" value="" />Crear Análisis</td>      
      <td width="189" class="Arial14Negro"><input class="ck"  id="chk_iActuales" type="checkbox" value="" />
        Informes Actuales</td>
      <td width="213" class="Arial14Negro"><input class="ck"  id="chk_iAntiguos" type="checkbox" value="" />Informes Antiguos</td>
    </tr>     
    <tr>
      <td width="114" class="Arial14Azul"></td>    	
        <td width="189" class="Arial14Negro"><input class="ck"  id="chk_cActuales" type="checkbox" value="" />
        Contratos Actuales</td>
        <td width="213" class="Arial14Negro"><input class="ck"  id="chk_cAntiguos" type="checkbox" value="" />Contratos Antiguos</td>
        <td width="204" class="Arial14Negro"><input class="ck"  id="chk_pQuimica" type="checkbox" value="" />Pre Resultados Qu&iacute;mica</td>
        
    </tr>
    <tr>
      <td class="Arial14Azul"></td>
      <td width="204" class="Arial14Negro"><input class="ck"  id="chk_tipos" type="checkbox" value="" />Crear Tipos muestra</td>
      <td class="Arial14Negro"><input class="ck"  id="chk_inventario" type="checkbox" value="" />Inventarios</td>
      <td class="Arial14Negro"><input class="ck"  id="chk_impuestos" type="checkbox" value="" />Impuestos</td>
    </tr>         
     <tr>
      <td class="Arial14Azul"></td>
      <td width="204" class="Arial14Negro"><input class="ck"  id="chk_materias" type="checkbox" value="" />Materias Primas</td>      
      <td width="204" class="Arial14Negro"><input class="ck" name="chk_eliminarAnalisis" id="chk_eliminarAnalisis" type="checkbox" value="" />Eliminar Análisis</td>
    </tr>     
    </table>
<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardar" id="btn_guardar" type="image" src="img/btn_guardar.png" /><input name="btn_eliminar" id="btn_eliminar" type="image" src="img/btn_eliminar.png" /></div>    

</div><!--fin cuadro gris--> 
</div><!--fin cuadro gris--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:2800px;"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:350px;float:left" class="Arial8negro">
Sistema de Informaci&oacute;n y Control.  
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
