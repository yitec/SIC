<?
session_start();
require_once('../cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
/*****************************************************************************************************************
Accion:Ejecuta todas las operaciones sobre expedientes
Parametros: Vector con lista de parametros segun metodo
/****************************************************************************************************************/

$metodo=$_POST['metodo'];
$parametros=$_POST['parametros'];
$exp = new Pedidos;
$exp->$metodo($parametros,$hoy);

class Pedidos{
/*******************************************************
	accion="crea un nuevo pedidos con la informacion general"
	parametros="datos del form"
	invocacion="Script_pedidos.php"

********************************************************/

	function crea_pedido($parametros,$hoy){
		$v_datos=explode(",",$parametros);
		$result=mysql_query("insert into tbl_pedidos(consecutivo,id_proveedor,fecha_creacion,id_usuario,solicitante,seccion,asunto,proyecto_nombre,proyecto_numero,tipo)values('".utf8_encode($v_datos[0])."','".utf8_encode($v_datos[1])."','".$hoy."','".$_SESSION['usuario']."','".$v_datos[2]."','".$v_datos[3]."','".$v_datos[4]."','".utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."')");
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
			$jsondata['id_pedido'] = mysql_insert_id();        	
        }
    echo json_encode($jsondata);

	}
	
	function agrega_articulos($parametros,$hoy){
		$v_datos=explode(",",$parametros);
		
		$result=mysql_query("insert into tbl_detalle_pedidos(id_pedido,id_categoria,descripcion,observaciones,equipo,codigo_equipo,placa,serie,marca,modelo,presentacion,pureza,grado,capacidad,tipo_coneccion,certificador,fecha_recepcion,volumen)values('".utf8_encode($v_datos[0])."','".utf8_encode($v_datos[1])."','".utf8_encode($v_datos[2])."','".utf8_encode($v_datos[3])."','".utf8_encode($v_datos[4])."','".utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."','".utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".utf8_encode($v_datos[10])."','".utf8_encode($v_datos[11])."','".utf8_encode($v_datos[12])."','".utf8_encode($v_datos[13])."','".utf8_encode($v_datos[14])."','".utf8_encode($v_datos[15])."','".utf8_encode($v_datos[16])."','".$hoy."')");
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
        }
    echo json_encode($jsondata);

	}

	
	

	

}//end class

?>