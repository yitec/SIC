<?php
session_start();
include ('../cnx/conexion_activos.php');
conectara();

$tipo_query = $_GET['USSP'];
$accion="";
$activo="";
$nombre ="";
$fecha="";
$status="";
$fecha_larga="";
$id_activo ="";
$id_personal ="";
$descripcion ="";
if($tipo_query!="0"){
	
	$v_datos=explode("_",$tipo_query);
	
	$accion = $v_datos[0];
	$ID 	= $v_datos[1];
	
	$select ="
	SELECT ACT.ACTIVO,PER.NOMBRE,PED.FECHA_PEDIDO,IFNULL(PED.ACTIVO,0) AS ACTIVO, DATE_FORMAT(PED.FECHA_PEDIDO, '%W,%d,%M,%Y') AS FECHA_LARGA,
	PED.ID_ACTIVO,PED.ID_PERSONAL,PED.DESCRIPCION FROM tbl_pedido AS PED
	INNER JOIN tbl_activos AS ACT 		ON ACT.ID_ACTIVOS =  PED.ID_ACTIVO
	INNER JOIN tbl_persona AS PER		ON PER.ID_PERSONA =  PED.ID_PERSONAL
	WHERE PED.ID_PEDIDO = " . $ID;

	$result=mysql_query($select,$_SESSION['conectact']);
	if ($result) { 
		while ($row=mysql_fetch_object($result)){
			$activo=$row->ACTIVO;
			$nombre =$row->NOMBRE;
			$fecha=$row->FECHA_PEDIDO;
			$status=$row->ACTIVO;
			$fecha_larga=$row->FECHA_LARGA;
			$id_activo = $row->ID_ACTIVO;
			$id_personal = $row->ID_PERSONAL;
			$descripcion = $row->DESCRIPCION;
			if($fecha_larga!=""){
			
				$v_fecha =explode(",",$fecha_larga); 
				
				if(strtoupper($v_fecha[0])=="MONDAY"){
					$dia ="Lunes";
				}elseif(strtoupper($v_fecha[0])=="TUESDAY"){
					$dia ="Martes";
				}elseif(strtoupper($v_fecha[0])=="WEDNESDAY"){
					$dia ="Miercoles";
				}elseif(strtoupper($v_fecha[0])=="THURSDAY"){
					$dia ="Jueves";
				}elseif(strtoupper($v_fecha[0])=="FRIDAY"){
					$dia ="Viernes";
				}elseif(strtoupper($v_fecha[0])=="SATURDAY"){
					$dia ="Sabado";
				}elseif(strtoupper($v_fecha[0])=="SUNDAY"){
					$dia ="Domingo";
				}
				
				
				if(strtoupper(trim($v_fecha[2]))=="JANUARY "){
					$mes = "Enero";
				}elseif(strtoupper(trim($v_fecha[2]))=="FEBRURARY "){
					$mes = "Febrero";
				}elseif(strtoupper(trim($v_fecha[2]))=="MARCH"){
					$mes = "Marzo";
				}elseif(strtoupper(trim($v_fecha[2]))=="APRIL "){
					$mes = "Abril";
				}elseif(strtoupper(trim($v_fecha[2]))=="MAY"){
					$mes = "Mayo";
				}elseif(strtoupper(trim($v_fecha[2]))=="JUNE"){
					$mes = "Junio";
				}elseif(strtoupper(trim($v_fecha[2]))=="JULY"){
					$mes = "Julio";
				}elseif(strtoupper(trim($v_fecha[2]))=="AUGUST"){
					$mes = "Agosto";
				}elseif(strtoupper(trim($v_fecha[2]))=="SEPTEMBER"){
					$mes = "Septiembre";
				}elseif(strtoupper(trim($v_fecha[2]))=="OCTOBER"){
					$mes = "Octubre";
				}elseif(strtoupper(trim($v_fecha[2]))=="NOVEMBER"){
					$mes = "Noviembre";
				}elseif(strtoupper(trim($v_fecha[2]))=="DECEMBER"){
					$mes = "Diciembre";
				}
				
				$fecha_larga = $dia . ", " . $v_fecha[1] . " " . $mes . ", " . $v_fecha[3];
				
			}
			
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
		<link rel ="stylesheet" href="../css/jquery-ui/jquery-ui-1.10.4.css" type="text/css" />    
			
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
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Edici&oacute;n de Petici&oacute;n</div>    

	<input type="hidden" name="ACCION" id="ACCION" value="<?php  echo $accion;  ?>">
	<input type="hidden" name="ID" id="ID" value="<?php  echo $ID;  ?>">
	<input type="hidden" name="FECHA" id="FECHA" value="<?php  echo $fecha;  ?>">
	<input type="hidden" name="FECHA_LARGA" id="FECHA_LARGA" value="<?php  echo $fecha_larga;  ?>">
	<input type="hidden" name="USUARIO" id="USUARIO" value="<?php  echo $_SESSION['nombre_usuario'];  ?>">
	
	
	<table style="width:700px;" border="0">
		<tr>
			<td class="Arial14Negro" colspan="2">
				Responsable
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2" class="Arial14Negro col_mitad" >
				<select <?php if($accion=="D"||$accion=="A"){ echo " disabled "; } ?>  name="cmb_persona_pedido_guardar" class="combos_persona" id="cmb_persona_pedido_guardar" >
					<option  value="0">Seleccione un Responsable</option>
					<?php
						$select = "select ID_PERSONA,NOMBRE from tbl_persona order by NOMBRE";
						$result=mysql_query($select,$_SESSION['conectact']);
						if ($result) { 
							
								while ($row=mysql_fetch_object($result)){
									if($id_personal==$row->ID_PERSONA){
										echo '<option selected  value="' . $row->ID_PERSONA .'">' . $row->NOMBRE . '</option>';
									}else{
										echo '<option value="' . $row->ID_PERSONA .'">' . $row->NOMBRE . '</option>';
									}
								}
							
						}

					?>
				</select>
	
			</td>
		</tr>
		
		<tr>
			<td class="Arial14Negro" colspan="2">
				Activo
			</td>
		</tr>
		
		<tr>
			<td colspan="2" align="right" class="Arial14Negro col_mitad" >
				<select <?php if($accion=="D"||$accion=="A"){ echo " disabled "; } ?>  name="cmb_activo_pedido_guardar" class="combos_persona" id="cmb_activo_pedido_guardar" >
					<option  value="0">Seleccione un Activo</option>
					<?php
						$select = "select ID_ACTIVOS,ACTIVO,PLACA from tbl_activos";
						$result=mysql_query($select,$_SESSION['conectact']);
						if ($result) { 
							
								while ($row=mysql_fetch_object($result)){
									if($id_activo==$row->ID_ACTIVOS){
										echo '<option selected  value="' . $row->ID_ACTIVOS .'">' . $row->ACTIVO . '  -****-    PLACA [' . $row->PLACA . ']</option>';
									}else{
										echo '<option value="' . $row->ID_ACTIVOS .'">' . $row->ACTIVO . '     PLACA [' . $row->PLACA . ']</option>';
									}
								}
							
						}

					?>
				</select>
			</td>

		</tr>
		
		<tr>
			<td class="Arial14Negro" colspan="2">
				Fecha en la que se requiere el activo
			</td>
		</tr>
		<tr>
			<td class="Arial14Negro" colspan="2">
				<input <?php if($accion=="D"||$accion=="A"){ echo " disabled "; } ?> name="txt_fecha_pedido"  type="text" class="inputbox_largo_descripcion" id="txt_fecha_pedido" maxlength="50" value="<?php echo $fecha_larga; ?>" />
				
			</td>
		</tr>

		<?php 
			if($accion=="D"||$accion=="E"){
				
				if($accion=="D"){ 
					$deshabilitar = "disabled"; 
				}
				
				
				echo
					'<tr>
						<td class="Arial14Negro" colspan="2">
							Estado de Petici&oacute;n 
						</td>
					</tr>
					<tr >
						<td class="Arial14Negro" colspan="2">
							<select ' . $deshabilitar . '  name="cmb_activo_pedido_estado" class="combos_persona" id="cmb_activo_pedido_estado" >';
							
								if($status==0){
									echo '<option selected value="0">PENDIENTE</option>';
									echo '<option  value="1">APROBADA</option>';
									echo '<option  value="2">RECHAZADA</option>';
								}elseif($status==1){
									echo '<option  value="0">PENDIENTE</option>';
									echo '<option  selected value="1">APROBADA</option>';
									echo '<option  value="2">RECHAZADA</option>';
								}elseif($status==2){
									echo '<option   value="0">PENDIENTE</option>';
									echo '<option   value="1">APROBADA</option>';
									echo '<option selected  value="2">RECHAZADA</option>';
								}
							echo
						   '</select>
						</td>
					</tr>';
			}
		?>		

		<tr>
			<td class="Arial14Negro" colspan="2">
				Descripci&oacute;n 
			</td>
		</tr>
		<tr>
			<td class="Arial14Negro" colspan="2">
				<textarea <?php if($accion=="D"||$accion=="A"){ echo " readonly "; } ?> name="txt_descripcion_pedido_guardar" id="txt_descripcion_pedido_guardar" style="width:100%;resize: none;"  cols="20" rows="3" maxlength="150"><?php echo $descripcion; ?></textarea>
			</td>
		</tr>
						
		<tr>
			<td class="Arial14Negro" >
					<div align="center" style="margin-top:20px; margin-bottom:20px;">
						<input name="btn_cancelar_pedido" id="btn_cancelar_pedido" type="image" src="../img/btn_cancelar.png"  />
					</div>    
			</td>
			<td class="Arial14Negro" >
					<div align="center" style="margin-top:20px; margin-bottom:20px;">
						<input name="btn_guardar_pedido" id="btn_guardar_pedido" type="image" src="<?php
							if($accion=="D"){
								echo '../img/btn_eliminar.png';
							}else{
								echo '../img/btn_guardar.png';
							}
							?>"/>
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
<script src="../includes/jquery-ui-1.10.4.js" type="text/javascript"></script>
<script src="../includes/datetimepicker_css.js"></script>
<script src="../includes/Scripts_Activo.js" type="text/javascript"></script>  



</html>

