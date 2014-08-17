<?php
session_start();
include ('../cnx/conexion_activos.php');
conectara();

$tipo_query = $_GET['USS_FX'];
$Activo ="";
$descripcion ="";
$modelo ="";
$serie ="";
$placa="";
$documento="";
$precio=0;
$id_marca =0;
$id_ubicacion =0;
$id_estado=0;
$id_categoria=0;
$id_modelo=0;
$id_responsable=0;
$prestamo=0;
$oaf = 0;
$factura="";

if($tipo_query!="0"){
	
	
	
	$select ="SELECT 
			LTRIM(IFNULL(ACT.Activo,'')) as Activo,
			LTRIM(IFNULL(ACT.descripcion,'')) as descripcion,
			LTRIM(IFNULL(ACT.modelo,'')) as modelo,
			LTRIM(IFNULL(ACT.serie,'')) as serie,
			LTRIM(IFNULL(ACT.placa,'')) as placa,
			LTRIM(IFNULL(ACT.precio,0)) as precio,
			LTRIM(IFNULL(ACT.documento,'')) as documento,
			IFNULL(MarcAct.id_marca,0) as id_marca,
			IFNULL(UbiAct.id_ubicacion,0) as id_ubicacion,
			IFNULL(ActEst.id_estado,0) as id_estado,
			IFNULL(ActCat.id_categoria,0) as id_categoria,
			IFNULL(res.id_persona,0) as id_persona,
			IFNULL(ACT.prestamo,0) as prestamo,
			IFNULL(ACT.oaf,0) as oaf,
			LTRIM(IFNULL(ACT.factura,'')) as factura
		FROM  tbl_activos as ACT
			LEFT OUTER JOIN tbl_marca_activo as MarcAct 			ON MarcAct.id_activo = ACT.id_activos
			LEFT OUTER JOIN tbl_ubicacion_activo as UbiAct		 	ON UbiAct.id_activo = ACT.id_activos
			LEFT OUTER JOIN tbl_activo_estado as ActEst		 		ON ActEst.id_activo = ACT.id_activos
			LEFT OUTER JOIN tbl_activo_categoria as ActCat		 	ON ActCat.id_activo = ACT.id_activos
			LEFT OUTER JOIN tbl_responsable as res		 			ON res.id_activo = ACT.id_activos
		where ACT.ID_ACTIVOS = " . $_GET['USS_FX'];
			
			
			
	$result=mysql_query($select,$_SESSION['conectact']);
	if ($result) { 
		while ($row=mysql_fetch_object($result)){
			$Activo =$row->Activo;
			$descripcion =$row->descripcion;
			$modelo =$row->modelo;
			$serie =$row->serie;
			$id_marca =$row->id_marca;
			$id_ubicacion =$row->id_ubicacion;
			$id_estado=$row->id_estado;
			$id_categoria=$row->id_categoria;
			$placa=$row->placa;
			$documento=$row->documento;
			$precio=$row->precio;
			$id_responsable=$row->id_persona;
			$prestamo=$row->prestamo;
			$oaf=$row->oaf;
			$factura=$row->factura;
		}
		
	
	}

}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel ="stylesheet" href="../css/activos.css" type="text/css" />        
        <link rel ="stylesheet" href="../css/cuadros.css" type="text/css" /> 
        <link rel ="stylesheet" href="../css/jquery.pnotify.default.css" type="text/css" />
        <link rel ="stylesheet" href="../css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css" />     
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">		
        <title>SIC CINA</title>  
    </head>
<body>    
<div class="header"></div>
<div class="box">
<div style="height:800px;" align="center">

