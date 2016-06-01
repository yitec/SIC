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
		$result=mysql_query("insert into tbl_consecutivos (estado) values('1')");
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

        
        switch ($v_datos[1]){
        	case 1:
        	$sql="insert into tbl_reactivos (id_pedido,cantidad,nombre,pureza,grado,presentacion,almacenamiento,similar_marca,similar_catalogo,plazo_entrega,otros,proveedores,cotizacion,monto)values('".
        		utf8_encode($v_datos[0])."','".utf8_encode($v_datos[2])."','".utf8_encode($v_datos[3])."','".
        		utf8_encode($v_datos[4])."','".utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".
        		utf8_encode($v_datos[7])."','".utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".
     			utf8_encode($v_datos[10])."','".utf8_encode($v_datos[11])."','".utf8_encode($v_datos[12])."','".
     			utf8_encode($v_datos[13])."','".utf8_encode($v_datos[14])."')";
        	break;
        	case 2:
        	$sql="insert into tbl_gases (id_pedido,cantidad,nombre,pureza,presentacion,plazo,otros,proveedores,cotizacion,monto)values('".
        		utf8_encode($v_datos[0])."','".utf8_encode($v_datos[2])."','".utf8_encode($v_datos[3])."','".
        		utf8_encode($v_datos[4])."','".utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".
        		utf8_encode($v_datos[7])."','".utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".
        		utf8_encode($v_datos[10])."')";
        	break;
        	case 3:
        	$sql="insert into tbl_cristaleria (id_pedido,cantidad,nombre,clase,capacidad,presentacion,similar_marca,similar_catalogo,plazo_entrega,otros,proveedores,cotizacion,monto)values('".
        		utf8_encode($v_datos[0])."','".utf8_encode($v_datos[2])."','".utf8_encode($v_datos[3])."','".
        		utf8_encode($v_datos[4])."','".utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".
        		utf8_encode($v_datos[7])."','".utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".
     			utf8_encode($v_datos[10])."','".utf8_encode($v_datos[11])."','".utf8_encode($v_datos[12])."','".
     			utf8_encode($v_datos[13])."')";
        	break;
        	case 4:
        	$sql="insert into tbl_repuestos(id_pedido,cantidad,nombre_repuesto,marca_equipo,modelo_equipo,numero_catalogo,representante,garantia,otros,proveedores,cotizacion,monto,marca)
			values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[2])."','".utf8_encode($v_datos[3])."','".
        		utf8_encode($v_datos[4])."','".utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".
        		utf8_encode($v_datos[7])."','".utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".
     			utf8_encode($v_datos[10])."','".utf8_encode($v_datos[11])."','".utf8_encode($v_datos[12])."','".
     			utf8_encode($v_datos[13])."')";
        	break;	
        	case 5:
        	$sql="insert into tbl_equipos(id_pedido,nombre,representante,similar_marca,similar_modelo,similar_catalogo,plazo,garantia_fab,garantia_man,capacitacion,instalacion,lugar,otros,proveedores,cotizacion,monto)
        	values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[3])."','".utf8_encode($v_datos[4])."','".
        		utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."','".
        		utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".utf8_encode($v_datos[10])."','".
     			utf8_encode($v_datos[11])."','".utf8_encode($v_datos[12])."','".utf8_encode($v_datos[13])."','".
     			utf8_encode($v_datos[14])."','".utf8_encode($v_datos[15])."','".utf8_encode($v_datos[16])."','".
     			utf8_encode($v_datos[17])."')";
        	break;

        	case 6:
        	$sql="insert into tbl_materiales(id_pedido,cantidad,nombre,similar_materia,similar_catalogo,plazo,otros,proveedores,cotizacion,monto)values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[2])."','".utf8_encode($v_datos[3])."','".
        		utf8_encode($v_datos[4])."','".utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".
        		utf8_encode($v_datos[7])."','".utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".
     			utf8_encode($v_datos[10])."')";
        	break;

        	case 7:
        	$sql="insert into tbl_calibraciones(id_pedido,nombre,codigo,placa,ubicacion,lugar,monto,otros,proveedores,cotizacion)
			values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[3])."','".utf8_encode($v_datos[4])."','".
        		utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."','".
        		utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".utf8_encode($v_datos[10])."','".
        		utf8_encode($v_datos[11])."')";
        	break;	

        	case 8:
        	$sql="insert into tbl_reparaciones(id_pedido,
        		nombre_equipo,codigo,placa,ubicacion,otros,proveedores,cotizacion,monto)
			values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[3])."','".utf8_encode($v_datos[4])."','".
        		utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."','".
        		utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".utf8_encode($v_datos[10])."')";
        	break;

        	case 9:
        	$sql="insert into tbl_interlaboratoriales(id_pedido,
        		analisis,ronda,otros,proveedores,cotizacion,monto)
			values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[3])."','".utf8_encode($v_datos[4])."','".
        		utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."','".
        		utf8_encode($v_datos[8])."')";

        	break;
        	case 10:
        	$sql="insert into tbl_medios(id_pedido,
        		nombre,tipo,similar_marca,similar_catalogo,plazo,presentacion,otros,proveedores,cotizacion,monto)
			values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[3])."','".utf8_encode($v_datos[4])."','".
        		utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."','".
        		utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."','".utf8_encode($v_datos[10])."','".
     			utf8_encode($v_datos[11])."','".utf8_encode($v_datos[12])."')";
        	break;

        	case 11:
        	$sql="insert into tbl_software(id_pedido,cantidad,
        		nombre,desarrollador,version,otros,proveedores,cotizacion,monto)
			values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[2])."','".utf8_encode($v_datos[3])."','".
        		utf8_encode($v_datos[4])."','".utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".
        		utf8_encode($v_datos[7])."','".utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."')";
        	break;

        	case 12:
        	$sql="insert into tbl_capacitaciones(id_pedido,
        		proveedor,tema,fecha,costo,cotizacion,otros,proveedores)
			values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[3])."','".utf8_encode($v_datos[4])."','".
        		utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."','".
        		utf8_encode($v_datos[8])."','".utf8_encode($v_datos[9])."')";
        	break;

        	case 13:
        	$sql="insert into tbl_inscripciones(id_pedido,
        		tema,fecha,costo,otros,organizadores)
			values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[3])."','".utf8_encode($v_datos[4])."','".
        		utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."','".utf8_encode($v_datos[7])."')";
        	break;

        	case 14:
        	$sql="insert into tbl_referencias(id_pedido,
        		tipo,presentacion,cotizacion,proveedores)
			values('".
				utf8_encode($v_datos[0])."','".utf8_encode($v_datos[3])."','".utf8_encode($v_datos[4])."','".
        		utf8_encode($v_datos[5])."','".utf8_encode($v_datos[6])."')";
        	break;
        }
        $result=mysql_query($sql);
        if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error()."/".$sql ;       		
        }else{
        	$jsondata['resultado'] = $sql;        	
        	//$jsondata['resultado'] = 'Success';        	
        }
    
    echo json_encode($jsondata);

	}

	function aprueba_pedidost($parametros,$hoy){
		$v_datos=explode(",",$parametros);
		
		$result=mysql_query("update tbl_pedidos set fecha_aprobacion='".$hoy."',presupuesto='".$v_datos[1]."',tipo_presupuesto='".$v_datos[2]."',estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_reactivos set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_cristaleria set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_gases set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_repuestos set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_equipos set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_materiales set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_calibraciones set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_reparaciones set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_interlaboratoriales set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_medios set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_software set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_capacitaciones set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_inscripciones set estado=1 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_referencias set estado=1 where id_pedido='".$v_datos[0]."'");
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
        }
    echo json_encode($jsondata);

	}

    function aprueba_articulos($parametros,$hoy){
        $v_datos=explode(",",$parametros);        
        $result=mysql_query("update ".$v_datos[0]." set estado=1 where id_articulo=".$v_datos[1]);
        if (!$result) {//si da error que me despliegue el error del query               
            $jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
            $jsondata['resultado'] = 'Success';         
        }
    echo json_encode($jsondata);

    }
	
	function rechaza_pedidost($parametros,$hoy){
		$v_datos=explode("|",$parametros);
		
		$result=mysql_query("update tbl_pedidos set fecha_rechazado='".$hoy."',razon_rechazo='".$v_datos[1]."' ,estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_reactivos set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_cristaleria set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_gases set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_repuestos set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_equipos set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_materiales set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_calibraciones set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_reparaciones set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_interlaboratoriales set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_medios set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_software set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_capacitaciones set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_inscripciones set estado=2 where id_pedido='".$v_datos[0]."'");
        $result=mysql_query("update tbl_referencias set estado=2 where id_pedido='".$v_datos[0]."'");
		if (!$result) {//si da error que me despliegue el error del query       		
       		$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
        }else{
        	$jsondata['resultado'] = 'Success';        	
        }
    echo json_encode($jsondata);

	}

    function rechaza_articulos($parametros,$hoy){
        $v_datos=explode(",",$parametros);
        $result=mysql_query("update ".$v_datos[0]." set estado=2 where id_articulo=".$v_datos[1]);
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