<?php
include ('../cnx/Conexion_Calidad.php');
conectarc();
$consulta = "SELECT * FROM `tbl_categorias` WHERE `estado` =1 ORDER  BY `nombre_categoria` ASC";	

$dt=mysql_query($consulta);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel ="stylesheet" href="../css/calidad.css" type="text/css" />
        <link rel ="stylesheet" href="../css/cuadros.css" type="text/css" />
        <link rel ="stylesheet" href="../css/jquery.pnotify.default.css" type="text/css" />
        <link rel ="stylesheet" href="../css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css" />        
        <title>SIC CINA</title>      
    </head>
<body >    
<div class="header"></div>
<div class="box">
<div align="center">
<table><tr><td > 
<div    class="contenido_gm">
<div style="margin-left:650px;  margin-top:5px; " ><a href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a href="control_calidad.php">Men&uacute;</a>&nbsp;-&nbsp;<a href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">	
	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Editar Categor&iacute;a</div>    
	<table>    
	  <tr>
	    <td width="178" class="Arial14Negro"><div align="center"></div></td>	    
	    </tr>
	  <tr>
	    <td class="Arial14Negro"></td>	  	   
	    </tr>	          
	  </table>
	<table>
	  <tr>
	  <td width="178" class="Arial14Negro"><div align="center">
	    <table>
	      <tr>
	        <td width="178" class="Arial14Negro"><div align="center">Categor&iacute;a</div></td>
	        </tr>
	      <tr>
	        <td class="Arial14Negro"><label>
	          <select name="cmb_categoria_edit" class="combos" id="cmb_categoria_edit" >
	            <option value="0">Seleccione</option>
	            <?php				
									while($info=mysql_fetch_array($dt)){
										echo '
                      <option value="'.$info[0].'">'.utf8_encode($info[1]).'</option>';}?>
	            </select>
	          </label></td>
	        </tr>
	      <tr></tr>
	      </table>
	  </div></td>
	</tr>
	</table>
	<table>
	  <tr>
	    <td width="178" class="Arial14Negro"><div align="center">Nuevo Nombre:</div></td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro">
		<input name="txt_nombre" class="inputbox" id="txt_nombre"/> 
	    </tr>
	  </table>
      	<table>
	  <tr>
	    <td width="178" class="Arial14Negro"><div align="center"></div></td>
	    </tr>
	  <tr>
	    <td height="89" class="Arial14Negro">¿Eliminar Categoría? <span style="margin-top:20px; margin-bottom:20px;">
	      <input name="eliminar_categoria" id="eliminar_categoria" type="image" src="../img/delete_icon.png"  />
	    </span></tr>
	  </table>
	<p>&nbsp;</p>
	<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="guardar_editar_categoria" id="guardar_editar_categoria" type="image" src="../img/btn_guardar.png"  /></div>    

</div><!--fin cuadro blanco--> 
</div><!--fin cuadro azul--> 
</div><!--fin div de contenido cudro gm-->
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
</div>		
</body>
<script src="../includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="../includes/jquery.pnotify.js" type="text/javascript"></script>
<script src="../includes/Scripts_Calidad.js" type="text/javascript"></script>  
</html>

