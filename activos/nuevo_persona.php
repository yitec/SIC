<?php
session_start();
include ('../cnx/conexion_activos.php');
conectara();

$tipo_query = $_GET['USSP'];

$nombre="";
$identificacion ="";
$tipo=0;
$descripcion="";
$accion="";
if($tipo_query!="0"){
	
	$v_datos=explode("_",$tipo_query);
	
	$accion = $v_datos[0];
	$ID 	= $v_datos[1];
	
	$select ="select * from tbl_persona where id_persona =" . $ID;
			

	
	$result=mysql_query($select,$_SESSION['conectact']);
	if ($result) { 
		while ($row=mysql_fetch_object($result)){
			
			$nombre = utf8_encode($row->Nombre);
			$identificacion =$row->identificacion;
			$tipo=$row->tipo;
			$descripcion=utf8_encode($row->descripcion);
			$email = $row->email;
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
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Edici&oacute;n Persona</div>    

	<input type="hidden" name="ACCION" id="ACCION" value="<?php  echo $accion;  ?>">
	<input type="hidden" name="ID" id="ID" value="<?php  echo $ID;  ?>">
	<input type="hidden" name="USUARIO" id="USUARIO" value="<?php  echo $_SESSION['nombre_usuario'];  ?>">	
	<table style="width:700px;" border="0">
		<tr>
			<td class="Arial14Negro" colspan="2">
				Nombre 
			</td>
		</tr>
		<tr>
			<td class="Arial14Negro" colspan="2">
				<input <?php if($accion=="D"){ echo 'readonly';} ?> name="txt_nombre_persona" type="text" class="inputbox_largo_descripcion" id="txt_nombre_persona" maxlength="50" value="<?php
					if($nombre!=""){
						echo $nombre;				
					}				
				?>"/>
			</td>
		</tr>
		
		<tr>
			<td align="left" class="Arial14Negro col_mitad" >
				Identificaci&oacute;n
			</td>
			<td align="left" class="Arial14Negro col_mitad" >
				Tipo
			</td>
		</tr>
		
		<tr>
			<td align="left"  class="Arial14Negro col_mitad" >
				<input <?php if($accion=="D"){ echo 'readonly';} ?> name="txt_ident_persona" type="text" class="inputbox_largo" id="txt_ident_persona" value="<?php
					if($identificacion!=""){
						echo $identificacion;				
					}				
				?>"/>
			</td>
			<td align="right" class="Arial14Negro col_mitad" >
				<select <?php if($accion=="D"){ echo 'disabled';} ?> name="cmb_iden_persona" class="combos_persona" id="cmb_iden_persona" >
					<option <?php if($tipo==0){ echo "selected";} ?> value="0">MAG</option>
					<option <?php if($tipo==1){ echo "selected";} ?> value="1">CINA</option>
					<option <?php if($tipo==1){ echo "selected";} ?> value="2">Reparacion</option>
					<option <?php if($tipo==1){ echo "selected";} ?> value="3">Prestamo</option>
					<option <?php if($tipo==1){ echo "selected";} ?> value="4">Donacion</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td class="Arial14Negro" colspan="2">
				Descripci&oacute;n
			</td>
		</tr>
		<tr>
			<td class="Arial14Negro" colspan="2">
				<input <?php if($accion=="D"){ echo 'readonly';} ?> name="txt_desc_persona" type="text" class="inputbox_largo_descripcion" id="txt_desc_persona" maxlength="150" value="<?php
					if($descripcion!=""){
						echo $descripcion;				
					}				
				?>"/>
			</td>
		</tr>

		<tr>
			<td class="Arial14Negro" colspan="2">
				Email
			</td>
		</tr>
		<tr>
			<td class="Arial14Negro" colspan="2">
				<input <?php if($accion=="D"){ echo 'readonly';} ?> name="txt_email_persona" type="text" class="inputbox_largo_descripcion" id="txt_email_persona" maxlength="100" value="<?php
					if($email!=""){
						echo $email;				
					}				
				?>"/>
			</td>
		</tr>
		
		
		
		
		<tr>
			<td class="Arial14Negro" >
					<div align="center" style="margin-top:20px; margin-bottom:20px;">
						<input name="btn_cancelar_persona" id="btn_cancelar_persona" type="image" src="../img/btn_cancelar.png"  />
					</div>    
			</td>
			<td class="Arial14Negro" >
					<div align="center" style="margin-top:20px; margin-bottom:20px;">
						<input name="btn_guardar_persona" id="btn_guardar_persona" type="image" src="<?php
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
<script src="../includes/Scripts_Activo.js" type="text/javascript"></script>  
<script src="../includes/datetimepicker_css.js"></script>


</html>

