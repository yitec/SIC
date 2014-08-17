<?php
session_start();
include ('../cnx/conexion_activos.php');
conectara();

$query="
SELECT PED.ID_PEDIDO, ACT.ACTIVO,PER.NOMBRE,DATE_FORMAT(PED.FECHA_PEDIDO,'%d/%m/%Y') AS FECHA_PEDIDO,PED.ACTIVO FROM tbl_pedido AS PED
INNER JOIN tbl_activos AS ACT 		ON ACT.ID_ACTIVOS =  PED.ID_ACTIVO
INNER JOIN tbl_persona AS PER		ON PER.ID_PERSONA =  PED.ID_PERSONAL
order by PED.ACTIVO
";
		
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
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	
        <title>SIC CINA</title>  
    </head>
<body>    
<div class="header"></div>
<div class="box">
<div style="height:800px;" align="center">

<div class="contenido_gm">
<div style="margin-left:650px;  margin-top:0px; " ><a class="link_volver Arial14Azul" href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a class="link_volver Arial14Azul" href="../menu.php">Men&uacute;</a>&nbsp;-&nbsp;<a class="link_volver Arial14Azul" href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">	
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Lista de Pedidos</div>    
	</br>

<div align="left">

	<a id="lnk_busca_pedido" href="#"><img src="../img/search_verde.png" alt="Smiley face" height="25" width="25"><span class="Arial14Azul" id="titulo_busca_pedido">Buscador</span></a> 
	&nbsp; &nbsp; &nbsp; &nbsp;
	<img src="../img/add_icon.png" alt="add" height="23" width="23"> <a class="btn Arial14Azul" href="../activos/nuevo_pedido.php?USSP=0">Agregar Pedido</a>
</div>
	
<input type="hidden" id="FECHA" name="FECHA" value="">
<input type="hidden" name="ACCION" id="ACCION" value="B">


<div style="display:none" id="div_busca_pedido">
<div>	
	<table border="0" style="width:100%"> 
	   <tr>
		
	    <td colspan="2">
			<span class="Arial14Negro">Responsable</span>
		</td>	
	  </tr>	
	  <tr>		
	    <td colspan="2"  class="Arial14Negro">
			<input name="txt_busca_nombre_pedido" type="text" class="inputbox_ubicacion" id="txt_busca_nombre_pedido" maxlength="50" />
		</td>
	   <tr>
			</br>
	   </tr>	
	  </tr>	
	  <tr>
		
	    <td colspan="2" class="Arial14Negro">
			Activo
		</td>	
	  </tr>
	   <tr>		
	    <td colspan="2" >
			<input name="txt_busca_activo_pedido" type="text" class="inputbox_ubicacion" id="txt_busca_activo_pedido"  maxlength="45" />
		</td>			
	  </tr>
	  <tr>
	    <td  class="Arial14Negro col_mitad">
			Fecha Pedido
		</td>			
	    <td  class="Arial14Negro col_mitad">
			Estado de Pedido
		</td>	
	  </tr>

	  
	  <tr>
		<td  class="Arial14Negro col_mitad">
			<input name="txt_fecha_pedido" readonly type="text" class="inputbox_largo" id="txt_fecha_pedido" maxlength="50" />
		</td>
		<td>
			<select name="cmb_busca_activo_persona" class="combos_activos " id="cmb_busca_activo_persona" >
				<option  value="">TODOS</option>
				<option  value="0">PENDIENTE</option>
				<option  value="1">APROBADA</option>
			</select>
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
  
                        <td style="width:16%" >
                            Activo
                        </td>
                        <td style="width:16%">
                          Responsable
                        </td>
						<td style="width:16%">
                           Fecha de Petici&oacute;n
                        </td>
						<td style="width:16%">
                           Estado de Petici&oacute;n
                        </td>

                    </tr>';
					
				while($row = mysql_fetch_array($query_result))
				{
				
					if($row[4] ==0){
						$tipo='  <img src="../img/alert.png" alt="delete" height="19" width="19"> </br> Pendiente';
					}elseif($row[4] ==1){
						$tipo='<img src="../img/alert_verde.png" alt="delete" height="19" width="19"> </br> Aprobado';
					}elseif($row[4] ==2){
						$tipo='<img src="../img/eliminar_negro.png" alt="delete" height="19" width="19"> </br> Rechazada';
					}
				
					echo'
					 <tr>
						<td style="display:none">
							<input type="hidden" name="ID_' . $row[0] . '" id="ID_' . $row[0] . '" value="' . $row[0] . '">
						</td>
	
                        <td align="center">' .
                           $row[1] .
                        '</td>
                        <td align="center">' .
                           $row[2] .
                        '</td>
                        <td align="center">' .
						    $row[3] .
                        '</td>
						 <td align="center">' .
						    $tipo . 
                        '</td>
		
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
<script src="../includes/Scripts_Activo.js" type="text/javascript"></script>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script src="../includes/datetimepicker_css.js"></script>
</html>
