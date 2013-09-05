<?
session_start();
require_once('../cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
//guarda un articulo en inventario
$dia=substr($_REQUEST['txt_fecha'], 3, 2);
$ano=substr($_REQUEST['txt_fecha'], 6, 4);
$mes=substr($_REQUEST['txt_fecha'], 0, 2);

$fecha=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";

//actualiza los datos de muestra
if($_REQUEST['opcion']==1)
{

$result= mysql_query(utf8_decode("update tbl_infmuestras set tipo_alimento='".$_REQUEST['tipo_alimento']."',nombre_producto='".$_REQUEST['nombre_producto']."',condicion_muestra='".$_REQUEST['condicion_muestra']."',fecha_muestra='".$_REQUEST['fecha_muestra']."',forma_muestreo='".$_REQUEST['forma_muestreo']."',proceso_elaboracion='".$_REQUEST['proceso_elaboracion']."',parte_planta='".$_REQUEST['parte_planta']."',importado='".$_REQUEST['importado']."',elaborado='".$_REQUEST['elaborado']."' where cons_contrato='".$_REQUEST['contrato']."'"));

if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
}else{
	echo "Success";
}


$result= mysql_query(utf8_decode("update tbl_contratos set observaciones='".$_REQUEST['observaciones']."' where consecutivo='".$_REQUEST['contrato']."'"));

$result= mysql_query(utf8_decode("update tbl_contratos set factura='".$_REQUEST['factura']."' where consecutivo='".$_REQUEST['contrato']."'"));


}//end opcion 1


//actualiza los datos de muestra oficiales
if($_REQUEST['opcion']==2)
{

$result=mysql_query("select cons_contrato from tbl_infoficiales where cons_contrato='".$_REQUEST['contrato']."'");

//pregunto si no existe el contrato en la tabla
if (mysql_num_rows($row=$result)>0){

	$result2= mysql_query(utf8_decode("update tbl_infoficiales set empresa='".$_REQUEST['empresa']."',inspector='".$_REQUEST['inspector']."',lisencia='".$_REQUEST['lisencia']."',boleta='".$_REQUEST['boleta']."',muestreado='".$_REQUEST['muestreado']."',fecha_elaboracion='".$_REQUEST['fecha_elaboracion']."',fecha_vencimiento='".$_REQUEST['fecha_vencimiento']."' where cons_contrato='".$_REQUEST['contrato']."'"));

	if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";        		
	}else{
		echo "Success";
	}

}else{
	$result2= mysql_query(utf8_decode("insert into tbl_infoficiales(cons_contrato,empresa,inspector,lisencia,boleta,muestreado,fecha_elaboracion,fecha_vencimiento) values('".$_REQUEST['contrato']."','".$_REQUEST['empresa']."','".$_REQUEST['inspector']."','".$_REQUEST['lisencia']."','".$_REQUEST['boleta']."','".$_REQUEST['muestreado']."','".$_REQUEST['fecha_elaboracion']."','".$_REQUEST['fecha_vencimiento']."')"));
		if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido2: ' . mysql_error() . "\n";        		
	}else{
		echo "Success";
	}

	
}//end if numw rows



}//end opcion 2


//actualiza los datos de muestra forrajes
if($_REQUEST['opcion']==3)
{

$result=mysql_query("select cons_contrato from tbl_infforrajes where cons_contrato='".$_REQUEST['contrato']."'");

//pregunto si no existe el contrato en la tabla
if (mysql_num_rows($row=$result)>0){

	$result2= mysql_query(utf8_decode("update tbl_infforrajes set tipo='".$_REQUEST['tipo']."',origen='".$_REQUEST['origen']."',fertilizacion='".$_REQUEST['fertilizacion']."',aplicacion='".$_REQUEST['aplicacion']."',edad='".$_REQUEST['edad']."'  where cons_contrato='".$_REQUEST['contrato']."'"));

	if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";        		
	}else{
		echo "Success";
	}

}else{
	$result2= mysql_query(utf8_decode("insert into tbl_infforrajes(cons_contrato,tipo,origen,fertilizacion,aplicacion,edad) values('".$_REQUEST['contrato']."','".$_REQUEST['tipo']."','".$_REQUEST['origen']."','".$_REQUEST['fertilizacion']."','".$_REQUEST['aplicacion']."','".$_REQUEST['edad']."')"));
		if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido2: ' . mysql_error() . "\n";        		
	}else{
		echo "Success";
	}

	
}//end if numw rows



}//end opcion 3



?>