<?
session_start();
require_once('../cnx/conexion_compras.php');
conectarc();
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
		$v_datos=explode(",",utf8_encode($parametros));
		$sql="insert into tbl_pedidos(consecutivo,id_proveedor,fecha_creacion,id_usuario,solicitante,seccion,justificacion,tipo,geco,codigo_agrupacion,codigo_articulo,correo_usuario)values('".utf8_encode($v_datos[0])."','".utf8_encode($v_datos[1])."','".$hoy."','".$_SESSION['usuario']."','".$v_datos[2]."','".$v_datos[3]."','".$v_datos[4]."','".utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."','".utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."')";
		$result=mysql_query($sql);		
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
			$jsondata['id_pedido'] = mysql_insert_id();        	
        }        
    echo json_encode($jsondata);
    //envia_correo($v_datos[8]);       
	}
	
	function agrega_articulos($parametros,$hoy){
		$v_datos=explode(",",$parametros);
		
		$result=mysql_query("insert into tbl_detalle_pedidos(id_pedido,id_categoria,cantidad)values('".utf8_encode($v_datos[0])."','".utf8_encode($v_datos[1])."','".utf8_encode($v_datos[2])."')");
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
        }

        switch ($v_datos[1]==1){
        	case 1:
        	$sql="insert into tbl_reactivos (id_pedido,nombre,pureza,grado,presentacion,almacenamiento,similar_marca
        		similar_catalogo,plazo_entrega,otros,proveedores,cotizacion,monto)values();
        		)values('".utf8_encode($v_datos[0])."','".utf8_encode($v_datos[3])."','".utf8_encode($v_datos[4])."'
        		,'".utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."'
        		,'".utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".utf8_encode($v_datos[10])."'
        		,'".utf8_encode($v_datos[11])."','".utf8_encode($v_datos[12])."','".utf8_encode($v_datos[13])."'
        		,'".utf8_encode($v_datos[13])."'
        		)"
        	break;
        }
        $result=mysql_query($sql);
        if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = $sql;        	
        	//$jsondata['resultado'] = 'Success';        	
        }
    
    echo json_encode($jsondata);

	}

	function aprueba_pedidos($parametros,$hoy){
		$v_datos=explode(",",$parametros);
		
		$result=mysql_query("update tbl_pedidos set fecha_aprobacion='".$hoy."',estado=1 where consecutivo='".$v_datos[0]."'");
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
        }
    echo json_encode($jsondata);

	}
	
	function rechaza_pedidos($parametros,$hoy){
		$v_datos=explode("|",$parametros);
		
		$result=mysql_query("update tbl_pedidos set fecha_rechazado='".$hoy."',razon_rechazo='".$v_datos[1]."' ,estado=2 where consecutivo='".$v_datos[0]."'");
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
        }
    echo json_encode($jsondata);

	}
	
	function entrega_pedidos($parametros,$hoy){
		$v_datos=explode("|",$parametros);
		
		$result=mysql_query("update tbl_pedidos set detalle_entrega='".$v_datos[0]."',fecha_entregado='".$hoy."',estado=3 where consecutivo='".$v_datos[1]."'");
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
        }
    echo json_encode($jsondata);

	}

	

	function elimina_pedidos($parametros,$hoy){
		$v_datos=explode(",",$parametros);
		
		$result=mysql_query("update tbl_pedidos set fecha_rechazado='".$hoy."',estado=4 where consecutivo='".$v_datos[0]."'");
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
        }
    echo json_encode($jsondata);

	}

	function elimina_item($parametros,$hoy){
		$v_datos=explode(",",$parametros);
		
		$result=mysql_query("update tbl_detalle_pedidos set estado=0 where id='".$v_datos[0]."'");
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
        }
    echo json_encode($jsondata);

	}

	function envia_correo($consecutivo){
		date_default_timezone_set('America/Denver');
       $head = "From: info@siccina.ucr.ac.cr<info@siccina.ucr.ac.cr>\r\n";	   
	   $email = "info@siccina.ucr.ac.cr";
	   $dest = "mizard6@yahoo.es,jennyasc69@gmail.com,kmadrigal@feednet.ucr.ac.cr";
	   $asunto = "Nuevo Pedido = ".$consecutivo;	
	   $msg="Se ha creado un nuevo pedido con el consecutivo".$consecutivo." Verifique los detalles en el control de pedidos";	   	
	   mail($dest, $asunto, $msg, $head);
    }

	
	
	

	

}//end class

?>