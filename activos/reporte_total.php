<?php
session_start();
include ('../cnx/conexion_activos.php');
conectara();

$query="SELECT 
			LTRIM(IFNULL(ACT.Activo,'')) as Activo,
			LTRIM(IFNULL(ACT.descripcion,'')) as descripcion,
			LTRIM(IFNULL(ACT.modelo,'')) as modelo,
			LTRIM(IFNULL(ACT.serie,'')) as serie,
			LTRIM(IFNULL(ACT.placa,'')) as placa,
			LTRIM(IFNULL(ACT.precio,0)) as precio,
			LTRIM(IFNULL(ACT.documento,'')) as documento,
			IFNULL(marc.marca,'') as marca,
			IFNULL(ubi.ubicacion,'') as ubicacion,
			IFNULL(est.estado,'') as estado,
			IFNULL(cat.categoria,'') as categoria,
			DATE_FORMAT(ACT.fecha_creacion, '%d / %m / %Y') as fecha_creacion,
			IFNULL(ACT.oaf,0) as oaf
		FROM  tbl_activos as ACT
			LEFT OUTER JOIN tbl_marca_activo as MarcAct 			ON MarcAct.id_activo = ACT.id_activos
			LEFT OUTER JOIN tbl_ubicacion_activo as UbiAct		 	ON UbiAct.id_activo = ACT.id_activos
			LEFT OUTER JOIN tbl_activo_estado as ActEst		 		ON ActEst.id_activo = ACT.id_activos
			LEFT OUTER JOIN tbl_activo_categoria as ActCat		 	ON ActCat.id_activo = ACT.id_activos
			LEFT OUTER JOIN tbl_marca as marc		 				ON MarcAct.id_marca = marc.id_marca 
			LEFT OUTER JOIN tbl_ubicacion as ubi	 				ON UbiAct.id_ubicacion = ubi.id_ubicacion 
			LEFT OUTER JOIN tbl_estado as est	 					ON ActEst.id_estado = est.id_estado 
			LEFT OUTER JOIN tbl_categoria as cat 					ON ActCat.id_categoria = cat.id_categoria
			order by 1";
		
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
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Reporte:  Total de activos sumarizados</div>    
	</br>


	
<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
	<div align="left" style="text-align:left">
		<a class="link_volver Arial14Azul" href="#" id="ExcelExp"  >  <img src="../img/microsoft_excel.png" alt="delete" height="19" width="19"> Exportar a Excel </a>
	</div>

	<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" value="" />
	<input type="hidden" id="Nombre" name="Nombre" value="ReporteTotalActivos" />
	<div id="tabla_datos">
	<?php
		
		if($query_result){
				
				echo '
				<div class="Tabla_Lista" >
                <table id="tabla_datost" border="2">
                    <tr>
                        <td align="center" style="background:#7f7f7f">
                           Activo
                        </td>
                        <td align="center"  style="background:#7f7f7f" >
                           Modelo
                        </td >
                        <td align="center"  style="background:#7f7f7f">
                          Placa
                        </td>
						<td align="center"  style="background:#7f7f7f">
                           Precio
                        </td>
						<td align="center"  style="background:#7f7f7f">
                           Marca
                        </td>
						<td align="center"  style="background:#7f7f7f">
                           Ubicacion
                        </td>
						<td align="center"  style="background:#7f7f7f">
                           Estado
                        </td>
						<td align="center"  style="background:#7f7f7f">
                           Categoria
                        </td>
						<td align="center"  style="background:#7f7f7f">
                           Fecha Ingreso
                        </td>
						<td align="center"  style="background:#7f7f7f">
                           OAF
                        </td>
                    </tr>';
				
				$contador = 0;
				
				while($row = mysql_fetch_array($query_result))
				{
				
					if($row[12]==1){
						$oaf = "Si";
					}else{
						$oaf = "No";
					}
				
					echo'
					 <tr>
						<td style="width:20%" align="left">' .
							 utf8_encode($row[0]) .
						'</td>
                        <td align="center">' .
                           utf8_encode($row[2]) .
                        '</td>
                        <td align="center">' .
                           utf8_encode($row[4]) .
                        '</td>
                        <td align="center">' .
						    utf8_encode($row[5]) .
                        '</td>
						<td align="left">' .
							 utf8_encode($row[7]) .
                        '</td>
						<td align="left">' .
							 utf8_encode($row[8]) .
                        '</td>
						<td align="left">' .
							 utf8_encode($row[9]) .
                        '</td>
						<td align="left">' .
							 utf8_encode($row[10]) .
                        '</td>
						<td align="left">' .
							 utf8_encode($row[11]) .
                        '</td>
						<td align="center">' .
							$oaf .
                        '</td>
                    </tr>';
					
					$contador  = $contador + 1;
				}
				
				echo'
					 <tr>
						<td colspan="10" align="center">' .
							'Total de Activos: ' . $contador .
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
