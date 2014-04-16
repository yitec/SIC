<?php
session_start();
include ('../cnx/Conexion_Calidad.php');

$hoy=date("Y-m-d H:i:s");

/*****************************************************************************************************************
Accion:Ejecuta todas las operaciones sobre expedientes
Parametros: Vector con lista de parametros segun metodo
/****************************************************************************************************************/
conectarc();
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
		$result=mysql_query("INSERT INTO tbl_categorias (id_categoria ,nombre_categoria ,fecha_creacion ,estado)VALUES (NULL , '".utf8_decode($v_datos[0])."', NOW(), '1')");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				bitacora("Categoria creada ".utf8_decode($v_datos[0]) );				
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}

	function crea_subcategorias($parametros){
	
		$v_datos=explode(",",$parametros);	

//		$result=mysql_query("INSERT INTO 'tbl_subcat' ('id_subcat', 'id_categoria', 'nombre_subcat', 'fecha_creacion', 'estado')VALUES (NULL , '".($v_datos[0])."','".utf8_decode($v_datos[1])."', NOW(), '1')");

		$result=mysql_query("INSERT INTO tbl_subcat (id_subcat, id_categoria, nombre_subcat, prefijo, fecha_creacion, estado)VALUES (NULL , '".($v_datos[0])."','".utf8_decode($v_datos[1])."','".($v_datos[2])."', NOW(), '1')");

		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				bitacora("SubCategoria creada ".utf8_decode($v_datos[1]) );				
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}
	
	function seleccionar_subCategoria($parametros){

		$id = $parametros;
		$option  = '<option selected="selected" value="0">Seleccione</option>';
		
		$result=mysql_query("SELECT id_subcat,nombre_subcat FROM tbl_subcat WHERE id_categoria= '".$id."'");
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
	
	
		function seleccionar_prefijo($parametros){

		$id = $parametros;
		
		$result=mysql_query("SELECT prefijo FROM tbl_subcat WHERE id_subcat= '".$id."'");
		while($info2=mysql_fetch_array($result)){
			$consulta=mysql_query("SELECT codigo FROM tbl_archivos WHERE id_subcat= '".$id."' order by codigo desc LIMIT 1 ");
			$info3=mysql_fetch_row($consulta);
			$info3[0] ++;
			
			$option = '<option selected="selected" value="'.$info3[0].'">'.($info2[0]).'-'.$info3[0].'</option>';
		
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
		
		$result=mysql_query("SELECT * FROM tbl_archivos WHERE id_subcat= '".$id."'");
		while($info2=mysql_fetch_array($result)){
			$option .= '<option value="'.$info2[0].'">'.utf8_decode($info2[4]).'</option>';
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
		$result=mysql_query("UPDATE tbl_categorias SET nombre_categoria = '".utf8_decode($v_datos[0])."' WHERE tbl_categorias.id_categoria ='".$v_datos[1]."';");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				bitacora("Edicion de categoria ".utf8_decode($v_datos[0]) );				
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}
	
	function eliminar_categoria($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("UPDATE tbl_categorias SET estado = 0 WHERE id_categoria ='".$v_datos[1]."'");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				bitacora("Catogoria  ".utf8_decode($v_datos[1])." eliminada" );				
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}
	
	function editar_subcategoria($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("UPDATE tbl_subcat SET nombre_subcat = '".utf8_decode($v_datos[0])."' WHERE tbl_subcat.id_subcat ='".$v_datos[1]."'");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				bitacora("SubCategoria ".utf8_decode($v_datos[0]). " modificada" );				
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}
	
	function eliminar_subcategoria($parametros){
	
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("UPDATE tbl_subcat SET estado = 0 WHERE id_subcat ='".$v_datos[1]."'");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				bitacora("SubCategoria ".utf8_decode($v_datos[1])." eliminada" );				
				$jsondata['resultado'] = 'Success';
			}
		echo json_encode($jsondata);
	}

  function aceptar_peticion($parametros,$hoy){
  
	  $v_datos=explode(",",$parametros);
	  $origen = "../calidad/archivos/Pendientes/";
	  $destino = '../calidad/archivos/ControlCalidad/';
	  $archivo = $v_datos[1];
    if (copy($origen.$archivo, $destino.$archivo)) {
    	$consulta=mysql_query("UPDATE bd_calidad.tbl_pendientes SET estado = 2, ,fecha_actualizacion='".$hoy."' WHERE tbl_pendientes.id_pendiente ='".$v_datos[0]."'");
		$result=mysql_query("UPDATE bd_calidad.tbl_archivos SET url_archivo = '".$v_datos[1]."' WHERE tbl_archivos.id_archivo ='".$v_datos[2]."'");
	  	if (!$result) {//si da error que me despliegue el error del query       		
			  $jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
		}else{
			bitacora("Peticion acepatada ".utf8_decode($v_datos[1]) );				
			$jsondata['resultado'] = 'Success';
			$subject = "Solicitud para modificar el archivo Aceptada";
			echo json_encode($jsondata);
			//	mail("jpgarcia01@gmail.com","Nuevo Pendiente.",$subject);
          }
	}else{
           echo "error al copiar el archivo";            
		   echo json_encode($jsondata);
	}	
   }

	function rechazar_peticion($parametros,$hoy){
  
	  $v_datos=explode(",",$parametros);	
	  $result=mysql_query("UPDATE bd_calidad.tbl_pendientes SET estado = 3,razon_rechazo='".$v_datos[1]."',fecha_actualizacion='".$hoy."' WHERE tbl_pendientes.id_pendiente ='".$v_datos[0]."'");
	  if (!$result) {//si da error que me despliegue el error del query       		
			  $jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
		  }else{
		  	bitacora("Peticion rechazada ".utf8_decode($v_datos[1]) );				
			$jsondata['resultado'] = 'Success';
			  //	mail("jpgarcia01@gmail.com","Nuevo Pendiente.",$subject);
		  }
	  echo json_encode($jsondata);
  }
  

  	function derogar_archivo($parametros){
  
	  $v_datos=explode(",",$parametros);	
	  $result=mysql_query("UPDATE bd_calidad.tbl_archivos SET estado = 2 WHERE tbl_archivos.id_archivo ='".$v_datos[0]."'");
	  if (!$result) {//si da error que me despliegue el error del query       		
			  $jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
		  }else{
		  	bitacora("Archivo ".utf8_decode($v_datos[1])." derogado" );				
			$jsondata['resultado'] = 'Success';

		  }
	  echo json_encode($jsondata);
  }
  

		
		
	function envia_comentarios($parametros){
	
		$v_datos=explode(",",$parametros);
		 $subject = "Solicitud para modificar el archivo Denegada";
		 $message = $v_datos[0];
		mail("jpgarcia01@gmail.com","Nuevo Pendiente.",$subject, $message);	
		 $jsondata['resultado'] = 'Success';

		echo json_encode($jsondata);
	}		   
  
	function crear_archivo($parametros){
	
		$v_datos=explode("|",$parametros);	

//		$result=mysql_query("INSERT INTO 'tbl_archivos' ('id_archivo' ,'id_categoria' ,'id_subcat','nombre_archivo','version','fecha_creacion','id_usuario','url_archivo','url_online','estado') VALUES (NULL , '".$v_datos[2]."', '".utf8_decode($v_datos[3])."','".utf8_encode($v_datos[0])."','".utf8_encode($v_datos[1])."',NOW(),'','".$v_datos[5]."','".$v_datos[4]."','1')");

		$result=mysql_query("INSERT INTO tbl_archivos 
		(
		id_categoria,
		id_subcat,
		nombre_archivo,
		version,		
		fecha_creacion,
		responsable,
		ultima_revision,
		url_archivo,
		url_online,
		estado,
		codigo,
		copias_controladas) 
		VALUES 
		(
		 '".$v_datos[2]."',
		 '".utf8_encode($v_datos[5])."',
		 '".utf8_encode($v_datos[0])."',
		 '".utf8_encode($v_datos[1])."',
		 NOW(),
		 '".utf8_encode($v_datos[3])."',
		 '".$v_datos[4]."',
		 '".$v_datos[9]."',
		 '".$v_datos[6]."',
		 1,
		 '".$v_datos[7]."',
		 '".$v_datos[8]."'
		 )");

		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				bitacora("Archivo creado ".utf8_decode($v_datos[0]), " " );				
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
		//$parametros=utf8_decode($parametros);
		$v_datos=explode(",",$parametros);	
		$result=mysql_query("INSERT INTO tbl_pendientes (id_archivo,nuevo_archivo,url_online,comentario,fecha_solicitud,id_usuario,correo,estado) VALUES ( '".$v_datos[0]."',  '".$v_datos[3]."', '".$v_datos[2]."','".utf8_decode($v_datos[1])."',NOW(),'".$_SESSION['usuario']."','".$_SESSION['correo']."','1')");
		if (!$result) {//si da error que me despliegue el error del query       		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
			}else{
				bitacora("Archivo modificado ".utf8_decode($v_datos[3]) );				
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


function bitacora($accion){
		$result=mysql_query("INSERT INTO tbl_historial (accion,usuario,fecha)values('".$accion."','".$_SESSION['nombre_usuario']."',NOW())");
}	

?>