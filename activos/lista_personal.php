<?php
session_start();
include ('../cnx/conexion_activos.php');
conectara();

$query="SELECT * from tbl_persona
order by 2";
		
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
<div style="margin-left:650px;  margin-top:0px; " ><a class="link_volver Arial14Azul" href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a class="link_volver Arial14Azul" href="activos.php">Men&uacute;</a>&nbsp;-&nbsp;<a class="link_volver Arial14Azul" href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">	
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Lista de Personas</div>    
	</br>

<div align="left">

	<a id="lnk_busca_persona" href="#"><img src="../img/search_verde.png" alt="Smiley face" height="25" width="25"><span class="Arial14Azul" id="titulo_busca_persona">Buscador</span></a> 
	&nbsp; &nbsp; &nbsp; &nbsp;
	<img src="../img/add_icon.png" alt="add" height="23" width="23"> <a class="btn Arial14Azul" href="../activos/nuevo_persona.php?USSP=0">Agregar Persona</a>
</div>
	

<div style="display:none" id="div_busca_persona">
<div>	
	<table border="0" style="width:100%"> 
	   <tr>
		
	    <td>
			<span class="Arial14Negro">Nombre</span>
		</td>	
	  </tr>	
	  <tr>		
	    <td  class="Arial14Negro">
			<input name="txt_nombre_persona" title="Para seleccionar FECHA, hacer click en esta caja de texto" type="text" class="inputbox_ubicacion" id="txt_nombre_persona" maxlength="50" />
		</td>
	   <tr>
			</br>
	   </tr>	
	  </tr>	
	  <tr>
		
	    <td  class="Arial14Negro">
			Identificaci&oacute;n
		</td>	
	  </tr>
	   <tr>		
	    <td >
			<input name="txt_identi_persona" type="text" class="inputbox_ubicacion" id="txt_identi_persona"  maxlength="45" />
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
                            Nombre
                        </td>
                        <td>
                          Identificaci&oacute;n
                        </td>
						<td>
                           Tipo
                        </td>
						<td>
                           Eliminar
                        </td>
                    </tr>';
					
				while($row = mysql_fetch_array($query_result))
				{
				
					if($row[5] ==0){
						$tipo="interno";
					}else{
						$tipo="externo";
					}
				
					echo'
					 <tr>
						<td style="width:10%" align="center">
							<div>
								<a class="lnk_grid" href="../activos/nuevo_persona.php?USSP=E_' . $row[0] . '"><img src="../img/pencil.png" alt="delete" height="19" width="19"></a>
							</div>
						</td>
                        <td align="center">' .
                           utf8_encode($row[1]) .
                        '</td>
                        <td align="center">' .
                           $row[2] .
                        '</td>
                        <td align="center">' .
						    $tipo .
                        '</td>
						<td style="width:10%" style align="center">
							<a id="myLink" href="../activos/nuevo_persona.php?USSP=D_' . $row[0] . '">
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
<script src="../includes/Scripts_Activo.js" type="text/javascript"></script>  
<script src="../includes/datetimepicker_css.js"></script>
</html>
