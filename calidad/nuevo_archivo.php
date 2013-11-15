<?php
include ('../cnx/Conexion_Calidad.php');
conectar();
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
<body>    
<div class="header"></div>
<div class="box">
<div style="height:600px;" align="center">

<div class="contenido_gm">
<div style="margin-left:650px;  margin-top:0px; " ><a href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a href="menu_inventario.php">Men&uacute;</a>&nbsp;-&nbsp;<a href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">	
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Nuevo Archivo</div>    
	<table>    
	  <tr>
	    <td width="178" class="Arial14Negro"><div align="center">Nombre</div></td>	    
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><input name="txt_nombre" type="text" class="inputbox" id="txt_nombre" /></td>	  	   
	    </tr>	          
	  </table>
	<table>
	  <tr>
	    <td width="178" class="Arial14Negro"><div align="center">version</div></td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><input name="txt_version" type="text" class="inputbox" id="txt_version" /></td>
	    </tr>
	  </table>
	<table>
	<tr>
	  <td width="178" class="Arial14Negro"><div align="center">
	    <table>
	      <tr>
	        <td width="178" class="Arial14Negro"><div align="center">Categoria</div></td>
	        </tr>
	      <tr>
	        <td class="Arial14Negro"><label>
	          <select name="cmb_categoria2" class="combos" id="cmb_categoria2" >
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
	    <td width="178" class="Arial14Negro"><div align="center">SubCategoria</div></td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro">
		<select name="cmb_subcat2" class="combos" id="cmb_subcat2"></select> 
	    </tr>
	  </table>
      	<table>    
	  <tr>
	    <td width="178" class="Arial14Negro"><div align="center">Prefijo</div></td>	    
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><select name="cmb_prefijo" class="combos" id="cmb_prefijo">
	      </select></td>	  	   
	    </tr>	          
	  </table>
	<table>
	  <tr>
	    <td width="178" class="Arial14Negro"><div align="center">Archivo</div></td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><input name="archivos" type="file" class="inputbox" id="archivos"></td>
	    </tr>
	  </table>
	<table>
	  <tr>
	    <td width="178" class="Arial14Negro"><div align="center">URL Google Docs</div></td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><input name="url_google" type="text" class="inputbox" id="url_google" /></td>
	    </tr>
	  </table>
<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
    
	<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="guardar_archivo" id="guardar_archivo" type="image" src="../img/btn_guardar.png"  /></div>    

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
</div>
</div>		
</body>
<script src="../includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="../includes/jquery.pnotify.js" type="text/javascript"></script>
<script src="../includes/Scripts_Calidad.js" type="text/javascript"></script>  
</html>

