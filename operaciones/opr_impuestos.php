<?php
session_start();
require_once('../cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
//guarda un articulo en inventario
$dia=substr($_REQUEST['txt_fecha'], 3, 2);
$ano=substr($_REQUEST['txt_fecha'], 6, 4);
$mes=substr($_REQUEST['txt_fecha'], 0, 2);

$fecha=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";

if($_REQUEST['opcion']==1)
{

//busco si no existe la categoria
$result=mysql_query("select n_recibo from tbl_impuestos where n_recibo='".$_REQUEST['txt_recibo']."'");
$total=mysql_num_rows($result);
if($total>0){
	echo "repetido";
}else{
	$query="insert into tbl_impuestos(img,empresa,fecha_pago,n_deposito,n_recibo,monto,mora,semestre,tipo_pago,estado)values('".$_SESSION['nombre_archivo']."','".utf8_decode($_REQUEST['txt_empresa'])."','".$_REQUEST['txt_fecha']."','".$_REQUEST['txt_deposito']."','".$_REQUEST['txt_recibo']."','".$_REQUEST['txt_monto']."','".$_REQUEST['txt_mora']."','".utf8_decode($_REQUEST['txt_semestre'])."','".$_REQUEST['cmb_tipopago']."','"."1"."')";
	$result = mysql_query($query);	
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}
		
	
	desconectar();
	echo "Success";
	
	
	
}

}//end if opcion 1

//modificar impuesto
if($_REQUEST['opcion']==2)
{	
$result=mysql_query("update tbl_impuestos set empresa='".$_REQUEST['txt_empresa']."',n_recibo='".$_REQUEST['txt_recibo']."',n_deposito='".$_REQUEST['txt_deposito']."',monto='".$_REQUEST['txt_monto']."',mora='".$_REQUEST['txt_mora']."',fecha_pago='".$_REQUEST['txt_fecha']."', semestre='".$_REQUEST['txt_semestre']."', tipo_pago='".$_REQUEST['cmb_tipopago']."' where n_recibo='".$_REQUEST['txt_recibo_buscar']."'");

if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}
	else{
		echo "Success";
	}
	desconectar();
	
}//end if opcion 2

//Consultar impuestos
if($_REQUEST['opcion']==3)
{
	
	
	$result=mysql_query("select * from tbl_impuestos where n_recibo='".$_REQUEST['txt_recibo_buscar']."'");
	$row=mysql_fetch_assoc($result);
	if (mysql_num_rows($result)>=1){
	echo utf8_encode($row['empresa'])."|".$row['n_recibo']."|".$row['n_deposito']."|".$row['monto']."|".$row['mora']."|".$row['fecha_pago']."|".$row['img']."|".$row['semestre']."|".$row['tipo_pago'] ; 	}else{
		echo "error";
	}
	
	desconectar();
}//end if opcion 3






//eliminar articulo

if($_REQUEST['opcion']==4)
{		
	$result=mysql_query("delete from tbl_impuestos where nombre='".$_REQUEST['txt_recibo_buscar']."'");
	

	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 
	
desconectar();
}//end if opcion 4

//lleno el autocompletar 
if($_REQUEST['opcion']==5)
{

	$result=mysql_query("select n_recibo from tbl_impuestos");
	while ($row=mysql_fetch_assoc($result)){
		$vector=$vector.",".utf8_encode($row['n_recibo']); 
	}
	echo $vector;
	desconectar();


}//end if opcion 5

?>