<?php
session_start();
include ('../cnx/conexion_activos.php');
conectara();

$query="select detalle,fecha,opcion,usuario from tbl_historico_activos
order by 2 desc";
		
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
<div style="height:2000px;" align="center">

<div class="contenido_gm_reporte_activos">
<div style="margin-left:350px;  margin-top:0px; " ><a class="link_volver Arial14Azul" href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a class="link_volver Arial14Azul" href="activos.php">Men&uacute;</a>&nbsp;-&nbsp;<a class="link_volver Arial14Azul" href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:950px;" align="center">	
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Reporte:  Historico</div>    
	</br>
	
<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
	<div align="left" style="text-align:left">
		<a class="Arial14Azul" href="#" id="ExcelExp" >  <img src="../img/microsoft_excel.png" alt="delete" height="19" width="19"> Exportar a Excel </a>
	</div>
	
	<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" value="" />
	<input type="hidden" id="Nombre" name="Nombre" value="ReporteHistorico" />
	<div id="tabla_datos">
	<?php
		
		if($query_result){
				
				echo '
				<div class="Tabla_Lista" >
                <table id="tabla_datost" border="1">
                    <tr>
                        <td align="center" style="background:#7f7f7f">
                           Detalle
                        </td>
                        <td align="center" style="background:#7f7f7f">
                           Fecha
                        </td>
                        <td align="center" style="background:#7f7f7f">
                          Opcion
                        </td>
						<td align="center" style="background:#7f7f7f">
                           Usuario
                        </td>
						
                    </tr>';
				
				$contador = 0;
				
				while($row = mysql_fetch_array($query_result))
				{
					echo'
					 <tr>
						<td align="left">' .
							 utf8_encode($row[0]) .
						'</td>
                        <td align="left">' .
                           ($row[1]) .
                        '</td>
                        <td align="left">' .
                           utf8_encode($row[2]) .
                        '</td>
                        <td align="left">' .
						    utf8_encode($row[3]) .
                        '</td>
					</tr>';
					
					$contador  = $contador + 1;
				}
				
				echo'
					 <tr>
						<td colspan="4" align="center">' .
							'Total : ' . $contador .
						'</td>
					 </tr>';
				
				
				echo '
				</table>
				</div';
				
		}
	?>
	</div>
	 
</div><!--fin cuadro blanco--> 
</form>
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
<script src="../includes/Scripts_Activo.js" type="text/javascript"></script>  
<script src="../includes/datetimepicker_css.js"></script>
</html>