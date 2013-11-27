<?php
include ('../cnx/Conexion_Calidad.php');

$hoy=date("Y-m-d H:i:s");

/*****************************************************************************************************************
Accion:Ejecuta todas las operaciones sobre expedientes
Parametros: Vector con lista de parametros segun metodo
/****************************************************************************************************************/
conectar();
$metodo=$_POST['metodo'];
$parametros=$_POST['parametros'];
$usr = new Categorias;
$usr->$metodo($parametros,$hoy);


class Categorias{

	function autocompleta_usuarios(){
		$result=mysql_query("select nombre from tbl_usuarios");
		while ($row=mysql_fetch_object($result)){
			$vector=$vector.",".utf8_encode($row->nombre); 
		}
		echo $vector;
		mysql_free_result($result);

	}

	function crea_categorias($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("INSERT INTO `tbl_categorias` (`id_categoria` ,`nombre_categoria` ,`fecha_creacion` ,`estado`)VALUES (NULL , '".utf8_decode($v_datos[0])."', NOW(), '1')");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}

	function crea_subcategorias($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("INSERT INTO `tbl_subcat` (`id_subcat`, `id_categoria`, `nombre_subcat`, `fecha_creacion`, `estado`)VALUES (NULL , '".($v_datos[0])."','".utf8_decode($v_datos[1])."', NOW(), '1')");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}
	
	function seleccionar_subCategoria($parametros){

		$id = $parametros;
		$option  = '<option selected="selected" value="0">Seleccione</option>';
		
		$result=mysql_query("SELECT `id_subcat`,`nombre_subcat` FROM `tbl_subcat` WHERE `id_categoria`= '".$id."'");
		while($info2=mysql_fetch_array($result)){
			$option .= '<option value="'.$info2[0].'">'.utf8_encode($info2[1]).'</option>';
		}
		
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				$jsondata['resultado'] = $option;
			}
			echo json_encode($jsondata);
	}
	

	
	
	function seleccionar_archivos($parametros){

		$id = $parametros;
		$option  = '<option selected="selected" value="0">Seleccione</option>';
		
		$result=mysql_query("SELECT * FROM `tbl_archivos` WHERE `id_subcat`= '".$id."'");
		while($info2=mysql_fetch_array($result)){
			$option .= '<option value="'.$info2[0].'">'.utf8_encode($info2[3]).'</option>';
		}
		
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				$jsondata['resultado'] = $option;
			}
			echo json_encode($jsondata);
	}
		
	

	function editar_categoria($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("UPDATE `tbl_categorias` SET `nombre_categoria` = '".utf8_decode($v_datos[0])."' WHERE `tbl_categorias`.`id_categoria` ='".$v_datos[1]."';");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}
	
	function eliminar_categoria($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("UPDATE `tbl_categorias` SET `estado` = '0' WHERE `tbl_categorias`.`id_categoria` ='".$v_datos[1]."';");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}
	
	function editar_subcategoria($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("UPDATE `tbl_subcat` SET `nombre_subcat` = '".utf8_decode($v_datos[0])."' WHERE `tbl_subcat`.`id_subcat` ='".$v_datos[1]."';");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}
	
	function eliminar_subcategoria($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("UPDATE `tbl_subcat` SET `estado` = '0' WHERE `tbl_subcat`.`id_subcat` ='".$v_datos[1]."';");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}
	
	function rechazar_peticion($parametros){
  
	  $v_datos=explode(",",$parametros);	
	  $result=mysql_query("UPDATE `bd_calidad`.`tbl_pendientes` SET `estado` = '0' WHERE `tbl_pendientes`.`id_pendiente` ='".$v_datos[0]."';");
	  if (!$result) {//si da error que me despliegue el error del query       		
			  $jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
		  }else{
			  $jsondata['resultado'] = 'Success';
			  $subject = "Solicitud para modificar el archivo Denegada";
				mail("jpgarcia01@gmail.com","Nuevo Pendiente.",$subject);
		  }
	  echo json_encode($jsondata);
  }
  
  function aceptar_peticion($parametros){
  
	  $v_datos=explode(",",$parametros);
	  $origen = "../archivos/pendientes/";
	  $destino = '../archivos/ControlCalidad/';
	  $archivo = $v_datos[2];
    if (copy($origen.$archivo, $destino.$archivo)) {

      $consulta=mysql_query("UPDATE `bd_calidad`.`tbl_pendientes` SET `estado` = '0' WHERE `tbl_pendientes`.`id_pendiente` ='".$v_datos[0]."';");
	  $result=mysql_query("UPDATE `bd_calidad`.`tbl_archivos` SET `url_archivo` = '".$v_datos[2]."' WHERE `tbl_archivos`.`id_archivo` ='".$v_datos[1]."';");
	  }
	  else {

           echo "error al copiar el archivo";            
		   echo json_encode($jsondata);
		     }
	  if (!$result) {//si da error que me despliegue el error del query       		
			  $jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
		  }else{
			  	
			  $jsondata['resultado'] = 'Success';
			  $subject = "Solicitud para modificar el archivo Aceptada";
				mail("jpgarcia01@gmail.com","Nuevo Pendiente.",$subject);

          }

        }    
  
	function crear_archivo($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("INSERT INTO `tbl_archivos` (`id_archivo` ,`id_categoria` ,`id_subcat`,`nombre_archivo`,`version`,`fecha_creacion`,`id_usuario`,`url_archivo`,`url_online`,`estado`) VALUES (NULL , '".$v_datos[2]."', '".utf8_decode($v_datos[3])."','".utf8_encode($v_datos[0])."','".utf8_encode($v_datos[1])."',NOW(),'','".$v_datos[5]."','".$v_datos[4]."','1')");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				$jsondata['resultado'] = 'Success';
					$archivo= "../calidad/historial/".date("Y-m-d H-i-s")."_NuevoArchivo.txt"; // el nombre de tu archivo
					$contenido= $v_datos[0] .";". $v_datos[1] .";". $v_datos[5].";". $v_datos[4];// Recibe el formulario

					$fch= fopen($archivo, "w"); // Abres el archivo para escribir en él
					fwrite($fch, $contenido); // Grabas
					fclose($fch); // Cierras el archivo.
		
			}
						
		echo json_encode($jsondata);
	}
	
	function modificar_archivo($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("INSERT INTO `tbl_pendientes` (`id_pendiente`,`id_archivo` ,`nuevo_archivo`,`url_online`,`comentario`,`fecha_solicitud`,`id_usuario`,`estado`) VALUES (NULL , '".$v_datos[0]."',  '".$v_datos[3]."', '".$v_datos[2]."','".utf8_decode($v_datos[1])."',NOW(),'','1')");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				$jsondata['resultado'] = 'Success';
					$archivo= "../calidad/historial/".date("Y-m-d H-i-s")."_ArchivoModificado.txt"; // el nombre de tu archivo
					$contenido= $v_datos[0] .";". $v_datos[3] .";". $v_datos[2].";". $v_datos[1];// Recibe el formulario

					$fch= fopen($archivo, "w"); // Abres el archivo para escribir en él
					fwrite($fch, $contenido); // Grabas
					fclose($fch); // Cierras el archivo.
				$subject = "Solicitud para modificar el archivo: ".$v_datos[0]." Motivo: ".$v_datos[1]." Nombre del nuevo archivo: ".$v_datos[2];
//				mail("jpgarcia01@gmail.com","Nuevo Pendiente.",$subject);
			}
		echo json_encode($jsondata);
	}	
}//end class



?>