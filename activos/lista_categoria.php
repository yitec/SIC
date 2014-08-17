<?php
session_start();
include ('../cnx/conexion_activos.php');
conectara();

$tipo_query = $_GET['USS_FX'];
$accion = "";
$ID = 0;
$categoria="";
$descripcion ="";

if($tipo_query!=""){

	$v_datos=explode("_",$tipo_query);
	
	$accion = $v_datos[0];
	$ID 	 = $v_datos[1];
	
	$query="SELECT * FROM tbl_categoria  where id_categoria=" .  $ID . " order by categoria";
	$query_result=mysql_query($query,$_SESSION['conectact']);
        
	if($query_result){
	
		while ($row=mysql_fetch_object($query_result)){
			$categoria = $row->categoria; 
			$descripcion = $row->descripcion;
		}

	}

}else{
	$query="SELECT * FROM tbl_categoria order by categoria";
	$query_result=mysql_query($query,$_SESSION['conectact']);        
}		

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
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;"> Lista de Categorias</div>    
	</br>

<div id="div_menu" style="visibility:<?php if($accion=="E" || $accion=="D" ){ echo "hidden"; }else{ echo "visible";} ?>" align="left">

	<a id="busca_cate" href="#"><img src="../img/search_verde.png" alt="Smiley face" height="25" width="25"><span class="Arial14Azul" id="titulo_buscador_categoria">Buscador</span></a> 
	&nbsp; &nbsp; &nbsp; &nbsp;
	<a id="guardar_cate" href="#"><img src="../img/add_icon.png" alt="add" height="23" width="23"><span class="Arial14Azul" id="titulo_crear_categoria">Crear Categoria</span></a>
</div>
	
<input type="hidden" name="tipo_query" id="tipo_query" value="<?php  echo $accion;  ?>">
<input type="hidden" name="ID_CATE" id="ID_CATE" value="<?php  echo $ID;  ?>">
<input type="hidden" name="USUARIO" id="USUARIO" value="<?php  echo $_SESSION['nombre_usuario'];  ?>">
<div style="display:<?php if($accion=="E" || $accion=="D" ){ echo "inline"; }else{ echo "none";} ?>" id="div_categoria_guardar">
<div>	
	<table border="0" style="width:100%"> 
	   <tr>
		
	    <td>
			<span class="Arial14Negro">Categoria</span>
		</td>	
	  </tr>	
	  <tr>		
	    <td  class="Arial14Negro">
			<input name="txt_nombre_guardar" <?php  if($accion=="D"){ echo  "readonly"; }   ?> type="text" class="inputbox_ubicacion" id="txt_nombre_guardar" maxlength="200" value="<?php
				if($accion=="E" || $accion=="D"){
					echo $categoria;

				}			
			?>"/>
		</td>
	   <tr>
			</br>
	   </tr>	
	  </tr>	
	  <tr>
		
	    <td  class="Arial14Negro">
			
			Descripci&oacute;n
		</td>	
	  </tr>
	   <tr>		
	    <td >
			<input name="txt_desc_cate_guardar" <?php  if($accion=="D"){ echo  "readonly"; }  ?> type="text" class="inputbox_ubicacion" id="txt_desc_cate_guardar"  maxlength="200" value="<?php
				if($accion=="E" || $accion=="D"){
					echo $descripcion;
				}			
			?>"/>
		</td>			
	  </tr>	
	  <tr>
		<td align="center">
			<input name="btn_cancelar_categoria" id="btn_cancelar_categoria" type="image" src="../img/btn_cancelar.png"  />
			<input name="btn_guardar_categoria" id="btn_guardar_categoria" type="image" src="<?php if($accion!="D"){ echo '../img/btn_guardar.png';}elseif($accion=="D"){ echo '../img/btn_eliminar.png';} ?>"  />
		</td>
	  </tr>
														
	</table>
	</br>
</div>
</div>      


<div style="display:none" id="div_categoria_buscar">
<div>	
	<table border="0" style="width:100%"> 
	   <tr>
		
	    <td>
			<span class="Arial14Negro">Categoria</span>
		</td>	
	  </tr>	
	  <tr>		
	    <td  class="Arial14Negro">
			<input name="txt_nombre_buscar" type="text" class="inputbox_ubicacion" id="txt_nombre_buscar" maxlength="200" />
		</td>
	   <tr>
			</br>
	   </tr>	
	  </tr>	
	  <tr>
		
	    <td  class="Arial14Negro">
			
			Descripci&oacute;n
		</td>	
	  </tr>
	   <tr>		
	    <td >
			<input name="txt_desc_cate_buscar" type="text" class="inputbox_ubicacion" id="txt_desc_cate_buscar"  maxlength="200" />
		</td>			
	  </tr>	
	  		
	</table>
	</br>
</div>
</div>



	
	<div id="tabla_datos" style="display:<?php if($accion=="E" || $accion=="D" ){ echo "none"; }else{ echo "inline";} ?>">
	<?php
		
		$query_result=mysql_query($query,$_SESSION['conectact']);
		if($query_result){
				
				echo '
				<div class="Tabla_Lista" >
                <table>
                    <tr>
                        <td>
                           Editar
                        </td>
                        <td >
                            Categoria
                        </td>
                        <td>
                           Descripcion
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
								<a class="lnk_grid" href="../activos/lista_categoria.php?USS_FX=E_' . $row[0] . '"><img src="../img/pencil.png" alt="delete" height="19" width="19"></a>
							</div>
						</td>
                        <td align="center">' .
                           $row[1] .
                        '</td>
                        <td align="center">' .
                           $row[2] .
                        '</td>
                        
						<td style="width:10%" style align="center">
							<a id="myLink" href="../activos/lista_categoria.php?USS_FX=D_' . $row[0] . '">
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