<div class="contenido_gm">
<div style="margin-left:650px;  margin-top:0px; " ><a class="Arial14Azul" href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a class="Arial14Azul" href="activos.php">Men&uacute;</a>&nbsp;-&nbsp;<a class="Arial14Azul" href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">	
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Edici&oacute;n Activo</div>    

	<input type="hidden" name="tipo_query" id="tipo_query" value=" <?php  echo $tipo_query;  ?>">
	<input type="hidden" name="USUARIO" id="USUARIO" value="<?php  echo $_SESSION['nombre_usuario'];  ?>">
	<table style="width:700px;" border="0">
		<tr>
			<td class="Arial14Negro" colspan="2">
				Nombre del Activo
			</td>
		</tr>
		<tr>
			<td class="Arial14Negro" colspan="2">
				<input name="txt_activo" type="text" class="inputbox_largo_descripcion" id="txt_activo" maxlength="200" value="<?php
					if($Activo!=""){
						echo $Activo;				
					}				
				?>"/>
			</td>
		</tr>
		<tr>
			<td class="Arial14Negro" colspan="2">
				Descripci&oacute;n
			</td>
		</tr>
		<tr>
			<td class="Arial14Negro" colspan="2">
				<input name="txt_desc" type="text" class="inputbox_largo_descripcion" id="txt_desc" maxlength="200" value="<?php
					if($descripcion!=""){
						echo $descripcion;				
					}				
				?>"/>
			</td>
		</tr>
		<tr>
			<td align="center" class="Arial14Negro col_mitad" >
				Estado
			</td>
			<td align="center" class="Arial14Negro col_mitad" >
				Ubicaci&oacute;n
			</td>
		</tr>
		<tr>
			<td align="center"  class="Arial14Negro col_mitad" >
				<select name="cmb_estado" class="combos_activos" id="cmb_estado" >
					<option value="0">Seleccione</option>
					
					<?php
						$query="select * from tbl_estado order by 2";
						$query_result=mysql_query($query,$_SESSION['conectact']);
						
						if($query_result){
							while($row = mysql_fetch_array($query_result))
							{	
								if($id_estado==$row[0]){
									echo '<option selected value="' . $row[0] . '">' . $row[1] . '</option>';
								}else{
									echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
								}
							}
						}
					
					?>				
					
				</select>
			</td>
			<td align="center" class="Arial14Negro col_mitad" >
				<select name="cmb_ubicacion" class="combos_activos" id="cmb_ubicacion" >
					<option value="0">Seleccione</option>
					
					<?php
						$query="select * from tbl_ubicacion order by 2";
						$query_result=mysql_query($query,$_SESSION['conectact']);
						
						if($query_result){
							while($row = mysql_fetch_array($query_result))
							{	
								if($id_ubicacion==$row[0]){
									echo '<option selected value="' . $row[0] . '">' . $row[1] . '</option>';
								}else{
									echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
								}
							}
						}
					
					?>	
					
				</select>
			</td>
		</tr>
		
		<tr>
			<td align="center" class="Arial14Negro col_mitad" >
				Categoria
			</td>
			<td align="center" class="Arial14Negro col_mitad" >
				Marca
			</td>
		</tr>
		<tr>
			<td align="center"  class="Arial14Negro col_mitad" >
				<select name="cmb_categoria" class="combos_activos" id="cmb_categoria" >
					<option value="0">Seleccione</option>
					
					<?php
						$query="select * from tbl_categoria order by 2";
						$query_result=mysql_query($query,$_SESSION['conectact']);
						
						if($query_result){
							while($row = mysql_fetch_array($query_result))
							{	
								if($id_categoria==$row[0]){
									echo '<option selected value="' . $row[0] . '">' . $row[1] . '</option>';
								}else{
									echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
								}
							}
						}
					
					?>	
					
				</select>	
			</td>
			<td align="center" class="Arial14Negro col_mitad" >
				<select name="cmb_marca" class="combos_activos" id="cmb_marca" >
					<option value="0">Seleccione</option>
					
					<?php
						$query="select * from tbl_marca order by 2";
						$query_result=mysql_query($query,$_SESSION['conectact']);
						
						if($query_result){
							while($row = mysql_fetch_array($query_result))
							{	
								if($id_marca==$row[0]){
									echo '<option selected value="' . $row[0] . '">' . $row[1] . '</option>';
								}else{
									echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
								}
							}
						}
					
					?>	
					
					
				</select>	
			</td>
		</tr>
		<tr>
			<td align="center" class="Arial14Negro col_mitad" >
				Modelo
			</td>
			<td align="center" class="Arial14Negro col_mitad" >
				Serie
			</td>
		</tr>
		<tr>
			<td align="center"  class="Arial14Negro col_mitad" >
				<input name="txt_modelo" type="text" class="inputbox_largo" id="txt_modelo" value="<?php
					if($modelo!=""){
						echo $modelo;				
					}				
				?>"/>
			</td>
			<td align="center" class="Arial14Negro" >
				<input name="txt_serie" type="text" class="inputbox_largo" id="txt_serie" value="<?php
					if($serie!=""){
						echo $serie;				
					}				
				?>"/>
			</td>
		</tr>
		
		
		<tr>
			<td align="center" class="Arial14Negro col_mitad" >
				Placa
			</td>
			<td align="center" class="Arial14Negro col_mitad" >
				Precio
			</td>
		</tr>
		<tr>
			<td align="center"  class="Arial14Negro col_mitad" >
				<input name="txt_placa" type="text" class="inputbox_largo" id="txt_placa" value="<?php
					if($placa!=""){
						echo $placa;				
					}				
				?>"/>
			</td>
			<td align="center" class="Arial14Negro" >
				<input name="txt_precio" type="text" class="inputbox_largo" id="txt_precio" maxlength="15" value="<?php
					if($precio!=""){
						echo $precio;				
					}				
				?>"/>
			</td>
		</tr>
		
		
		
		<tr>
			<td align="center" class="Arial14Negro col_mitad" >
				N° de Documento
			</td>
			<td align="center" class="Arial14Negro col_mitad" >
				Responsable
			</td>
		</tr>
		<tr>
			<td align="center"  class="Arial14Negro col_mitad" >
				<input name="txt_documento" type="text" class="inputbox_largo" id="txt_documento" maxlength="45" value="<?php
					if($documento!=""){
						echo $documento;				
					}				
				?>"/>
			</td>
			<td align="center"  class="Arial14Negro col_mitad" >
				<select name="cmb_res" class="combos_activos" id="cmb_res" >
					<option value="0">Seleccione</option>
					
					<?php
						$query="select * from tbl_persona order by 2";
						$query_result=mysql_query($query,$_SESSION['conectact']);
						
						if($query_result){
							while($row = mysql_fetch_array($query_result))
							{	
								if($id_responsable==$row[0]){
									echo '<option selected value="' . $row[0] . '">' . $row[1] . '</option>';
								}else{
									echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
								}
							}
						}
					
					?>				
					
				</select>
			</td>
		</tr>
		
		
		<tr>
			<td align="center" class="Arial14Negro col_mitad" >
				En Prestamo
			</td>
			<td align="center" class="Arial14Negro col_mitad" >
				Oficina Financiera
			</td>
		</tr>
		<tr>
			<td align="center"  class="Arial14Negro col_mitad" >
				<select name="cmb_pres" class="combos_activos" id="cmb_pres" >

					<?php
						if($prestamo==0){
							echo '<option value="0">NO</option>
								 <option value="1">SI</option>';
						}elseif($prestamo==1){
							echo '<option value="0">NO</option>
								 <option selected value="1">SI</option>';
						}
					
					?>				
					
				</select>
			</td>
			<td align="center"  class="Arial14Negro col_mitad" >
				<select name="cmb_oaf" class="combos_activos" id="cmb_oaf" >

					<?php
						if($oaf==0){
							echo '<option value="0">NO</option>
								 <option value="1">SI</option>';
						}elseif($oaf==1){
							echo '<option value="0">NO</option>
								 <option selected value="1">SI</option>';
						}
					
					?>				
					
				</select>
			</td>
		</tr>
		<tr>
			<td align="center" class="Arial14Negro col_mitad" >
				Factura
			</td>
			<td align="center" class="Arial14Negro col_mitad" >
				
			</td>
		</tr>
		<tr>
			<td align="center"  class="Arial14Negro col_mitad" >
				<input name="txt_factura" type="text" class="inputbox_largo" id="txt_factura" maxlength="45" value="<?php
					if($factura!=""){
						echo $factura;				
					}				
				?>"/>
			</td>
			<td align="center"  class="Arial14Negro col_mitad" >
				
			</td>
		</tr>
		
		<tr>
			<td class="Arial14Negro" >
					<div align="center" style="margin-top:20px; margin-bottom:20px;">
						<input name="btn_cancelar_activo" id="btn_cancelar_activo" type="image" src="../img/btn_cancelar.png"  />
					</div>    
			</td>
			<td class="Arial14Negro" colspan="1">
					<div align="center" style="margin-top:20px; margin-bottom:20px;">
						<input name="btn_guardar_activo" id="btn_guardar_activo" type="image" src="../img/btn_guardar.png"  />
					</div>    
			</td>
		</tr>
	</table>
 







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
<script src="../includes/Scripts_Activo.js" type="text/javascript"></script>  
<script src="../includes/datetimepicker_css.js"></script>


</html>

