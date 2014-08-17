<?php
session_start();
include ('../cnx/conexion_activos.php');
conectara();

$query="SELECT ACT.ID_ACTIVOS,ACT.Activo,marc.marca,ACT.modelo,ACT.serie FROM  tbl_activos as ACT
		LEFT OUTER JOIN tbl_marca_activo as MarcAct ON MarcAct.id_activo = ACT.id_activos
		LEFT OUTER JOIN tbl_marca as marc		 	ON MarcAct.id_marca = marc.id_marca";
		
$query_result=mysql_query($query,$_SESSION['conectact']);
        



?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel ="stylesheet" href="../css/activos.css" type="text/css" />        
        <link rel ="stylesheet" href="../css/cuadros.css" type="text/css" /> 
        <link rel ="stylesheet" href="../css/jquery.pnotify.default.css" type="text/css" />
        <link rel ="stylesheet" href="../css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css" />        
        <title>SIC CINA</title>  
    </head>
<body>    
<div class="header"></div>
<div class="box">
<div style="height:800px;" align="center">

<div class="contenido_gm">
<div style="margin-left:650px;  margin-top:0px; " ><a class="link_volver" href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a class="link_volver" href="activos.php">Men&uacute;</a>&nbsp;-&nbsp;<a class="link_volver" href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">	
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Lista de Activos</div>    
	</br>

<div align="left">
	<a class="btn" href="javascript:abrir_cerrar_buscador_activo()">
		<img src="../img/search_verde.png" alt="Smiley face" height="25" width="25">
	</a>
	<a class="btn" href="javascript:abrir_cerrar_buscador_activo()"><span class="Arial14Azul" id="titulo_buscador_activos">Buscador</span></a> &nbsp; &nbsp; &nbsp; &nbsp;<img src="../img/add_icon.png" alt="add" height="23" width="23"> <a class="btn Arial14Azul" href="../activos/nuevo_archivo.php?USS_FX=0">Crear Activo</a>
</div>
	

<div style="display:none" id="busqueda">
<div class="Tabla_busqueda" >	
	<table border="0"> 
	   <tr>
		
	    <td class="Arial14Negro">
			Activo
		</td>	
		<td  class="Arial14Negro">
			Marca
		</td>
		<td  class="Arial14Negro">
			Serie
		</td>		
	  </tr>	
	  <tr>
		
	    <td  class="Arial14Negro">
			<input name="txt_nombre" type="text" class="inputbox" id="txt_nombre" onkeypress="return busqueda_activo(event)" />
		</td>	
		<td  class="Arial14Negro">
			<input name="txt_marca" type="text" class="inputbox" id="txt_marca" onkeypress="return busqueda_activo(event)" />
		</td>
		<td  class="Arial14Negro">
			<input name="txt_serie" type="text" class="inputbox" id="txt_serie" onkeypress="return busqueda_activo(event)" />
		</td>		
	  </tr>	
		
	</table>
	</br>
</div>
</div>            
	
	
	
	<div id="tabla_datos">
	<?php
		
		if($query_result){
				
				echo '
				<div class="Tabla_Lista" >
                <table>
                    <tr>
                        <td>
                           Editar
                        </td>
                        <td >
                            Activo
                        </td>
                        <td>
                           Marca
                        </td>
						<td>
                           Serie
                        </td>
						<td>
                           Eliminar
                        </td>
                    </tr>';
					
				while($row = mysql_fetch_array($query_result))
				{
					echo'
					 <tr>
						<td style="width:10%" align="center">
							<div>
								<a class="lnk_grid" href="../activos/nuevo_archivo.php?USS_FX=' . $row[0] . '">Sel.</a>
							</div>
						</td>
                        <td align="center">' .
                           $row[1] .
                        '</td>
                        <td align="center">' .
                           $row[2] .
                        '</td>
                        <td align="center">' .
                             $row[4] .
                        '</td>
						<td style="width:10%" style align="center">
							<a id="myLink" href="javascript:Eliminar_activo(' .  $row[0]  . ');">
									<img src="../img/delete.png" alt="delete" height="19" width="19">
							</a>
                        </td>
                    </tr>';
				}
				
				echo '
				</table>
				</div';
				
		}
	?>
	</div>
	 
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
<script src="../includes/Scripts_Activo_Simple.js" type="text/javascript"></script>  
<script src="../includes/datetimepicker_css.js"></script>
</html>
